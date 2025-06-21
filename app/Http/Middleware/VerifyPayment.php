<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Payment;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyPayment
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if ($user->type == 1) {
            return $next($request);
        }

        if ($user->type == 2) {
            $payment = Payment::where('user_id', $user->id)
                ->where('payment_type_id', 1)
                ->where('remark', 'success')
                ->latest()
                ->first();
            if (!$payment) {
                return redirect()->route('membership.pay');
            }

        }
        return $next($request);
    }
}
