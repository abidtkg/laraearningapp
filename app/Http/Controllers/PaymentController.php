<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use App\Models\Paymentmethods;


class PaymentController extends Controller
{
    public function methods()
    {
        return Paymentmethods::all();
    }

    public function createMethod(Request $request)
    {
        if(!$request->input('name'))
        {
            return ['error' => 'Name Required'];
        }
        if(!$request->input('minimum_amount'))
        {
            return ['error' => 'Minimum Amount Required'];
        }

        $payment_method = Paymentmethods::create([
            'name' => $request->input('name'),
            'minimum_amount' => $request->input('minimum_amount'),
            'is_active' => true
        ]);
        if($payment_method)
        {
            return \response(
                ['message' => 'Payment method created', 'data' => $payment_method],
                Response::HTTP_OK);
        }else{
            return \response(
                ['error' => '500 Internal Server Error'],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }


    }
}
