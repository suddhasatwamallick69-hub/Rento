<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Vehicle_categories;
use App\Models\Vehicle;
use App\Models\Vehicle_rate;
use App\Http\Middleware\ValidUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function login()
    {
        return view('admin/index');
    }
    public function login_auth(Request $request)
    {
            $credentials=$request->validate([
                'email'=>'required',
                'password'=>'required',
            ]);
            $credentials['role'] = 'admin';
            if(Auth::attempt($credentials))
            {
                return redirect()->route('admin_dashboard');
            }
            else
            {
                return redirect()->back()->withErrors(['Invalid credentials']);
            }
    }
    public function dashboard()
    {
        date_default_timezone_set('Asia/Kolkata');
        $current_date= date("Y-m-d");
        $validVehicles = Vehicle::where('validity_date', '>', $current_date)->where('approval','No')->get();
        $InvalidVehicles = Vehicle::where('validity_date', '<=', $current_date)->get();
        Session::put('previous_route', 'admin_dashboard');
        return view('admin/dashboard',compact('validVehicles','InvalidVehicles'));
    }
    public function about()
    {
        return view('admin/about');   
    }
    public function addvehicle()
    {
        $categories=Vehicle_categories::where('parent_id',0)->get();
        $subcategories = [];
        foreach ($categories as $category) 
        {
                $id=$category->id;
                $subcategories[$id]=Vehicle_categories::where('parent_id',$id)->get();
        }
        return view('admin/add_vehicle')->with([
            'categories' => $categories,
            'subcategories' => $subcategories
        ]);
    }
    public function addvehiclecategory()
    {
        $categories=Vehicle_categories::where('parent_id',0)->get();
                $w=[
                        "categories"=>$categories,
                   ];
        return view("admin/add_vehicle_category")->with($w);
    }
    public function vehicle_category_submit(Request $request)
    {
        $credentials=$request->validate([
            'name'=>'required',
            'parent_id'=>'required',
            'description'=>'required',
            'image'=>'required|mimes:png,jpg,jpeg',
        ]);

        $img=$request->file('image');
        $fn=time().$img->getClientOriginalName();
        $img->move("Vehicle_category_image/",$fn);
        
        $credentials['image'] = $fn;

        print_r($credentials);
        Vehicle_categories::create($credentials);
        return redirect()->route('addvehiclecategory');
    }
    public function list_category()
    {
        $list_vehicle_category=Vehicle_categories::all();
        $w=[
            "list"=>$list_vehicle_category,
        ];
        return view("admin/view_category")->with($w);

    }
    public function list_vehicle()
    {
        Session::put('previous_route', 'list_vehicle');
        $list_vehicle=Vehicle::all();
        $w=[
            "list_vehicle"=>$list_vehicle,
            ];
        return view('admin/list_vehicle')->with($w);
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
            return view('admin/vehicle_details')->with($w);
    }
    public function manage_vehicle()
    {
        Session::put('previous_route', 'manage_vehicle');
        $verify_vehicle=Vehicle::all();
        $w=[
            "verify_vehicle"=>$verify_vehicle,
            ];
        return view('admin/manage_vehicle')->with($w);
    }
    public function search_by_approval(Request $request)
    {
        $approval=$request->approval;
        // echo $approval;
        if($approval=='Yes')
        {
            $verify_vehicle=Vehicle::where('approval','Yes')->get();
            return view('admin.partials.search_by_approval', compact('verify_vehicle'))->render();
        }
        elseif($approval=='No')
        {
            $verify_vehicle=Vehicle::where('approval','No')->get();
            return view('admin.partials.search_by_approval', compact('verify_vehicle'))->render();
        }
    }
    public function search_by_listing(Request $request)
    {
        $listing=$request->listing;
        if($listing=='Yes')
        {
            $verify_vehicle=Vehicle::where('availability','Yes')->get();
            return view('admin.partials.search_by_listing', compact('verify_vehicle'))->render();
        }
        elseif($listing=='No')
        {
            $verify_vehicle=Vehicle::where('availability','No')->get();
            return view('admin.partials.search_by_listing', compact('verify_vehicle'))->render();
        }
    }
    public function search_by_validity(Request $request)
    {
        $validity=$request->validity;
        date_default_timezone_set('Asia/Kolkata');
        $current_date = date("Y-m-d");
        
        if($validity=='Yes')
        {
            $verify_vehicle = Vehicle::where('validity_date', '>', $current_date)->get();
            return view('admin.partials.search_by_validity', compact('verify_vehicle'))->render();
        }
        elseif($validity=='No')
        {
            $verify_vehicle = Vehicle::where('validity_date', '<=', $current_date)->get();
            return view('admin.partials.search_by_validity', compact('verify_vehicle'))->render();
        }
    }
    public function search_by_host_name(Request $request)
    {
        $input=$request->input;
        $input_none=$request->input_none;
        if($input)
        {
            $verify_vehicle = Vehicle::where('name', 'like', '%' . $input . '%')->get();
            if($verify_vehicle->isEmpty())
            {
                echo "No Host found with this name";
            }
            else
            {
                return view('admin.partials.search_by_host_name', compact('verify_vehicle'))->render();
            }  
        }
        elseif($input_none=='')
        {
            $verify_vehicle = Vehicle::all();
            return view('admin.partials.search_by_host_name', compact('verify_vehicle'))->render();
        }
    }
    public function approvevehicle(Request $r)
    {
        $vid=$r->vid;
        $approval=$r->approval;
        $availability=$r->availability;
        echo $vid;

        if ($approval == 'No') {
            Vehicle::where('id',$vid)->update([
                'approval'=>'Yes',
            ]);
        } elseif ($availability == 'Yes') {
            Vehicle::where('id',$vid)->update([
                'availability'=>'No',
            ]);
        } else {
            Vehicle::where('id',$vid)->update([
                'availability'=>'Yes',
            ]);
        }
        return redirect()->back();
    }
    public function set_price(Request $r)
    {
        $vid=$r->vid;
        $price=$r->price;
        // echo $vid;
        // echo"<br>";
        // echo $price;
        Vehicle_rate::updateOrCreate(
            ['vid' => $vid],
            [
            'vid'=> $vid,
            'rate_per_hour'=> $price,
        ]);

        return redirect()->back()->with(['price'=>$price]);
    }

    public function update_vehicle(Request $r)
    {
        $vid=$r->vid;
        $registration_number=$r->registration_number;
        $registration_date=$r->registration_date;
        $validity_date=$r->validity_date;
        echo $vid;
        echo $registration_number;
        echo $registration_date;
        echo $validity_date;
        Vehicle::where('id',$vid)->update([
            'registration_number'=> $registration_number,
            'registration_date' => $registration_date,
            'validity_date' => $validity_date,
        ]);
        return redirect()->back();
        
    }
    
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
