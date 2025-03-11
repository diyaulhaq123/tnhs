<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VerifyMemberShip
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $payment = Payment::where('user_id', auth()->user()->id)->where('payment_type_id', 1)
        ->where('remark', 'success')->first();
        // Auth::user()->status != 1

        if(!$payment ){
            return redirect(route('membership.pay'));
        }

        // if( auth()->user()->status == 1){
        //     return $next($request);
        // }else{
        //     return redirect(route('membership.pay'));
        // }
        return $next($request);
    }
}
