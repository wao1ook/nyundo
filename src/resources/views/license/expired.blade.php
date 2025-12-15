<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>License Expired</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f8f9fa;
            color: #212529;
            text-align: center;
            padding: 50px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #dc3545;
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 15px;
            line-height: 1.6;
        }

        .support-info {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }

        .support-info p {
            margin: 5px 0;
            font-size: 0.9em;
        }

        .date-highlight {
            font-weight: bold;
            color: #007bff;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>🚨 License Expired 🚨</h1>

    @if($gracePeriodExpired)
        <p>Your license expired on <span class="date-highlight">{{ $expirationDate }}</span> and the **grace period
            ended** on <span class="date-highlight">{{ $gracePeriodEnd }}</span>.</p>
        <p>You are currently **{{ $daysExpired }} days** past your license expiration date.</p>
    @else
        <p>Your license expired on <span class="date-highlight">{{ $expirationDate }}</span>.</p>
        <p>You are currently **{{ $daysExpired }} days** past your license expiration date.</p>
    @endif

    <p>Access to the application has been suspended. Please contact support immediately to renew your license and
        restore service.</p>

    <div class="support-info">
        <h2>Contact Support</h2>
        <p><strong>Email:</strong> <a href="mailto:{{ $support['email'] }}">{{ $support['email'] }}</a></p>
        <p><strong>Phone:</strong> {{ $support['phone'] }}</p>
        <p><strong>Hours:</strong> {{ $support['hours'] }}</p>
    </div>
</div>
</body>
</html>
