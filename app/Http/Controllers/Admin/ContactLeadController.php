<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactLead;
use Illuminate\Http\Request;

class ContactLeadController extends Controller
{
    /**
     * Display listing of contact leads.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = ContactLead::query();

        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        $leads = $query->orderBy('created_at', 'desc')->get();
        return view('admin.leads.index', compact('leads', 'search'));
    }

    /**
     * Store new contact lead from the public form.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        ContactLead::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Thank you for contacting Aerovia! Our team will get back to you shortly.');
    }

    /**
     * Remove the specified contact lead.
     */
    public function destroy($id)
    {
        $lead = ContactLead::findOrFail($id);
        $lead->delete();

        return redirect()->route('admin.leads.index')->with('success', 'Contact lead deleted successfully!');
    }
}
