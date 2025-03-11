<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function receipt(Request $request){
        $receipt = Payment::where('id', $request->id)->first();
        return view('nhs.payment.receipt', compact('receipt'));
    }
}
