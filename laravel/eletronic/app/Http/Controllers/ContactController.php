<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    // Show all contacts (Admin Panel)
    public function index()
    {
        $contacts = Contact::latest()->get();
        return view('admin.contact', compact('contacts'));
    }

    // Store contact (Website Form)
    public function store(Request $request)
    {
        // Validation with UNIQUE email
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255|unique:contacts,email',
            'phone'   => 'required|max:15',
            'message' => 'nullable|string',
        ]);

        // Save in database
        $contact = Contact::create($validated);

        // Mail data
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message
        ];

        // Send email
        Mail::send('welcome', $data, function($message) use ($request) {
            $message->to($request->email);
            $message->subject('Contact Message Received');
        });

        return redirect()->back()->with('success', 'Contact added successfully');
    }

    // Edit contact (Admin Panel)
    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
        return view('admin.contact_edit', compact('contact'));
    }

    // Update contact
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'    => 'required|string',
            'email'   => 'required|email|unique:contacts,email,'.$id,
            'phone'   => 'required',
            'message' => 'nullable|string',
        ]);

        $contact = Contact::findOrFail($id);
        $contact->update($request->all());

        return redirect()->route('contact.index')
                         ->with('success', 'Contact updated successfully');
    }

    // Delete contact
    public function destroy($id)
    {
        Contact::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Contact deleted successfully');
    }
}