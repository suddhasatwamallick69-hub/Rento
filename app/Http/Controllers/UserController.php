<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use DateTime;
use App\Models\Otp_verification;
use App\Models\Profile_details;
use App\Mail\welcomeemail;
use App\Mail\Vehiclebooked;
use App\Models\Vehicle_categories;
use App\Models\Vehicle;
use App\Models\Vehicle_rate;
use App\Models\Booking;
use App\Models\Booking_status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class UserController extends Controller
{
    public function index()
    {
        $route='index';
        date_default_timezone_set('Asia/Kolkata');
        $date = date("Y-m-d H:00");
        $pickup = date("Y-m-d H:00", strtotime('+1 hour', strtotime($date)));
        $dropoff = date("Y-m-d H:00", strtotime('+4 hour', strtotime($pickup)));

        

        return view('index',compact('pickup','dropoff'));
    }
    public function ins_search(Request $request)
    {
        $pickup = $request->pickup;
        $dropoff = $request->dropoff;
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $location = $request->location;

        
        if($pickup>=$dropoff)
        {
            return redirect()->back()->withErrors(['error'=>'Pickup time cannot be greater than Dropofftime']);
        }

        $w=[
            'pickup'=>$pickup,
            'dropoff'=>$dropoff,
            'latitude'=>$latitude,
            'longitude'=>$longitude,
            'location'=>$location
        ];
        return redirect()->route('listofvehicles',$w);
    }
    public function listofvehicles(Request $r)
    {
        date_default_timezone_set('Asia/Kolkata');
        $invalidVehicles = Vehicle::where('validity_date', '<', now())->get();

        foreach ($invalidVehicles as $vehicle) 
        {
            $vehicle->availability = 'No';
            $vehicle->approval = 'No'; // Unlist vehicle
            $vehicle->update();
        }
        $pickup = $r->pickup;
        $dropoff = $r->dropoff;
        $latitude = $r->latitude;
        $longitude = $r->longitude;
        $location = $r->location;
        $pickup_obj=new DateTime($pickup);
        $dropoff_obj=new DateTime($dropoff);
        $duration = $pickup_obj->diff($dropoff_obj);

        if($pickup>=$dropoff)
        {
            return redirect()->back()->withErrors(['error'=>'Pickup time cannot be greater than Dropofftime']);
        }

        $duration = ($duration->days * 24) + $duration->h + ($duration->i / 60);
        // echo "Total duration: " . round($totalHours, 2) . " hours";

        $categories=Vehicle_categories::where('parent_id',0)->get();
        $distinctFuelTypes = Vehicle::select('fuel_type')->distinct()->pluck('fuel_type');

        $subcategories = [];
        $vrate = [];
        foreach ($categories as $category) 
        {
                $id=$category->id;
                $subcategories[$id]=Vehicle_categories::where('parent_id',$id)->get();
                
        }
        // Calculate the buffer time (drop-off + 2 hours)
        $buffer_time = date('Y-m-d H:i:s', strtotime($dropoff . ' +2 hours'));

        // Fetch only available vehicles with no overlapping bookings
        $vehicles = Vehicle::select('*', DB::raw("(
            6371 * acos(
                cos(radians($latitude)) * cos(radians(latitude)) *
                cos(radians(longitude) - radians($longitude)) +
                sin(radians($latitude)) * sin(radians(latitude))
            )
        ) AS distance"))
        ->where('availability', 'Yes')
        ->where('approval', 'Yes')
        ->whereDoesntHave('bookings', function ($query) use ($pickup) {
            $query->where('dropoff_date', '>', date('Y-m-d H:i:s', strtotime($pickup . ' -2 hours')));
        })
        ->orderBy('distance')
        ->get();    
        $numberOfRows = Vehicle::where('availability', 'Yes')
        ->where('approval', 'Yes')
        ->whereDoesntHave('bookings', function ($query) use ($pickup) {
            $query->where('dropoff_date', '>', date('Y-m-d H:i:s', strtotime($pickup . ' -2 hours')));
        })->count();
        foreach($vehicles as $item)
        {
            $id=$item->id;
            $vrate[$id]=Vehicle_rate::where('vid',$id)->get();
        }
        $w=[
            'vehicles'=>$vehicles,
            'categories' => $categories,
            'subcategories' => $subcategories,
            'vrate' => $vrate,
            'pickup' => $pickup,
            'dropoff' => $dropoff,
            'duration' => $duration,
            // 'buffer_time' => $buffer_time,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'location' => $location,
            'numberOfRows' => $numberOfRows,
            'distinctFuelTypes' => $distinctFuelTypes,
        ];
        return view('vehicles')->with($w);
    }
    public function login_register()
    {
        return view('login_register');
    }
    public function register(Request $request)
    {
        $data=$request->validate([
            'phone_number'=>'required|unique:users,phone_number',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|confirmed',
        ]);
        Session::put([
            'user_data' => $data
        ]);
        $otp=rand(100000,999999);
        $email= $data['email'];
        Otp_verification::updateOrCreate(
            ['email' => $email],
            [
                'otp' => $otp,
            ]);
            Mail::raw("Your OTP for registration is: $otp", function ($message) use ($email) {
                $message->to($email)->subject('Your OTP Code');
            });
        return redirect()->route('authenticate');
    }
    public function authenticate()
    {
        return view('authenticate');
    }
    public function otp_verification(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);
        $userData = Session::get('user_data');
        if (!$userData) 
        {
            return redirect()->route('register')->withErrors(['error' => 'Session expired. Please register again.']);
        }
        $otpRecord = Otp_verification::where('email', $userData['email'])->first();
        if (!$otpRecord || $otpRecord->otp != $request->otp) 
        {
            return redirect()->back()->withErrors(['error' => 'Invalid OTP. Please try again.']);
        }
        $userData['password'] = Hash::make($userData['password']);
        $userData['role'] = 'user';
        $userData['is_verified'] = 0;
        $user= User::create($userData);
        $otpRecord->delete();
        Session::forget('user_data');
        Auth::login($user);
        $toemail=Auth::user()->email;
        $name=Auth::user()->name;
        $message="Hello $name welcome to our website";
        $subject="Welcome to Rento";
        $r=Mail::to($toemail)->send(new welcomeemail($message,$subject));
        if($user && Auth::check() && Auth::user()->role =='user')
        {
            return redirect()->route('index');
        }
        else
        {
            return redirect()->back()->withErrors(['Invalid credentials']);
        }
    }
    public function login(Request $request)
    {
        $credentials=$request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);
        $credentials['role'] = 'user';

        $user = User::where('email', $request->email)->where('role', 'user')->first();
        if (!$user) 
        {
            return redirect()->back()->withErrors(['Invalid credentials'], 'login');
        }
        else if (!Hash::check($request->password, $user->password)) 
        {
            return redirect()->back()->withErrors(['Incorrect password !'], 'login');
        }
        else if(Auth::attempt($credentials))
        {
            return redirect()->route('index');
        }
        else
        {
            return redirect()->back()->withErrors(['Something went wrong. Please try again.'], 'login');
        }
        
    }
    
    public function about()
    {
        return view('about');
    }
    public function search_category(Request $request)
    {
        $vrate = [];
        $pickup= $request->pickup;
        $dropoff= $request->dropoff;
        $duration= $request->duration;
        $latitude= $request->latitude;
        $longitude= $request->longitude;

        // Calculate the buffer time (drop-off + 2 hours)
        $buffer_time = date('Y-m-d H:i:s', strtotime($dropoff . ' +2 hours'));

        // Fetch only available vehicles with no overlapping bookings
        $vehicles = Vehicle::select('*', DB::raw("(
            6371 * acos(
                cos(radians($latitude)) * cos(radians(latitude)) *
                cos(radians(longitude) - radians($longitude)) +
                sin(radians($latitude)) * sin(radians(latitude))
            )
        ) AS distance"))
         ->whereIn('category',$request->categories)->where('availability', 'Yes')
        ->where('approval', 'Yes')
        ->whereDoesntHave('bookings', function ($query) use ($pickup) {
            $query->where('dropoff_date', '>', date('Y-m-d H:i:s', strtotime($pickup . ' -2 hours')));
        })
        ->orderBy('distance')
        ->get();
       $numberOfRows = Vehicle::whereIn('category',$request->categories)->where('availability', 'Yes')
       ->where('approval', 'Yes')
       ->whereDoesntHave('bookings', function ($query) use ($pickup) {
           $query->where('dropoff_date', '>', date('Y-m-d H:i:s', strtotime($pickup . ' -2 hours')));
       })->count();
        
        foreach($vehicles as $item)
        {
           $id=$item->id;
           $vrate[$id]=Vehicle_rate::where('vid',$id)->get();
        }
        
        return view('partials.search_vehicle_list', compact('vehicles','pickup','dropoff','duration','vrate','numberOfRows','latitude','longitude'))->render();
    } 
    public function search_by_fuel_type(Request $request)
    {
        $vrate = [];
        $pickup= $request->pickup;
        $dropoff= $request->dropoff;
        $duration= $request->duration;
        $latitude= $request->latitude;
        $longitude= $request->longitude;

        // Calculate the buffer time (drop-off + 2 hours)
        $buffer_time = date('Y-m-d H:i:s', strtotime($dropoff . ' +2 hours'));

        // Fetch only available vehicles with no overlapping bookings
        $vehicles = Vehicle::select('*', DB::raw("(
            6371 * acos(
                cos(radians($latitude)) * cos(radians(latitude)) *
                cos(radians(longitude) - radians($longitude)) +
                sin(radians($latitude)) * sin(radians(latitude))
            )
        ) AS distance"))
         ->whereIn('fuel_type',$request->selected_fuel_type)->where('availability', 'Yes')
        ->where('approval', 'Yes')
        ->whereDoesntHave('bookings', function ($query) use ($pickup) {
            $query->where('dropoff_date', '>', date('Y-m-d H:i:s', strtotime($pickup . ' -2 hours')));
        })
        ->orderBy('distance')
        ->get();
       $numberOfRows = Vehicle::whereIn('fuel_type',$request->selected_fuel_type)->where('availability', 'Yes')
       ->where('approval', 'Yes')
       ->whereDoesntHave('bookings', function ($query) use ($pickup) {
           $query->where('dropoff_date', '>', date('Y-m-d H:i:s', strtotime($pickup . ' -2 hours')));
       })->count();
        
        foreach($vehicles as $item)
        {
           $id=$item->id;
           $vrate[$id]=Vehicle_rate::where('vid',$id)->get();
        }
        
        return view('partials.search_vehicle_by_fuel_type', compact('vehicles','pickup','dropoff','duration','vrate','numberOfRows','latitude','longitude'))->render();
    }
    
    public function booking(Request $r)
    {
        $id=$r->bid;
        $duration=$r->duration;
        $pickup=$r->pickup;
        $dropoff=$r->dropoff;
        $vehicle=Vehicle::find($id);
        $vrate=Vehicle_rate::where('vid',$id)->first();
        session()->forget(['orderId', 'amount','bid','paymentcount']);
        return view('booking', compact('vehicle','vrate','duration','pickup','dropoff'));
    }

    public function mybooking()
    {
        $id=Auth::user()->id;
        $vehicle = [];
        $booking_status=[];
        date_default_timezone_set('Asia/Kolkata');
        $currentDateTime = date("Y-m-d H:i:s");
        $pastBookings = Booking::where('uid', $id)->where('dropoff_date', '<', $currentDateTime)->orderBy('dropoff_date', 'desc')->get();  
        $upcomingBookings = Booking::where('uid', $id)->orderBy('pickup_date', 'desc')->get();
        foreach($upcomingBookings as $item)
        {
            $vid=$item->vid;
            $bid=$item->id;
            $vehicle[$vid]=Vehicle::where('id',$vid)->get();
            $booking_status[$bid]=Booking_status::where('bid',$bid)->get();
        }
        // echo "<pre>";
        // print_r($pastBookings->toArray());
        // echo "</pre>";
        // echo "<pre>";
        // print_r($upcomingBookings->toArray());
        // echo "</pre>";
        // echo $currentDateTime;
        return view("mybookings",compact('upcomingBookings','pastBookings','currentDateTime','vehicle','booking_status'));
    }
    public function trip(Request $r)
    {
        $bid=$r->bid;
        $Booking = Booking::where('id', $bid)->first();
        $vehicle = Vehicle::where('id', $Booking->vid)->first();
        $booking_status=Booking_status::where('bid',$bid)->first();
        date_default_timezone_set('Asia/Kolkata');
        $currentDateTime = date("Y-m-d H:i:s");
        return view("trip",compact("Booking","booking_status","vehicle","currentDateTime"));
    }
    public function myprofile()
    {
        $id=Auth::user()->id;
        $user=User::find($id);
        $userdata=Profile_details::where('uid', $id)->first();
        if($userdata=='')
        {
           $aadhar='';
           $driving_license='';
        }
        else{
            $aadhar=$userdata->aadhar_number;
            $driving_license=$userdata->driving_license;
        }
        return view('myprofile',compact('user','aadhar','driving_license'));
    }
    public function updateprofile(Request $r)
    {
        $name=$r->name;
        $id=Auth::user()->id;
        User::where('id',$id)->update([
            'name'=>$name,
        ]);
        return redirect()->back();
    }
    public function verifyprofile()
    {
        if(Auth::check() && Auth::user()->role =='user')
        {
            $id=Auth::user()->id;
           
            $w=[
                "phone_number"=>$phone,
                "aadhar_number"=>$aadhar,
                ];
            return view('verifyprofile')->with($w);
        }
    }
    public function ins_verifyprofile(Request $r)
    {
        $id=Auth::user()->id;
        Profile_details::updateOrCreate(
            ['uid' => $id],
            [
                'driving_license' => $r->Driving_Lisence,
                'aadhar_number' => $r->aadhar_number,
                'uid' => $id,
            ]);
            User::where('id',$id)->update([
                'is_verified'=>1,
            ]);
            return redirect()->route('myprofile');
    }
    
    public function logout_user()
    {
        Auth::logout();
        return redirect()->route('index');
    }
    public function welcome()
    {
        return view("welcome");
    }
}
