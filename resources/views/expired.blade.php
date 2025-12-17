<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>License Expired - Nyundo</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen p-6">

<div class="max-w-md w-full bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
    <div class="bg-red-600 p-6 text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-red-100 rounded-full mb-4">
            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
        </div>
        <h1 class="text-2xl font-bold text-white">License Expired</h1>
    </div>

    <div class="p-8">
        <p class="text-gray-600 text-center mb-6">
            Your access to this application has been suspended because your license has reached its end date.
        </p>

        <div class="space-y-4 bg-gray-50 rounded-lg p-4 border border-gray-100">
            <div class="flex justify-between text-sm">
                <span class="text-gray-500">Expiration Date:</span>
                <span class="font-mono font-bold text-gray-800">{{ $expirationDate }}</span>
            </div>

            @if($gracePeriodExpired)
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Grace Period Ended:</span>
                    <span class="font-mono font-bold text-red-600">{{ $gracePeriodEnd }}</span>
                </div>
            @endif

            <div class="flex justify-between text-sm">
                <span class="text-gray-500">Days Since Expiry:</span>
                <span class="font-mono font-bold text-gray-800">{{ abs($daysExpired) }} days</span>
            </div>
        </div>

        @if(!empty($support))
            <div class="mt-8 border-t border-gray-100 pt-6">
                <h3 class="text-sm font-semibold text-gray-900 mb-3">How to renew?</h3>
                <ul class="text-sm text-gray-600 space-y-2">
                    @if(isset($support['email']))
                        <li>Email: <a href="mailto:{{ $support['email'] }}"
                                      class="text-blue-600 hover:underline">{{ $support['email'] }}</a></li>
                    @endif
                    @if(isset($support['link']))
                        <li>Portal: <a href="{{ $support['link'] }}" target="_blank"
                                       class="text-blue-600 hover:underline">Renew Online</a></li>
                    @endif
                    @if(isset($support['phone']))
                        <li>Support: {{ $support['phone'] }}</li>
                    @endif
                </ul>
            </div>
        @endif
    </div>

    <div class="bg-gray-50 px-8 py-4 text-center">
        <p class="text-xs text-gray-400 font-medium uppercase tracking-widest">{{ $holder }}</p>
    </div>
</div>

</body>
</html>
