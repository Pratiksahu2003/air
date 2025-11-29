@php
    /** @var array $data */
@endphp

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Contact Enquiry</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f5f5f5; padding: 20px;">
<table width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 8px; overflow: hidden;">
    <tr>
        <td style="background-color: #0d6efd; color: #ffffff; padding: 16px 24px;">
            <h2 style="margin: 0;">New Contact Enquiry</h2>
            <p style="margin: 4px 0 0;">{{ config('site.full_name') }}</p>
        </td>
    </tr>
    <tr>
        <td style="padding: 20px 24px;">
            <p style="margin: 0 0 12px;">You have received a new contact enquiry from your website:</p>

            <table cellpadding="0" cellspacing="0" style="width: 100%; font-size: 14px; margin-bottom: 16px;">
                <tr>
                    <td style="font-weight: bold; width: 120px;">Name:</td>
                    <td>{{ $data['name'] }}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Email:</td>
                    <td>{{ $data['email'] }}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Phone:</td>
                    <td>{{ $data['phone'] }}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Subject:</td>
                    <td>{{ $data['subject'] }}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold; vertical-align: top; padding-top: 8px;">Message:</td>
                    <td style="padding-top: 8px; white-space: pre-line;">{{ $data['message'] }}</td>
                </tr>
            </table>

            <p style="font-size: 12px; color: #666; margin: 0;">
                This email was generated automatically from the contact form on {{ config('site.name') }}.
            </p>
        </td>
    </tr>
</table>
</body>
</html>


