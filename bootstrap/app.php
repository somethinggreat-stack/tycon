<?php

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    // Registered explicitly: withRouting(commands: …) registers routes/console.php as a
    // command *route file*, which leaves app/Console/Commands unscanned.
    ->withCommands([
        App\Console\Commands\ApexRetry::class,
    ])
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Trust the ngrok (and any) reverse proxy so https / forwarded host is honored,
        // preventing mixed-content asset URLs when served through a tunnel.
        $middleware->trustProxies(at: '*', headers:
            Illuminate\Http\Request::HEADER_X_FORWARDED_FOR |
            Illuminate\Http\Request::HEADER_X_FORWARDED_HOST |
            Illuminate\Http\Request::HEADER_X_FORWARDED_PORT |
            Illuminate\Http\Request::HEADER_X_FORWARDED_PROTO |
            Illuminate\Http\Request::HEADER_X_FORWARDED_AWS_ELB
        );
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        /**
         * The admin area must never dead-end on a raw error page. A dashboard left
         * open past its session produced "Page Expired"/500 on the next click; now
         * anything that goes wrong under /admin lands on the login page with an
         * explanation. The exception is still logged — this hides it from the
         * operator, not from us.
         */
        $exceptions->render(function (Throwable $e, Request $request) {
            if (! $request->is('admin') && ! $request->is('admin/*')) {
                return null; // public site keeps normal error handling
            }

            // Never redirect the login page to itself — that would loop forever
            // if the login view or credential check is what failed.
            if ($request->is('admin/login')) {
                return null;
            }

            // keep real stack traces while developing
            if (config('app.debug')) {
                return null;
            }

            // An unmatched URL is rejected during routing, before the web group runs,
            // so there may be no session on the request at all — touching it would
            // throw a second exception from inside this handler.
            $signedIn = $request->hasSession() && $request->session()->has('admin_ok');

            // Flashing needs a started session; fall back to a plain redirect without one.
            $go = function (string $route, string $message) use ($request) {
                $redirect = redirect()->route($route);

                return $request->hasSession() ? $redirect->with('status', $message) : $redirect;
            };

            // A missing document or unknown admin URL is not a session problem.
            if ($e instanceof NotFoundHttpException || $e instanceof ModelNotFoundException) {
                return $signedIn
                    ? $go('admin.dashboard', 'That item could not be found — it may have been removed.')
                    : $go('admin.login', 'Please sign in to continue.');
            }

            $expiredSession = $e instanceof TokenMismatchException
                || $e instanceof AuthenticationException
                || ($e instanceof HttpExceptionInterface && in_array($e->getStatusCode(), [401, 419], true));

            if (! $expiredSession) {
                // genuine fault — record it before sending the operator away
                Log::error('Admin area error', [
                    'url'       => $request->fullUrl(),
                    'exception' => get_class($e),
                    'message'   => $e->getMessage(),
                ]);
            }

            if ($request->hasSession()) {
                $request->session()->forget(['admin_ok', 'admin_last_seen']);
            }

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json(['ok' => false, 'expired' => true], 401);
            }

            return $go('admin.login', $expiredSession
                ? 'Your session expired. Please sign in again.'
                : 'Something went wrong and you were signed out. Please sign in and try again.');
        });
    })->create();
