<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RefundCourse;
use App\Currency;
use Auth;
use PayPal\Api\Amount;
use PayPal\Api\Refund;
use PayPal\Api\Sale;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Cartalyst\Stripe\Laravel\Facades\Stripe;

class RefundController extends Controller
{
	public function __construct()
    {
        /** PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
            $paypal_conf['client_id'],
            $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    public function index()
    {
        $refunds = RefundCourse::get();
        return view('admin.refund_order.index', compact('refunds'));
    }

    public function edit($id)
    {
    	$refunds = RefundCourse::where('id', $id)->first();
        return view('admin.refund_order.view', compact('refunds'));
    }

    public function update(Request $request, $id)
    {

    	
    	$refnn = RefundCourse::where('id', $id)->first();


    	if(Auth::check())
    	{

    		if(Auth::user()->role == "admin")
	    	{

	    		if($refnn->status == 0)
	    		{

	    			if(isset($refnn))
	    			{

    					if($refnn->payment_method == 'PayPal') 
    					{

                           $refundrequest = RefundCourse::find($refnn->id);


                            $currency = Currency::first();

                            $amt = new Amount();
                            $amt->setTotal($refundrequest->total_amount)->setCurrency($currency->currency);

                            $saleId = $refundrequest->order->sale_id;
                            $refund = new Refund();
                            $refund->setAmount($amt);
                            $sale = new Sale();                         
                            $sale->setId($saleId);
                            

                            try
                            {

                                // return $sale;
                                $refundedSale = $sale->refund($refund, $this->_api_context);
                               return $refundedSale;
                                
                                

                            }
                            catch(PayPal\Exception\PayPalConnectionException $ex){
                                return $ex;
                            }
                            catch(Exception $ex)
                            {
                                return $ex;
                            } 

                        }
                        elseif($refnn->payment_method == 'Stripe')
                        {
                             
                            $stripe = new Stripe();
                            $stripe = Stripe::make(env('STRIPE_SECRET'));

                            $charge_id = $refnn->order->transaction_id;
                            $amount = $refnn->total_amount;
                            

                            try
                            {
                                $striperefund = $stripe->refunds()
                                    ->create($charge_id, $amount, [
                                        'metadata' => [
                                            'reason' => $refnn->reason,
                                        ],
                                    ]); 

                                return $striperefund;

                                RefundTxn::create([
                                    'order_cancel_id' => $order_refund->id,
                                    'txn_id' => $striperefund['id'],
                                    'txn_fee' => null,
                                    'currency' => $order_refund->currency,
                                    'amount' => $order_refund->amount,
                                    'method' => 'stripe',
                                    'status' => 1
                                ]);   
                                $order_refund->update([
                                    'is_refunded' => 1
                                ]);         
                                flash('Refund Successful')->success();
                                return redirect('admin/refunds')->with('added', 'Refund Successful');

                            }
                            catch(\Exception $e)
                            {
                                $error = $e->getMessage();
                                flash('error in refund')->error();
                                return redirect('admin/refunds')->with('deleted', $error);
                            }
                            flash('Refund Error')->error();
                            return redirect('admin/refunds')->with('deleted', 'Refund Error');

                        }
	    				
	    			}
	    			else 
		    		{
		                return back()->with('delete', 'Refund request not found !');
		            }
	    		}
	    		else 
	    		{
	                return back()->with('delete', 'Refund already done !');
	            }
	    	}
	    	else 
	    	{
	            return back()->with('delete', '401 Unauthorized action !');
	        }
    	}
    	else 
    	{
            return back()->with('delete', '401 Unauthorized action !');
        }

    }


    public function refundwithPaypal($request, $refnn)
    {
    	

    }
}
