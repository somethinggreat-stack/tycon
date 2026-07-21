<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Onboarding;
use App\Models\Order;
use App\Services\ApexService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function loginForm()
    {
        if (session('admin_ok')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => ['required'],
            'password' => ['required'],
        ]);

        $email = config('tycoon.admin.email');
        $pass  = config('tycoon.admin.password');

        if ($request->input('email') === $email && $request->input('password') === $pass) {
            $request->session()->regenerate();
            $request->session()->put('admin_ok', true);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials.'])->withInput(['email' => $request->email]);
    }

    public function logout(Request $request)
    {
        $idle = $request->input('reason') === 'idle';

        $request->session()->forget(['admin_ok', 'admin_last_seen']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('status', $idle
            ? 'You were signed out after '.config('tycoon.admin.idle_minutes', 10).' minutes of inactivity.'
            : 'You have been signed out.');
    }

    public function dashboard(Request $request)
    {
        $leads       = Lead::latest()->get();
        $orders      = Order::latest()->get();
        $onboardings = Onboarding::latest()->get();

        $now = Carbon::now();
        $today = $now->copy()->startOfDay();
        $weekAgo = $now->copy()->subDays(7);
        $monthStart = $now->copy()->startOfMonth();

        $leadsToday  = $leads->where('created_at', '>=', $today)->count();
        $ordersToday = $orders->where('created_at', '>=', $today)->count();

        // per-source counters (one form per source)
        $bySource = function (string $src) use ($leads, $today, $weekAgo) {
            $set = $leads->where('source', $src);
            return [
                'total' => $set->count(),
                'today' => $set->where('created_at', '>=', $today)->count(),
                'week'  => $set->where('created_at', '>=', $weekAgo)->count(),
            ];
        };

        $stats = [
            'total_submissions' => $leads->count() + $orders->count() + $onboardings->count(),
            'today_submissions' => $leadsToday + $ordersToday + $onboardings->where('created_at', '>=', $today)->count(),
            'revenue_lifetime'  => $orders->sum('amount_value'),
            'revenue_today'     => $orders->where('created_at', '>=', $today)->sum('amount_value'),
            'revenue_month'     => $orders->where('created_at', '>=', $monthStart)->sum('amount_value'),
            'orders_total'      => $orders->count(),
            'orders_today'      => $ordersToday,
            'orders_week'       => $orders->where('created_at', '>=', $weekAgo)->count(),
            'leads_total'       => $leads->count(),
            'onboarded_total'   => $onboardings->count(),
            'onboarded_today'   => $onboardings->where('created_at', '>=', $today)->count(),
            'onboarded_week'    => $onboardings->where('created_at', '>=', $weekAgo)->count(),
            'quiz'      => $bySource('quiz'),
            'personal'  => $bySource('personal'),
            'business'  => $bySource('business'),
            'financial' => $bySource('financial'),
        ];

        $latestOrders = $orders->take(6);
        $latestLeads  = $leads->take(6);

        return view('admin.dashboard', compact('leads', 'orders', 'onboardings', 'stats', 'latestOrders', 'latestLeads', 'now'));
    }

    /**
     * Keepalive for the "Stay signed in" button.
     * Reaching this means AdminAuth already refreshed admin_last_seen; a expired
     * session never gets here — it returns 401 JSON, which the page acts on.
     */
    public function extendSession(Request $request)
    {
        return response()->json([
            'ok'          => true,
            'idle_minutes' => (int) config('tycoon.admin.idle_minutes', 10),
            'csrf'        => csrf_token(),
        ]);
    }

    /** Re-push a client to APEX after a failed sync, without asking them to resubmit. */
    public function retryApex(Onboarding $onboarding)
    {
        if ($onboarding->apex_synced) {
            return back()->with('status', $onboarding->fullName().' is already synced to APEX.');
        }

        if (! ApexService::enabled()) {
            return back()->with('status', 'APEX is not configured on this server — nothing was sent. Run: php artisan apex:status');
        }

        $result = ApexService::sendOnboarding($onboarding);
        $onboarding->update([
            'apex_synced' => $result['synced'],
            'apex_note'   => $result['note'],
        ]);

        return back()->with('status', $result['synced']
            ? $onboarding->fullName().' pushed to APEX successfully.'
            : 'APEX push failed again — '.$result['note']);
    }

    /** Stream a private onboarding document to the admin. */
    public function downloadDoc(Onboarding $onboarding, string $field)
    {
        $map = [
            'dl'      => $onboarding->dl_path,
            'ssncard' => $onboarding->ssn_card_path,
            'proof'   => $onboarding->proof_address_path,
        ];

        $path = $map[$field] ?? null;
        abort_if(! $path || ! Storage::disk('local')->exists($path), 404);

        return Storage::disk('local')->response($path);
    }
}
