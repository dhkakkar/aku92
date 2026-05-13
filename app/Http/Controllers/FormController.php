<?php

namespace App\Http\Controllers;

use App\Mail\OpdFormSubmitted;
use App\Models\ContactMessage;
use App\Models\OpdForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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

        $now = now();
        DB::table('contact_messages')->insert(array_merge($validated, [
            'is_read'    => false,
            'created_at' => $now,
            'updated_at' => $now,
        ]));

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

        $now = now();
        $id = DB::table('opd_forms')->insertGetId(array_merge($validated, [
            'status'     => 'pending',
            'created_at' => $now,
            'updated_at' => $now,
        ]));

        // Best-effort: notify admins by email. If SMTP fails, swallow so submission still succeeds.
        try {
            $opd = OpdForm::find($id);
            if ($opd) {
                $recipients = array_filter(array_map('trim', explode(',', (string) config('mail.opd_notification_to'))));
                if (! empty($recipients)) {
                    Mail::to($recipients)->send(new OpdFormSubmitted($opd));
                }
            }
        } catch (\Throwable $e) {
            Log::warning('OPD email notification failed: ' . $e->getMessage());
        }

        return response()->json([
            'success' => true,
            'message' => 'OPD form submitted successfully! We will contact you shortly.',
        ]);
    }
}
