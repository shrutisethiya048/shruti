<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class AdminController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function adminLogin(Request $request)
    {
        // temporary login check
        if ($request->email == 'admin@gmail.com' && $request->password == '123456') {
            session(['admin_id' => 1]);
            return redirect('/admin/dashboard');
        }

        return back()->with('error', 'Invalid login details');
    }
}
