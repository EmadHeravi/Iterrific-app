@extends('emails.layout', [
    'eyebrow' => 'Security Verification',
    'heading' => 'Your login code',
    'title' => 'Your ITerrific login code',
])

@section('content')
    <p style="margin:0 0 18px;font-size:16px;line-height:1.7;">
        Hello {{ $user->first_name ?: 'there' }},
    </p>

    <p style="margin:0 0 22px;font-size:16px;line-height:1.7;">
        Use this code to finish signing in to your ITerrific account.
    </p>

    <div style="margin:0 0 22px;padding:18px 22px;border-radius:10px;background:#fff4e5;color:#1d3557;font-size:30px;font-weight:700;letter-spacing:6px;text-align:center;">
        {{ $code }}
    </div>

    <p style="margin:0;color:#7b86a2;font-size:14px;line-height:1.7;">
        This code expires in {{ $expiresInMinutes }} minutes. If you did not try to sign in, you can ignore this email.
    </p>
@endsection
