@extends('emails.layout', [
    'title' => 'Confirm your ITerrific email address',
    'eyebrow' => 'Account verification',
    'heading' => 'Confirm your email address',
])

@section('content')
    <p style="margin:0 0 18px;font-size:16px;line-height:1.7;color:#1d3557;">
        Hello {{ $user->first_name ?: 'there' }},
    </p>

    <p style="margin:0 0 24px;font-size:16px;line-height:1.7;color:#4f5f7d;">
        Please confirm your email address to activate dashboard access for your ITerrific account.
    </p>

    <table role="presentation" cellspacing="0" cellpadding="0" style="margin:0 0 28px;">
        <tr>
            <td bgcolor="#ff8a00" style="border-radius:8px;">
                <a href="{{ $verificationUrl }}" style="display:inline-block;padding:14px 22px;color:#ffffff;font-size:15px;font-weight:700;text-decoration:none;">
                    Confirm Email Address
                </a>
            </td>
        </tr>
    </table>

    <p style="margin:0 0 12px;font-size:14px;line-height:1.7;color:#7b86a2;">
        This verification link expires in {{ $expiresIn }} minutes.
    </p>

    <p style="margin:0;font-size:14px;line-height:1.7;color:#7b86a2;">
        If the button does not work, open this link in your browser:<br>
        <a href="{{ $verificationUrl }}" style="color:#ff8a00;word-break:break-all;">{{ $verificationUrl }}</a>
    </p>
@endsection
