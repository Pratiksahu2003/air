@php
    /** @var array $data */
@endphp

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Thank you for contacting {{ config('site.name') }}</title>
</head>
<body style="margin:0; padding:0; background-color:#f5f5f5; font-family: Arial, sans-serif;">
<table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f5f5f5; padding:20px 0;">
    <tr>
        <td align="center">
            <table width="100%" cellpadding="0" cellspacing="0" style="max-width:600px; background:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 4px 12px rgba(0,0,0,0.06);">
                <!-- Header with Logo -->
                <tr>
                    <td style="background-color:#0d6efd; padding:16px 24px; color:#ffffff;">
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="vertical-align:middle;">
                                    <img src="{{ asset(config('site.logo')) }}" alt="{{ config('site.name') }} Logo" style="max-height:40px; display:block;">
                                </td>
                                <td style="text-align:right; vertical-align:middle;">
                                    <div style="font-size:14px; opacity:0.9;">{{ config('site.tagline') }}</div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- Greeting & Intro -->
                <tr>
                    <td style="padding:20px 24px 8px 24px;">
                        <h2 style="margin:0 0 8px 0; font-size:20px; color:#111827;">Thank you for contacting {{ config('site.name') }}</h2>
                        <p style="margin:0; font-size:14px; color:#6b7280;">Hi {{ $data['name'] }},</p>
                    </td>
                </tr>
                <tr>
                    <td style="padding:8px 24px 4px 24px;">
                        <p style="margin:0; font-size:14px; color:#4b5563;">
                            We’ve received your enquiry and our team will get back to you as soon as possible.
                        </p>
                    </td>
                </tr>

                <!-- Message Summary -->
                <tr>
                    <td style="padding:12px 24px 4px 24px;">
                        <p style="margin:0 0 8px 0; font-size:14px; font-weight:bold; color:#111827;">Your enquiry details</p>
                    </td>
                </tr>
                <tr>
                    <td style="padding:0 24px 16px 24px;">
                        <table cellpadding="0" cellspacing="0" style="width:100%; font-size:14px; border-collapse:collapse;">
                            <tr>
                                <td style="padding:6px 0; font-weight:bold; width:120px; color:#374151;">Subject</td>
                                <td style="padding:6px 0; color:#111827;">{{ $data['subject'] }}</td>
                            </tr>
                            <tr>
                                <td style="padding:10px 0 0 0; font-weight:bold; color:#374151; vertical-align:top;">Message</td>
                                <td style="padding:10px 0 0 0; color:#111827; white-space:pre-line;">{{ $data['message'] }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- Help text -->
                <tr>
                    <td style="padding:0 24px 16px 24px;">
                        <p style="margin:0; font-size:14px; color:#4b5563;">
                            If you need urgent assistance, you can contact us directly at
                            <a href="tel:{{ config('site.contact.phone') }}" style="color:#0d6efd; text-decoration:none;">
                                {{ config('site.contact.phone_display') }}
                            </a>.
                        </p>
                    </td>
                </tr>

                <!-- Signature & Footer -->
                <tr>
                    <td style="padding:0 24px 8px 24px;">
                        <p style="margin:12px 0 0 0; font-size:14px; color:#4b5563;">
                            Best regards,<br>
                            <strong>{{ config('site.full_name') }} Team</strong>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td style="padding:12px 24px 18px 24px; border-top:1px solid #e5e7eb; background-color:#f9fafb;">
                        <table width="100%" cellpadding="0" cellspacing="0" style="font-size:12px; color:#6b7280;">
                            <tr>
                                <td style="vertical-align:top;">
                                    {{ config('site.full_name') }}<br>
                                    {{ config('site.contact.address') }}<br>
                                    Phone: <a href="tel:{{ config('site.contact.phone') }}" style="color:#0d6efd; text-decoration:none;">{{ config('site.contact.phone_display') }}</a><br>
                                    Email: <a href="mailto:{{ config('site.contact.email') }}" style="color:#0d6efd; text-decoration:none;">{{ config('site.contact.email') }}</a>
                                </td>
                                <td style="text-align:right; vertical-align:top;">
                                    <span style="display:block; margin-bottom:6px;">Follow us:</span>
                                    @if(config('site.social.facebook') !== '#')
                                        <a href="{{ config('site.social.facebook') }}" style="margin-left:4px; color:#0d6efd; text-decoration:none;">Facebook</a>
                                    @endif
                                    @if(config('site.social.instagram') !== '#')
                                        <a href="{{ config('site.social.instagram') }}" style="margin-left:4px; color:#0d6efd; text-decoration:none;">Instagram</a>
                                    @endif
                                    @if(config('site.social.linkedin') !== '#')
                                        <a href="{{ config('site.social.linkedin') }}" style="margin-left:4px; color:#0d6efd; text-decoration:none;">LinkedIn</a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding-top:10px; font-size:11px; color:#9ca3af;">
                                    This is an automated confirmation email. Please do not reply to this address.
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>


