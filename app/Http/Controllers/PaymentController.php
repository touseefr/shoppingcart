<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Softon\Indipay\Facades\Indipay;  

class PaymentController extends Controller
{
    public function pay(Request $request)
    {
        return $request->all();
       /**
         * amount
         * productinfo
         * firstname
         * email
         * phone
         */
        $params = [
            'amount'        => $request->amount,
            'productinfo'   => 'Test product',
            'firstname'     => 'THe Test Coder',
            'email'         => 'thetestcoder@gmail.com',
            'phone'         => '123456789'
        ];

       // $order = Indipay::prepare($params);
      //  return Indipay::process($order);
        
        
    }
}
