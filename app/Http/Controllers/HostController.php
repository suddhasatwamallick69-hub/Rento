<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Otp_verification;
use App\Mail\welcomeemail;
use App\Models\Profile_details;
use App\Models\Vehicle_categories;
use App\Models\Vehicle;
use App\Models\Vehicle_rate;
use App\Models\Booking;
use App\Models\Booking_status;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use thiagoalessio\TesseractOCR\TesseractOCR;
use Imagick;


class HostController extends Controller
{
    public function host()
    {
        return view('host/register');
    }
    public function myhostprofile()
    {
            $id=Auth::user()->id;
            $user=User::find($id);
            $userdata=Profile_details::where('uid', $id)->first();
            if($userdata=='')
            {
               $aadhar='';
            }
            else{
                $aadhar=$userdata->aadhar_number;
            }
            return view('host/myprofile',compact('user','aadhar'));
    }
    public function ins_hostverifyprofile(Request $r)
    {
        $id=Auth::user()->id;
        Profile_details::updateOrCreate(
            ['uid' => $id],
            [
                'driving_license' => 'null',
                'aadhar_number' => $r->aadhar_number,
                'uid' => $id,
            ]);
            User::where('id',$id)->update([
                'is_verified'=>1,
            ]);
            return redirect()->route('hostdashboard');
    }
    public function hlogin()
    {
        return view('host/login');
    }
    public function host_register(Request $request)
    {
        Auth::logout();
        $data=$request->validate([
            'phone_number'=>'required',
            'email'=>'required|email',
            'password'=>'required|confirmed',
        ]);
        Session::put([
            'host_data' => $data
        ]);
        $otp=rand(100000,999999);
        $email= $data['email'];
        print_r($data);
        echo $otp;
        Otp_verification::updateOrCreate(
            ['email' => $email],
            [
                'otp' => $otp,
            ]);
            Mail::raw("Your OTP for registration as Host at Rento is: $otp", function ($message) use ($email) {
                $message->to($email)->subject('Your OTP Code');
            });
        return redirect()->route('host_authenticate');
    }
    public function host_authenticate()
    {
        return view('host/authenticate');
    }
    public function host_otp_verification(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);
        $HostData = Session::get('host_data');
        if (!$HostData) 
        {
            return redirect()->route('host')->withErrors(['error' => 'Session expired. Please register again.']);
        }
        $otpRecord = Otp_verification::where('email', $HostData['email'])->first();
        if (!$otpRecord || $otpRecord->otp != $request->otp) 
        {
            return redirect()->back()->withErrors(['error' => 'Invalid OTP. Please try again.']);
        }
        $HostData['password'] = Hash::make($HostData['password']);
        $HostData['role'] = 'host';
        $HostData['is_verified'] = 0;
        $host= User::create($HostData);
        $otpRecord->delete();
        Session::forget('host_data');
        Auth::login($host);
        $toemail=Auth::user()->email;
        $name=Auth::user()->name;
        $message="Hello $name welcome to our website as a Host";
        $subject="Welcome to Rento";
        $r=Mail::to($toemail)->send(new welcomeemail($message,$subject));
        if($host && Auth::check() && Auth::user()->role =='host')
        {
            return redirect()->route('hostdashboard');
        }
        else
        {
            return redirect()->back()->withErrors(['Invalid credentials']);
        }
    }
    public function host_inslogin(Request $request)
    {
        Auth::logout();
        $credentials=$request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);
        $credentials['role'] = 'host';
        $user = User::where('email', $request->email)->where('role', 'host')->first();
        if (!$user) 
        {
            return redirect()->back()->withErrors(['Username does not exist.'], 'login');
        }
        else if (!Hash::check($request->password, $user->password)) 
        {
            return redirect()->back()->withErrors(['Incorrect password !'], 'login');
        }
        else if(Auth::attempt($credentials))
        {
            return redirect()->route('hostdashboard');
        }
        else
        {
            return redirect()->back()->withErrors(['Invalid credentials'],'login');
        }
    }
    public function logout_host()
    {
        Auth::logout();
        return redirect()->route('host');
    }
    public function hostdashboard()
    {
        $id=Auth::user()->id;
        $host=User::where('id',$id)->first();
        if($host=='')
        {
            return view('host/host_dashboard');
        }
        else
        {
            if($host->is_verified==0)
            {
                $w=[
                    'is_verified'=>0,
                ];
                return view('host/host_dashboard')->with($w);
            }
            else
            {
                $w=[
                    'is_verified'=>1,
                ];
                return view('host/host_dashboard')->with($w);
            }
            
        }
        
    }
    public function hostvehicle()
    {
        $categories=Vehicle_categories::where('parent_id',0)->get();
        $subcategories = [];
        foreach ($categories as $category) 
        {
                $id=$category->id;
                $subcategories[$id]=Vehicle_categories::where('parent_id',$id)->get();
        }
        return view('host/host_vehicle')->with([
            'categories' => $categories,
            'subcategories' => $subcategories
        ]);
    }
    public function ins_hostvehicle(Request $request)
    {
        $id=Auth::user()->id;
        $user=User::where('id',$id)->first();
        $is_verified=$user->is_verified;
        echo $is_verified;
        if($is_verified==1)
        {
            $credentials=$request->validate([
                'phone_number'=>'required',
                'latitude'=>'required',
                'longitude'=>'required',
                'street'=>'required',
                'suburb'=>'required',
                'city'=>'required',
                'state'=>'required',
                'address'=>'required',
                'pincode'=>'required',
                'model_name'=>'required',
                'category'=>'required',
                'fuel_type'=>'required',
                'capacity'=>'required',
                // 'registration_number'=>'required',
                'registration_certificate'=>'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
                'pollution_certificate'=>'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
                'images' => 'required|array|max:16',
                'images.*'=>'image|mimes:jpg,jpeg,png|max:5120'
                ]);
                $credentials['oid']=Auth::user()->id;
                $credentials['name']=Auth::user()->name;
                $credentials['email']=Auth::user()->email;
                $credentials['availability']='No';
                $credentials['approval']='No';
                
                //Registration Certificate
                $registration_certificate=$request->file('registration_certificate');
                $rc=time().$registration_certificate->getClientOriginalName();
                $registration_certificate->move("host_vehicle_resources/",$rc);
                $credentials['registration_certificate'] = $rc;

                // Process the image or extract text (as needed)
                $image = new Imagick(public_path('host_vehicle_resources/' . $rc));
                $image->adaptiveSharpenImage(5, 3);
                $image->brightnessContrastImage(20, 10);
                $image->adaptiveResizeImage(2000, 1000);
                $processedPath = public_path('host_vehicle_resources/processed_' . $rc);
                $image->writeImage($processedPath);

                // Extract text from the processed image (optional)
                $text = (new TesseractOCR($processedPath))->run();

                echo $text;
                 echo "<br>";
                // Extract dates from text
                $rcDetails = $this->extractRCDetails($text);

    
                //driving license Certificate
                $pollution_certificate=$request->file('pollution_certificate');
                $dl=time().$pollution_certificate->getClientOriginalName();
                $pollution_certificate->move("host_vehicle_resources/",$dl); 
                $credentials['pollution_certificate']=$dl;
    
    
                $images= $request->file('images');
                $images_array = array();
                foreach($images as $image)
                {
                    $image_name=time().$image->getClientOriginalName();
                    $image->move("vehicle_images/",$image_name);
                    $images_array[] = $image_name;
                }
                $images_string = implode(',', $images_array);
                $credentials['images']=$images_string;

                $credentials['registration_number']=$rcDetails['registration_number'];
                $credentials['registration_date']=$rcDetails['registration_date'];
                $credentials['validity_date']=$rcDetails['validity_date'];
    
                echo"<pre>";
                print_r($credentials);
                echo"</pre>";

                print_r($rcDetails);
                Vehicle::create($credentials);
                return redirect()->route('host');
        }
        else
        {
            return redirect()->back()->withErrors(['Account not verified']);
        }
    }
    private function extractRCDetails($text)
{
    $details = [
        'registration_number' => null,
        'registration_date' => null,
        'validity_date' => null,
    ];

    // Normalize text
    $text = preg_replace('/\s+/', ' ', $text);

    // Match Reg. No, Reg. Date and Validity Date together
    if (preg_match('/([A-Z]{2}\d{2}[A-Z]{1,3}\d{4})\s+(\d{2}[-\/]\d{2}[-\/]\d{4})\s+(\d{2}[-\/]\d{2}[-\/]\d{4})/', $text, $match)) {
        $details['registration_number'] = $match[1];
        $details['registration_date'] = $this->formatDate($match[2]);
        $details['validity_date'] = $this->formatDate($match[3]);
    }

    return $details;
}


// Format date to Y-m-d using Carbon
private function formatDate($date)
{
    try {
        return \Carbon\Carbon::createFromFormat('d-m-Y', $date)->toDateString();
    } catch (\Exception $e) {
        return null;
    }
}

    public function hostbookings()
    {
        $id=Auth::user()->id;
        $vehicle = [];
        $booking_status=[];
        date_default_timezone_set('Asia/Kolkata');
        $currentDateTime = date("Y-m-d H:i:s"); 
        $Bookings = Booking::where('hid', $id)->orderBy('id', 'desc')->get();
        foreach($Bookings as $item)
        {
            $vid=$item->vid;
            $bid=$item->id;
            $vehicle[$vid]=Vehicle::where('id',$vid)->get();
            $booking_status[$bid]=Booking_status::where('bid',$bid)->get();
        }
        return view("host/bookings",compact('Bookings','currentDateTime','vehicle','booking_status'));
    }
    // public function verifyclient(Request $request)
    // {
    //     // $uid=$request->uid;
    //     // $id=$request->id;
    //     // echo $uid;
    //     // $user=User::find($uid);
    //     // $otp=rand(100000,999999);
    //     // $email= $user->email;
    //     // Session::put([
    //     //     'user_email' => $email,
    //     //     'booking_id' => $id,
    //     // ]);
    //     // Otp_verification::updateOrCreate(
    //     //     ['email' => $email],
    //     //     [
    //     //         'otp' => $otp,
    //     //     ]);
    //     //     Mail::raw("Vehicle Verification OTP at Rento is: $otp", function ($message) use ($email) {
    //     //         $message->to($email)->subject('Your OTP Code');
    //     //     });
    //         // return redirect()->route('authenticate_client');
    // }
    public function resend_otp_for_authenticating_client(Request $request)
    {
        $uid=$request->uid;
        $id=$request->id;
        // echo $uid;
        $user=User::find($uid);
        $email= $user->email;
        $otp = Otp_verification::where('email', $email)->first();
        $otp=$otp->otp;

        echo $otp;
            Mail::raw("Vehicle Verification OTP at Rento is: $otp", function ($message) use ($email) {
                $message->to($email)->subject('Your OTP Code');
            });
        return redirect()->route('authenticate_client',['id' => $id, 'uid' => $uid]);
    }
    public function authenticate_client(Request $request)
    {
        $uid=$request->uid;
        $id=$request->id;
        return view("host.authenticate_client",compact('uid','id'));
    }
    public function ins_authenticate_client(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);
        $uid=$request->uid;
        $id=$request->id;
        // echo $uid;
        $user=User::find($uid);
        $email= $user->email;
        
        $otpRecord = Otp_verification::where('email', $email)->first();
        if (!$otpRecord || $otpRecord->otp != $request->otp) 
        {
            return redirect()->back()->withErrors(['error' => 'Invalid OTP. Please try again.']);
        }
        else{
            Booking_status::where('bid', $id)->update([
               'status' => 'Verified',
            ]);
            return redirect()->route('hostbookings');
        }
    }

    public function end_trip_otp(Request $request)
    {
        $uid=$request->uid;
        $id=$request->id;
        echo $uid;
        $user=User::find($uid);
        $otp=rand(100000,999999);
        $email= $user->email;
        Session::put([
            'user_email' => $email,
            'booking_id' => $id,
        ]);
        Otp_verification::updateOrCreate(
            ['email' => $email],
            [
                'otp' => $otp,
            ]);
            Mail::raw("Return Vehicle OTP at Rento is: $otp", function ($message) use ($email) {
                $message->to($email)->subject('Your OTP Code');
            });
            return redirect()->route('authenticate_return');


        // return view('trip_end_otp');
    }
    public function authenticate_return()
    {
        return view("host.trip_end_otp");
    }
    public function ins_trip_end_otp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);
        $email=Session::get('user_email');
        $booking_id=Session::get('booking_id');
        $otpRecord = Otp_verification::where('email', $email)->first();
        if (!$otpRecord || $otpRecord->otp != $request->otp) 
        {
            return redirect()->back()->withErrors(['error' => 'Invalid OTP. Please try again.']);
        }
        else{
            Booking_status::where('bid', $booking_id)->update([
               'status' => 'ended',
            ]);
            return redirect()->route('hostbookings');
            Session::forget('user_email');
            Session::forget('booking_id');
        }
    }
    public function hostupdateprofile(Request $request)
    {
        $name=$request->name;
        $id=Auth::user()->id;
        User::where('id',$id)->update([
            'name'=>$name,
        ]);
        return redirect()->back();
    }
    public function myvehicles()
    {
        $id=Auth::user()->id;
        $myvehicles=Vehicle::where('oid',$id)->get();
        return view("host.myvehicles",compact('myvehicles'));
    }
    public function vehicle_details(Request $r)
    {
        $id=$r->vid;
        $vehicle_details=Vehicle::find($id);
        $vrate=Vehicle_rate::where('vid',$id)->first();
       
        if($vrate=='')
        {
            $vehicle_rate=0;
        }
        else{
            $vehicle_rate=$vrate->rate_per_hour;
        }
        $w=[
            "vehicle_details"=>$vehicle_details,
            "vehicle_rate"=>$vehicle_rate,
            ];
            return view('host.vehicle_details')->with($w);
    }
}
