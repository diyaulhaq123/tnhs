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
        if(auth()->user()->type == 2){
            $payment = Payment::where('user_id', auth()->user()->id)
                ->where('payment_type_id', 1)
                ->where('remark', 'success')
                ->latest()
                ->first();


            if(empty($payment)){
                return redirect(route('membership.pay'));
            }else{

                if($payment && $payment->created_at->addYear() < now()){
                    return redirect(route('membership.pay'));
                }
                if(auth()->user()->completed_profile != 1){
                    return redirect(route('profile.create'));
                }

            }
        }

        return $next($request);
    }
}
