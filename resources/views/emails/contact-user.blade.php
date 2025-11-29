@php
    /** @var array $data */
@endphp

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Thank you for contacting {{ config('site.name') }}</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f5f5f5; padding: 20px;">
<table width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 8px; overflow: hidden;">
    <tr>
        <td style="background-color: #0d6efd; color: #ffffff; padding: 16px 24px;">
            <h2 style="margin: 0;">Thank You for Reaching Out</h2>
            <p style="margin: 4px 0 0;">{{ config('site.full_name') }}</p>
        </td>
    </tr>
    <tr>
        <td style="padding: 20px 24px;">
            <p>Hi {{ $data['name'] }},</p>

            <p>Thank you for contacting <strong>{{ config('site.name') }}</strong>. We have received your enquiry and our team will get in touch with you shortly.</p>

            <p style="margin-top: 16px; margin-bottom: 8px;"><strong>Your message details:</strong></p>

            <table cellpadding="0" cellspacing="0" style="width: 100%; font-size: 14px; margin-bottom: 16px;">
                <tr>
                    <td style="font-weight: bold; width: 120px;">Subject:</td>
                    <td>{{ $data['subject'] }}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold; vertical-align: top; padding-top: 8px;">Message:</td>
                    <td style="padding-top: 8px; white-space: pre-line;">{{ $data['message'] }}</td>
                </tr>
            </table>

            <p style="margin-top: 16px;">
                If you need immediate assistance, feel free to call us at
                <a href="tel:{{ config('site.contact.phone') }}">{{ config('site.contact.phone_display') }}</a>.
            </p>

            <p style="margin-top: 16px;">Best regards,<br>{{ config('site.full_name') }} Team</p>

            <p style="font-size: 12px; color: #666; margin-top: 24px;">
                This is an automated confirmation email. Please do not reply to this address.
            </p>
        </td>
    </tr>
</table>
</body>
</html>


