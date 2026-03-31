<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enquiry;

class EnquiryController extends Controller
{
    public function form()
    {
        return view('enquiry');
    }

    public function store(Request $request)
    {
        Enquiry::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ]);

        return "Enquiry Submitted Successfully";
    }
}