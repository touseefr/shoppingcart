  
<?php
//namespace App\billings\gateways;
use App\Billings;
use Illuminate\Http\Request;
//use payment;

class StripeGateway implements PaymentGatewayInterface
{

    public function process(Request $request)
    {
        // TODO: Implement process() method.
    }

    public function checkout($res)
    {
        // TODO: Implement checkout() method.
    }
}