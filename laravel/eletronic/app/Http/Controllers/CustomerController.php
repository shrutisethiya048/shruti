<?php
namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

class CustomerController extends Controller
{
    public function index()
{
    $customers = Customer::latest()->get();
    return view('admin.customer', compact('customers'));
}
    // Show all customers
    public function allshow()
    {
        return response()->json(Customer::all());
    }

    // Add customer API
    public function add(Request $request)
    {
        $customer = new Customer();

        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->password = $request->password;

        $customer->save();

        return response()->json([
            'msg' => 'Customer Added Successfully',
            'data' => $customer
        ]);
    }

    // Show login page
    public function login()
    {
        return view('website.login');
    }

    // Login authentication
    public function login_auth(Request $request)
    {

        $customer = Customer::where('email',$request->email)->first();

        if($customer){

            if($request->password == $customer->password){

                session([
                    'customer_id'=>$customer->id,
                    'customer_name'=>$customer->name
                ]);

                return redirect()->route('profile');

            }else{
                return back()->with('error','Password incorrect');
            }

        }else{
            return back()->with('error','Email not found');
        }

    }
// forgot password
public function forgotPassword()
{
    return view('website.forgot-password');
}
 // Generate OTP
 public function sendResetLink(Request $request)
{
    $otp = rand(100000,999999);

    Session::put('otp',$otp);
    Session::put('email',$request->email);

    $email = $request->email;

    Mail::raw("Your OTP for password reset is: ".$otp, function($message) use ($email){
        $message->to($email);
        $message->subject('Password Reset OTP');
    });

    return redirect('/otp-verification');
}
// OTP Page
public function otpPage()
{
    return view('website.otp-verification');
}
// Verify OTP
public function verifyOtp(Request $request)
{
    if($request->otp == session('otp'))
    {
        return redirect('/reset-password');
    }
    else
    {
        return back()->with('error','Invalid OTP');
    }
}
public function resetPassword()
{
    return view('website.reset-password');
}
public function updatePassword(Request $request)
{
    DB::table('customers')
        ->where('email',session('email'))
        ->update([
            'password'=>$request->password
        ]);

    Session::forget('otp');

    return redirect('/login')->with('success','Password Updated Successfully');
}
    // Show signup page
    public function create()
    {
        return view('website.signup');
    }

    // Store signup
    public function store(Request $request)
    {

        $customer = new Customer();

        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->password = $request->password;

        $customer->save();

        return redirect()->route('login')->with('success','Signup Successful');
    }

    // Profile
    public function profile()
    {
        if(!session()->has('customer_id')){
            return redirect()->route('login');
        }

        $customer = Customer::find(session('customer_id'));

        return view('website.profile',compact('customer'));
    }

    // Edit profile
    public function editProfile($id)
{
    $customer = Customer::find($id);

    return view('website.edit_profile', compact('customer'));
}

    public function updateProfile(Request $request, $id)
{
    $customer = Customer::find($id);

    $customer->name = $request->name;
    $customer->email = $request->email;

    // Image Upload
    if($request->hasFile('image'))
    {
        $file = $request->file('image');
        $filename = time().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('uploads/customers'), $filename);

        $customer->image = $filename;
    }

    $customer->save();

    return redirect()->route('profile')->with('success','Profile Updated Successfully');
}
    // Logout
    public function logout()
    {
        session()->flush();
        return redirect()->route('login');
    }

}