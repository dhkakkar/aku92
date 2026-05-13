<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New OPD Booking</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f5f5f5; margin:0; padding:24px; color:#222;">
    <div style="max-width:600px; margin:auto; background:#fff; border-radius:8px; overflow:hidden; box-shadow:0 4px 12px rgba(0,0,0,0.05);">
        <div style="background:#0c0c0e; color:#BFA14A; padding:20px 24px;">
            <h1 style="margin:0; font-size:1.4rem;">New OPD Booking</h1>
            <p style="margin:6px 0 0; font-size:0.9rem; opacity:0.8; color:#fff;">AKU 92 — OPD Registration Form</p>
        </div>

        <table cellpadding="10" cellspacing="0" style="width:100%; border-collapse:collapse; font-size:0.95rem;">
            <tr><td style="background:#fafafa; width:35%;"><strong>Patient Name</strong></td><td>{{ $opd->patient_name }}</td></tr>
            <tr><td style="background:#fafafa;"><strong>Phone</strong></td><td><a href="tel:{{ $opd->phone }}">{{ $opd->phone }}</a></td></tr>
            <tr><td style="background:#fafafa;"><strong>Age</strong></td><td>{{ $opd->age }}</td></tr>
            <tr><td style="background:#fafafa;"><strong>Gender</strong></td><td>{{ $opd->gender }}</td></tr>
            <tr><td style="background:#fafafa;"><strong>Address</strong></td><td>{{ $opd->address }}</td></tr>
            <tr>
                <td style="background:#fafafa; vertical-align:top;"><strong>Reason / Symptoms</strong></td>
                <td style="white-space:pre-wrap;">{{ $opd->description }}</td>
            </tr>
            <tr><td style="background:#fafafa;"><strong>Submitted</strong></td><td>{{ $opd->created_at->format('d M Y, h:i A') }}</td></tr>
        </table>

        <div style="padding:16px 24px; background:#fafafa; border-top:1px solid #eee; font-size:0.82rem; color:#666; text-align:center;">
            Please contact the patient at <a href="tel:{{ $opd->phone }}">{{ $opd->phone }}</a> to confirm the appointment.<br>
            Manage all bookings at <a href="{{ url('/admin/opd-forms') }}">{{ url('/admin/opd-forms') }}</a>.
        </div>
    </div>
</body>
</html>
