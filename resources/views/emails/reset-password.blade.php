@extends('emails.layout', [
    'title' => 'Reset your ITerrific password',
    'eyebrow' => 'Password reset',
    'heading' => 'Reset your password',
])

@section('content')
    <p style="margin:0 0 18px;font-size:16px;line-height:1.7;color:#1d3557;">
        Hello {{ $user->first_name ?: 'there' }},
    </p>

    <p style="margin:0 0 24px;font-size:16px;line-height:1.7;color:#4f5f7d;">
        We received a request to reset the password for your ITerrific account.
    </p>

    <table role="presentation" cellspacing="0" cellpadding="0" style="margin:0 0 28px;">
        <tr>
            <td bgcolor="#ff8a00" style="border-radius:8px;">
                <a href="{{ $resetUrl }}" style="display:inline-block;padding:14px 22px;color:#ffffff;font-size:15px;font-weight:700;text-decoration:none;">
                    Reset Password
                </a>
            </td>
        </tr>
    </table>

    <p style="margin:0 0 12px;font-size:14px;line-height:1.7;color:#7b86a2;">
        This reset link expires in {{ $expiresInHours }} hours. If you did not request this, you can safely ignore this email.
    </p>

    <p style="margin:0;font-size:14px;line-height:1.7;color:#7b86a2;">
        If the button does not work, open this link in your browser:<br>
        <a href="{{ $resetUrl }}" style="color:#ff8a00;word-break:break-all;">{{ $resetUrl }}</a>
    </p>
@endsection
