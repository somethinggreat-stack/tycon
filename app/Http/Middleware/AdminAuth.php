<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Gate the admin area and enforce an idle timeout.
     *
     * The timeout is tracked here rather than relying on SESSION_LIFETIME so it
     * holds no matter how the session is configured, and so an expired session
     * always lands on the login page with an explanation instead of a 419.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $session = $request->session();

        if (! $session->get('admin_ok')) {
            return $this->reject($request, 'Please sign in to continue.');
        }

        // The browser warns at idle_minutes and signs out warn_seconds later, so the
        // server must allow that full window (plus a little slack for clock drift and
        // the round-trip) or "Stay signed in" would arrive already expired.
        $idleLimit = (max(1, (int) config('tycoon.admin.idle_minutes', 10)) * 60)
            + max(0, (int) config('tycoon.admin.warn_seconds', 60))
            + 30;

        $lastSeen = (int) $session->get('admin_last_seen', 0);

        if ($lastSeen > 0 && (time() - $lastSeen) > $idleLimit) {
            $this->forget($request);

            return $this->reject(
                $request,
                'You were signed out after '.config('tycoon.admin.idle_minutes', 10).' minutes of inactivity.'
            );
        }

        $session->put('admin_last_seen', time());

        $response = $next($request);

        // The dashboard must never be restored from bfcache after a sign-out.
        if (method_exists($response, 'header')) {
            $response->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
        }

        return $response;
    }

    /** Clear every trace of the admin session. */
    private function forget(Request $request): void
    {
        $request->session()->forget('admin_ok');
        $request->session()->forget('admin_last_seen');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }

    /** JSON for the keepalive poll, a redirect for a normal page request. */
    private function reject(Request $request, string $message): Response
    {
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json(['ok' => false, 'expired' => true, 'message' => $message], 401);
        }

        return redirect()->route('admin.login')->with('status', $message);
    }
}
