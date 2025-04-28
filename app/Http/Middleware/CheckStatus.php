<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckStatus
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
    
        if ($user) {
            if ($user->status == 1) {
                return $next($request);
            } else {
                Auth::logout();
                return redirect()->route('login')->with('status', 'Your account is not active.');
            }
        } else {
            return redirect()->route('login')->with('status', 'You are not authenticated.');
        }
    }
}
