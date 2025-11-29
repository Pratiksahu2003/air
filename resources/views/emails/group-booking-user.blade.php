@php
    /** @var array $data */
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Group Booking Request Received - {{ config('site.name') }}</title>
    <!--[if mso]>
    <style type="text/css">
        table {border-collapse:collapse;border-spacing:0;margin:0;}
        div, td {padding:0;}
        div {margin:0 !important;}
    </style>
    <![endif]-->
</head>
<body style="margin:0; padding:0; background-color:#f0f4f8; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f0f4f8; padding:40px 20px;">
        <tr>
            <td align="center">
                <!-- Main Container -->
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:650px; background:#ffffff; border-radius:16px; overflow:hidden; box-shadow:0 8px 24px rgba(0,0,0,0.1);">
                    
                    <!-- Header with Gradient Background -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #0d6efd 0%, #0056b3 100%); padding:32px 32px 24px 32px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="vertical-align:middle;">
                                        <img src="{{ asset(config('site.logo')) }}" alt="{{ config('site.name') }} Logo" style="max-height:50px; height:auto; display:block; width:auto;" />
                                    </td>
                                    <td style="text-align:right; vertical-align:middle;">
                                        <div style="font-size:13px; color:#ffffff; opacity:0.95; font-weight:500; letter-spacing:0.5px;">{{ config('site.tagline') }}</div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Success Badge -->
                    <tr>
                        <td style="padding:20px 32px 0 32px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#d1e7dd; border-left:4px solid #198754; border-radius:6px; padding:12px 16px;">
                                <tr>
                                    <td>
                                        <div style="font-size:14px; color:#0f5132; font-weight:600; display:flex; align-items:center;">
                                            <span style="display:inline-block; width:8px; height:8px; background:#198754; border-radius:50%; margin-right:10px;"></span>
                                            Request Received Successfully
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Greeting Section -->
                    <tr>
                        <td style="padding:24px 32px 8px 32px;">
                            <h1 style="margin:0 0 12px 0; font-size:26px; font-weight:700; color:#1a1a1a; line-height:1.3;">Thank You for Your Group Booking Request!</h1>
                            <p style="margin:0; font-size:15px; color:#4b5563; line-height:1.6;">Hello {{ $data['name'] }},</p>
                        </td>
                    </tr>

                    <!-- Message Section -->
                    <tr>
                        <td style="padding:8px 32px 24px 32px;">
                            <p style="margin:0 0 16px 0; font-size:15px; color:#4b5563; line-height:1.7;">
                                We've received your group booking request and our travel experts are already working on finding the best group fare options for you.
                            </p>
                            <p style="margin:0; font-size:15px; color:#4b5563; line-height:1.7;">
                                Our dedicated group booking team will contact you at <strong style="color:#1a1a1a;">{{ $data['email'] }}</strong> or <strong style="color:#1a1a1a;">{{ $data['phone'] }}</strong> within <strong style="color:#0d6efd;">24 hours</strong> with personalized group fare quotes and the best available deals.
                            </p>
                        </td>
                    </tr>

                    <!-- Group Booking Details Card -->
                    <tr>
                        <td style="padding:0 32px 24px 32px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius:12px; padding:24px; border:1px solid #dee2e6;">
                                
                                <tr>
                                    <td>
                                        <div style="font-size:13px; color:#6c757d; text-transform:uppercase; font-weight:600; letter-spacing:0.5px; margin-bottom:16px; text-align:center;">Your Group Booking Details</div>
                                    </td>
                                </tr>

                                <!-- Route Information -->
                                <tr>
                                    <td style="padding-bottom:20px; border-bottom:2px solid #dee2e6;">
                                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="width:50%; vertical-align:top; text-align:center;">
                                                    <div style="font-size:11px; color:#6c757d; text-transform:uppercase; font-weight:600; letter-spacing:0.5px; margin-bottom:8px;">FROM</div>
                                                    <div style="font-size:20px; color:#1a1a1a; font-weight:700;">{{ $data['from_city'] }}</div>
                                                </td>
                                                <td style="width:50px; text-align:center; vertical-align:middle;">
                                                    <div style="font-size:24px; color:#0d6efd;">→</div>
                                                </td>
                                                <td style="width:50%; vertical-align:top; text-align:center;">
                                                    <div style="font-size:11px; color:#6c757d; text-transform:uppercase; font-weight:600; letter-spacing:0.5px; margin-bottom:8px;">TO</div>
                                                    <div style="font-size:20px; color:#1a1a1a; font-weight:700;">{{ $data['to_city'] }}</div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <!-- Trip Details -->
                                <tr>
                                    <td style="padding-top:20px;">
                                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="font-size:14px;">
                                            <tr>
                                                <td style="padding:10px 0; width:140px; color:#495057; font-weight:600;">Departure Date</td>
                                                <td style="padding:10px 0; color:#1a1a1a; font-weight:500;">{{ \Carbon\Carbon::parse($data['departure_date'])->format('l, F d, Y') }}</td>
                                            </tr>
                                            @if(!empty($data['return_date']))
                                            <tr>
                                                <td style="padding:10px 0; color:#495057; font-weight:600;">Return Date</td>
                                                <td style="padding:10px 0; color:#1a1a1a; font-weight:500;">{{ \Carbon\Carbon::parse($data['return_date'])->format('l, F d, Y') }}</td>
                                            </tr>
                                            @endif
                                            <tr>
                                                <td style="padding:10px 0; color:#495057; font-weight:600;">Group Size</td>
                                                <td style="padding:10px 0; color:#1a1a1a;">
                                                    <span style="display:inline-block; background:#0d6efd; color:#ffffff; padding:6px 16px; border-radius:20px; font-size:13px; font-weight:600;">{{ $data['passengers'] }} Passengers</span>
                                                </td>
                                            </tr>
                                            @if(!empty($data['organization']))
                                            <tr>
                                                <td style="padding:10px 0; color:#495057; font-weight:600;">Organization</td>
                                                <td style="padding:10px 0; color:#1a1a1a; font-weight:500;">{{ $data['organization'] }}</td>
                                            </tr>
                                            @endif
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Next Steps Section -->
                    <tr>
                        <td style="padding:0 32px 24px 32px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#fff3cd; border-left:4px solid #ffc107; border-radius:8px; padding:20px;">
                                <tr>
                                    <td>
                                        <div style="font-size:14px; color:#856404; font-weight:600; margin-bottom:8px;">📋 What Happens Next?</div>
                                        <ul style="margin:0; padding-left:20px; font-size:14px; color:#856404; line-height:1.8;">
                                            <li>Our group booking specialists will review your request</li>
                                            <li>We'll search for the best group fare options matching your criteria</li>
                                            <li>You'll receive a personalized group quote within 24 hours</li>
                                            <li>Our dedicated account manager will be available to answer any questions</li>
                                        </ul>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Contact Support -->
                    <tr>
                        <td style="padding:0 32px 32px 32px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f8f9fa; border-radius:12px; padding:20px; text-align:center;">
                                <tr>
                                    <td>
                                        <div style="font-size:14px; color:#495057; margin-bottom:12px; font-weight:600;">Need Immediate Assistance?</div>
                                        <p style="margin:0 0 16px 0; font-size:14px; color:#6c757d; line-height:1.6;">
                                            Our customer support team is available 24/7 to help you.
                                        </p>
                                        <a href="tel:{{ config('site.contact.phone') }}" style="display:inline-block; background:#0d6efd; color:#ffffff; text-decoration:none; padding:12px 24px; border-radius:8px; font-weight:600; font-size:14px; margin-right:12px;">Call Us Now</a>
                                        <a href="mailto:{{ config('site.contact.email') }}" style="display:inline-block; background:#ffffff; color:#0d6efd; text-decoration:none; padding:12px 24px; border-radius:8px; font-weight:600; font-size:14px; border:2px solid #0d6efd;">Email Us</a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="padding:24px 32px; background:#f8f9fa; border-top:1px solid #e9ecef;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="vertical-align:top;">
                                        <div style="font-size:13px; color:#495057; font-weight:600; margin-bottom:8px;">{{ config('site.full_name') }}</div>
                                        <div style="font-size:12px; color:#6c757d; line-height:1.6;">
                                            {{ config('site.contact.address') }}<br>
                                            <a href="tel:{{ config('site.contact.phone') }}" style="color:#0d6efd; text-decoration:none;">{{ config('site.contact.phone_display') }}</a> | 
                                            <a href="mailto:{{ config('site.contact.email') }}" style="color:#0d6efd; text-decoration:none;">{{ config('site.contact.email') }}</a>
                                        </div>
                                    </td>
                                    <td style="text-align:right; vertical-align:top;">
                                        <div style="font-size:12px; color:#6c757d; margin-bottom:8px; font-weight:600;">Follow Us</div>
                                        <div style="font-size:12px;">
                                            @if(config('site.social.facebook') !== '#')
                                            <a href="{{ config('site.social.facebook') }}" style="color:#0d6efd; text-decoration:none; margin-left:8px;">Facebook</a>
                                            @endif
                                            @if(config('site.social.instagram') !== '#')
                                            <a href="{{ config('site.social.instagram') }}" style="color:#0d6efd; text-decoration:none; margin-left:8px;">Instagram</a>
                                            @endif
                                            @if(config('site.social.linkedin') !== '#')
                                            <a href="{{ config('site.social.linkedin') }}" style="color:#0d6efd; text-decoration:none; margin-left:8px;">LinkedIn</a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="padding-top:16px; border-top:1px solid #e9ecef; text-align:center;">
                                        <p style="margin:0; font-size:11px; color:#9ca3af;">
                                            This is an automated confirmation email. Please do not reply to this address.<br>
                                            For inquiries, please contact us at <a href="mailto:{{ config('site.contact.email') }}" style="color:#0d6efd; text-decoration:none;">{{ config('site.contact.email') }}</a>
                                        </p>
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

