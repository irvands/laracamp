<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Checkout;
use Illuminate\Http\Request;
use App\Models\Camp;
use App\Http\Requests\User\Checkout\Store;
use App\Mail\Checkout\AfterCheckout;
use Auth;
use Mail;
use Midtrans;
use Str;


class CheckoutController extends Controller
{
    public function __construct(){
        Midtrans\config::$serverKey = env('MIDTRANS_SERVERKEY');
        Midtrans\config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        Midtrans\config::$isSanitized = env('MIDTRANS_IS_SANITIZED');
        Midtrans\config::$is3ds = env('MIDTRANS_IS_3DS');
    }
    public function index()
    {
        return view ('checkout.create');
    }

    
    public function create(Camp $camp, Request $request)
    {    
        //cek apakah user sudah terdaftar di camp yang sama
        if($camp->isRegistered){
            $request->session()->flash('error', "You have already registered on {$camp->title} Camp.");
            
            return redirect(route('user.dashboard'));
        }

        $userEmail = Auth::user()->email;
        return view ('checkout.create',[
            'camp'  => $camp,
            'userEmail'    => $userEmail
        ]);
    }

    
    public function store(Store $request, Camp $camp)
    {
        // return $camp;
        // return $request->all();

        //mapping request data
        $data               =   $request->all();
        $data['user_id']    =   Auth::id();
        $data['camp_id']    =   $camp->id;

        //update data  user
        $user = Auth::user();
        // return $data['email'];
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->occupation = $data['occupation'];
        $user->save();

        

        //store data checkout
        $checkout  = Checkout::create($data);
        $this->getSnapToken($checkout);
        
        
        
        Mail::to(Auth::user()->email)->send(new AfterCheckout($checkout));

        return redirect(route('checkout.success'));
    }

    public function show(Checkout $checkout)
    {
        
    }

    
    public function edit(Checkout $checkout)
    {
        
    }

    
    public function update(Request $request, Checkout $checkout)
    {
        
    }

    public function destroy(Checkout $checkout)
    {
        
    }

    public function successCheckout(){
        return view('checkout.success');
    }


    public function getSnapToken(Checkout $checkout){

        $orderID = $checkout->id.'-'.Str::random(5);
        $price = $checkout->Camp->price * 1000;

        $checkout->midtrans_booking_code = $orderID;

        $transcation_details = [
            'order_id' => $orderID,
            'gross_amount'  => $price
        ];

        $item_details[] = [
            'id' => $orderID,
            'price' => $price,
            'quantity' => 1,
            'name' => "Payment for {$checkout->Camp->title} Camp"   
        ];

        $userData = [
            'first_name' => $checkout->User->name,
            'last_name' => "",
            'address' => $checkout->User->address,
            'city' => "",
            'postal_code' => "",
            'phone' => $checkout->User->phone,
            'country_code' => "IDN",
        ];

        $customer_details = [
            'first_name' => $checkout->User->name,
            'last_name' => "",
            'email' => $checkout->User->email,
            'phone' => $checkout->User->phone,
            'billing_address' => $userData,
            'shipping_address' => $userData
        ];

        $midtrans_params = [
            'transaction_details' => $transcation_details,
            'customer_details' => $customer_details,
            'item_details'  =>  $item_details
        ];

        // return $midtrans_params;

        try {

            $snapToken = \Midtrans\Snap::getSnapToken($midtrans_params);
            $checkout->midtrans_snap_token = $snapToken;
            $checkout->save();

            return $snapToken;

        } catch (Exception $e) {
            return false;
        }
    }

    public function midtransCallback(Request $request){

        $notif = \Midtrans\Notification();

        $transaction_status = $notif->transaction_status;
        $fraud  = $notif->fraud_status;

        $checkout_id = explode('-', $notif->order_id)[0];
        $checkout = Checkout::find($checkout_id);

        if($transaction_status == 'capture'){

            if($fraud == 'challenge'){
                $checkout->payment_status = 'pending';
            }else if($fraud == 'accept'){
                $checkout->payment_status = 'paid';
            }

        }
        else if($transaction_status == 'cancel'){

            if($fraud == 'challenge'){
                $checkout->payment_status = 'failed';
            }else if($fraud == 'accept'){
                $checkout->payment_status = 'failed';
            }

        }
        else if($transaction_status == 'deny'){
            
            $checkout->payment_status = 'failed';
        
        }
        else if($transaction_status == 'settlement'){

            $checkout->payment_status = 'paid';
            
        }
        else if($transaction_status == 'pending'){

            $checkout->payment_status = 'pending';
        
        }
        else if($transaction_status == 'expired'){

            $checkout->payment_status = 'failed';
            
        }

        $checkout->save();

        return view('checkout/success');

    }

    // public function debug(){

    //     $transcation_details = [
    //         'order_id' => '2-kdfkd',
    //         'gross_amount'  => 100000
    //     ];

    //     $item_details[] = [
    //         'id' => '2-kdfkd',
    //         'price' => 100000,
    //         'quantity' => 1,
    //         'name' => "Payment for dsds Camp"   
    //     ];



    //     $midtrans_params[] = [
    //         'transaction_details' => $transcation_details,
    //         'item_details'  =>  $item_details
    //     ];

    //     return $midtrans_params;
    // }
}
