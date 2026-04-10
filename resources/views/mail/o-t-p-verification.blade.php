<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Account - {{ env('APP_NAME') }}</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            color: #333333;
        }

        .email-wrapper {
            background-color: #f4f4f4;
            padding: 20px 0;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: 1px solid #e8e8e8;
        }

        .header {
            background: linear-gradient(135deg, #E60076 0%, #9810FA 50%, #155DFC 100%);

            padding: 40px 20px;
            color: white;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .header p {
            margin: 10px 0 0;
            font-size: 16px;
            opacity: 0.95;
        }

        .body-content {
            padding: 40px 30px;
            text-align: center;
            line-height: 1.6;
        }

        .greeting {
            font-size: 18px;
            margin-bottom: 20px;
            color: #2d2d2d;
        }

        .message {
            font-size: 16px;
            color: #555555;
            margin: 20px auto;
            max-width: 90%;
        }

        .otp-box {
            background-color: #f8f9fa;
            border: 2px dashed #E60076;
            border-radius: 12px;
            padding: 25px;
            margin: 30px auto;
            max-width: 280px;
            font-size: 36px;
            font-weight: 700;
            letter-spacing: 8px;
            color: #E60076;
            text-align: center;
        }

        .expiry-note {
            font-size: 14px;
            color: #888888;
            margin: 25px 0;
        }

        .support-text {
            font-size: 14px;
            color: #777777;
            margin-top: 30px;
        }

        .support-text a {
            color: #E60076;
            text-decoration: none;
            font-weight: 500;
        }

        .footer {
            background-color: #fafafa;
            padding: 25px 30px;
            text-align: center;
            font-size: 13px;
            color: #999999;
            border-top: 1px solid #eeeeee;
        }

        .footer a {
            color: #B7A144;
            text-decoration: none;
        }

        @media only screen and (max-width: 600px) {
            .otp-box {
                font-size: 28px;
                letter-spacing: 5px;
                padding: 20px;
            }

            .header h1 {
                font-size: 24px;
            }

            .body-content {
                padding: 30px 20px;
            }
        }
    </style>
</head>

<body>
    <div class="email-wrapper">
        <div class="email-container">

            <!-- Header -->
            <div class="header">
                <h1>{{ env('APP_NAME') }}</h1>
                <p>One-Time Verification Code</p>
            </div>

            <!-- Body -->
            <div class="body-content">
                <div class="greeting">Hello {{ $name }},</div>

                <p class="message">
                    We've received a request to verify your account. Please use the verification code below to complete
                    the process.
                </p>

                <!-- OTP Code -->
                <div class="otp-box">{{ $code }}</div>

                <p class="expiry-note">
                    This code will expire in <strong>10 minutes</strong> for security reasons.
                </p>

                <p class="message">
                    If you didn’t request this verification, you can safely ignore this email.
                </p>

                <p class="support-text">
                    Need help? <a href="mailto:{{ env('SUPPORT_EMAIL') }}">Contact our support team</a>
                </p>
            </div>

            <!-- Footer -->
            <div class="footer">
                <p>&copy; {{ date('Y') }} {{ env('APP_NAME') }}. All rights reserved.</p>
                <p>Secure • Fast • Reliable</p>
            </div>
        </div>
    </div>
</body>

</html>
