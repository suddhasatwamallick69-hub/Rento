<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use DateTime;
use App\Models\Payment;
use App\Mail\Vehiclebooked;
use App\Models\Booking;
use Illuminate\Support\Str;
use App\Models\Vehicle;
use App\Models\Booking_status;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\Otp_verification;
use App\Models\User;

class PaymentController extends Controller
{
    public function booking_payments(Request $request)
    {
        if(Auth::user()->is_verified==1)
        {
        $amount = $request->amount * 100;
        // echo $amount;
        date_default_timezone_set('Asia/Kolkata');
        $date = date("Y-m-d H:i:s");
        $data=$request->validate([
            'vid'=>'required',
            'uid'=>'required',
            'hid'=>'required',
            'pickup_date'=>'required',
            'dropoff_date'=>'required',
            'address'=>'required',
            'landmark'=>'required',
            'area'=>'required',
            'house_no'=>'required',
            'pincode'=>'required',
            'pickup_date'=>'required',
            'dropoff_date'=>'required',
        ]);
        $data['booking_date']=$date;
        $data['city']='kolkata';

        // print_r($data);
        $booking=Booking::create($data);
        $bookingId = $booking->id;

        $bookingReference = strtoupper(Str::random(8));
        $booking_status['bid']=$bookingId;
        $booking_status['booking_reference']=$bookingReference;
        $booking_status['status']='pending';

        Booking_status::create($booking_status);



        $api = new Api(env('RAZORPAY_KEY'),env('RAZORPAY_SECRET'));
        $orderData =[
            'receipt'=>'order_'.rand(1000,9999),
            'amount'=>$amount,
            'currency'=>'INR',
            'payment_capture' =>1
        ];
        $razorpay_order = $api->order->create($orderData);

        $payments['bid']=$bookingId;
        $payments['uid']=Auth::user()->id;
        $payments['order_id']=$razorpay_order["id"];
        $payments['status']='pending';
        $payments['amount']=$request->amount;
        $payments['date']=$date;
        Payment::create($payments);

        session([
            'orderId' => $razorpay_order["id"],
            'amount' => $request->amount,
            'bid' => $bookingId,
            'bookingReference' => $bookingReference,
            'paymentcount' => 0,
        ]);

        // echo session('amount');
        return redirect()->route('payments',['id' => $bookingReference]);
        }
        else
        {
            return redirect()->back()->withErrors('Profile Not verified');
        }
    }
    public function payments(Request $request)
    {
        $bookingReference = $request->id;
        $booking = Booking_status::where('booking_reference', $bookingReference)->firstOrFail();

        if (!$booking) {
            return redirect()->route('index');
        }

        $bookingId=$booking->bid;
        $Booking_status=Booking_status::where('bid', $bookingId)->first();

        $payment_status=Payment::where('bid', $bookingId)->first();

        if ($Booking_status->status === 'confirmed' && $payment_status->status === 'paid') {
            return redirect()->route('index');
        }

        return view("payments", [
            'orderId' => session('orderId'),
            'amount' => session('amount'),
            'booking' => $booking,
        ]);
    }
    public function payment_status(Request $request)
    {
        // Validate request parameters
        $orderId = $request->order_id;
        $bid = $request->bid;
        $razorpayPaymentId = $request->razorpay_payment_id;

        echo $orderId;
        echo $razorpayPaymentId;

        // if (!$orderId || !$razorpayPaymentId) {
        //     return response()->json(['success' => false, 'message' => 'Missing order ID or payment ID.'], 400);
        // }

        // // Find payment record

        // if (!$payment) {
        //     return response()->json(['success' => false, 'message' => 'Payment record not found!'], 404);
        // }

        // Update payment status
        $update=Payment::where('order_id', $orderId)->update([
            'status' => 'paid',
            'payment_id' => $razorpayPaymentId
        ]);
        // Update booking status
        Booking_status::where('bid', $bid)->update(['status' => 'confirmed']);

        $booking = Booking::where('id', $bid)->first();
        $vid=$booking->vid;

        $booking_date = date('d M Y', strtotime($booking->booking_date));
        $pickup_date = date('d M, g:i A', strtotime($booking->pickup_date));
        $dropoff_date = date('d M, g:i A', strtotime($booking->dropoff_date));
        $pickup_obj=new DateTime($pickup_date);
        $dropoff_obj=new DateTime($dropoff_date);
        $duration = $pickup_obj->diff($dropoff_obj);
        $duration_in_days = $duration->format('%d days');
        $duration_in_hours = $duration->format('%h hours');

        $Booking_status = Booking_status::where('bid', $bid)->first();
        $booking_reference = $Booking_status->booking_reference;

        $vehicle = Vehicle::where('id', $vid)->first();
        $vname=$vehicle->model_name;
        $vcategory=$vehicle->category;
        $hostname=$vehicle->name;
        $vcapacity=$vehicle->capacity;
        $host_phone_number=$vehicle->phone_number;

        $uid=Auth::user()->id;
        $user=User::find($uid);
        $otp=rand(100000,999999);
        $email= $user->email;
        Session::put([
            'user_email' => $email,
            'booking_id' => $bid,
        ]);
        Otp_verification::updateOrCreate(
            ['email' => $email],
            [
                'otp' => $otp,
            ]);
            Mail::raw("Vehicle Verification OTP at Rento is: $otp", function ($message) use ($email) {
                $message->to($email)->subject('Your OTP Code');
            });

            $name=Auth::user()->name;
            $message="$name your booking for $vname has been confirmed of $vcategory category and $vcapacity capacity  , from $pickup_date to $dropoff_date at $booking_date for $duration_in_days and $duration_in_hours. Your booking id is $booking_reference";
            $subject="Vehicle Booked";
            $r=Mail::to($email)->send(new Vehiclebooked($message,$subject));

        // Vehicle::where('id', $vid)->update([
        //     'availability' => 'No',
        // ]);

        // Clear session
        session()->forget(['orderId', 'amount','bid','bookingReference','paymentcount']);
    }
}
