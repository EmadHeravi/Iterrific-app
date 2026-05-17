@extends('emails.layout', [
    'title' => 'New contact request',
    'eyebrow' => 'Website contact form',
    'heading' => 'New contact request',
])

@section('content')
    <p style="margin:0 0 22px;font-size:16px;line-height:1.7;color:#4f5f7d;">
        A new message was submitted from the ITerrific website contact form.
    </p>

    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;margin-bottom:24px;">
        <tr>
            <td style="padding:12px 0;border-bottom:1px solid #edf0f5;color:#7b86a2;width:150px;font-size:14px;">Name</td>
            <td style="padding:12px 0;border-bottom:1px solid #edf0f5;color:#1d3557;font-size:14px;font-weight:700;">{{ $name }}</td>
        </tr>
        <tr>
            <td style="padding:12px 0;border-bottom:1px solid #edf0f5;color:#7b86a2;font-size:14px;">Email</td>
            <td style="padding:12px 0;border-bottom:1px solid #edf0f5;color:#1d3557;font-size:14px;">
                <a href="mailto:{{ $email }}" style="color:#ff8a00;text-decoration:none;">{{ $email }}</a>
            </td>
        </tr>
        <tr>
            <td style="padding:12px 0;border-bottom:1px solid #edf0f5;color:#7b86a2;font-size:14px;">Subject</td>
            <td style="padding:12px 0;border-bottom:1px solid #edf0f5;color:#1d3557;font-size:14px;">{{ $subject ?: 'No subject provided' }}</td>
        </tr>
    </table>

    <div style="background:#f8fafc;border:1px solid #edf0f5;border-radius:10px;padding:18px;color:#1d3557;font-size:15px;line-height:1.7;white-space:pre-line;">{{ $messageBody }}</div>
@endsection
