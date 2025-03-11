<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectDashboard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */


// App/Http/Middleware/RoleDashboardMiddleware.php

public function handle(Request $request, Closure $next): Response
{
    if (Auth::check()) {
        $redirectRoute = '/';
        if(Auth::user()->type == 1){
            $redirectRoute = '/admin/dashboard';
        }else{
            $redirectRoute = '/member/dashboard';
        }

        // switch (Auth::user()->type) {
        //     case 1:
        //         $redirectRoute = '/admin/dashboard';
        //         break;
        //     case 2:
        //         $redirectRoute = '/member/dashboard';
        //         break;
        //     // Add more cases for other user types if needed

        //     // Default case, e.g., for unknown user types
        //     default:
        //         $redirectRoute = '/'; // Redirect to the default route or handle it according to your needs
        //         break;
        // }

        // Check if the user is already on the correct dashboard route
        if ($request->path() !== ltrim($redirectRoute, '/')) {
            return redirect($redirectRoute);
        }
    }

    return $next($request);
}


}
