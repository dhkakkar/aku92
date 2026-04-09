<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\OpdForm;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function contact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'subject' => 'required|string|max:200',
            'message' => 'required|string|max:2000',
            'phone' => 'nullable|string|max:20',
        ]);

        ContactMessage::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Message sent successfully! We will get back to you soon.',
        ]);
    }

    public function opd(Request $request)
    {
        $validated = $request->validate([
            'patient_name' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'age' => 'required|integer|min:0|max:150',
            'gender' => 'required|in:Male,Female',
            'address' => 'required|string|max:300',
            'description' => 'required|string|max:2000',
        ]);

        OpdForm::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'OPD form submitted successfully! We will contact you shortly.',
        ]);
    }
}
