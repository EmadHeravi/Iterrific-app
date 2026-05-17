<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ $title ?? 'ITerrific' }}</title>
</head>
<body style="margin:0;background:#f3f4f6;color:#1d3557;font-family:Arial,Helvetica,sans-serif;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:#f3f4f6;padding:32px 16px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width:640px;background:#ffffff;border-radius:12px;overflow:hidden;border:1px solid #e6e9ef;">
                    <tr>
                        <td style="padding:28px 32px 18px;text-align:center;">
                            <img src="cid:iterrific-logo" alt="ITerrific" width="170" style="display:inline-block;border:0;max-width:170px;height:auto;">
                        </td>
                    </tr>
                    <tr>
                        <td style="background:#ff8a00;padding:26px 32px;color:#ffffff;">
                            <div style="font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:.08em;opacity:.88;">
                                {{ $eyebrow ?? 'ITerrific' }}
                            </div>
                            <h1 style="margin:8px 0 0;font-size:26px;line-height:1.25;font-weight:700;">
                                {{ $heading }}
                            </h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:32px;">
                            @yield('content')
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:18px 32px 28px;border-top:1px solid #edf0f5;color:#7b86a2;font-size:13px;line-height:1.6;">
                            ITerrific B.V.<br>
                            <a href="{{ url('/') }}" style="color:#ff8a00;text-decoration:none;">{{ url('/') }}</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
