<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50 dark:bg-gray-950">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Action Required: License Expired</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Custom styles for the primary button */
        .btn-primary {
            box-shadow: 0 10px 15px -3px rgba(239, 68, 68, 0.3), 0 4px 6px -2px rgba(239, 68, 68, 0.05); /* Soft, red-tinted shadow */
            background-image: linear-gradient(to right bottom, var(--tw-gradient-stops));
        }
        .btn-primary:focus-visible {
            outline: 4px solid rgba(239, 68, 68, 0.5);
            outline-offset: 2px;
        }
    </style>
</head>
<body class="h-full flex items-center justify-center p-4">
<div class="w-full max-w-3xl lg:max-w-4xl mx-auto" role="alert" aria-live="assertive"> <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl overflow-hidden border-t-8 border-red-600/70"> <div class="bg-gradient-to-br from-red-600 to-pink-700 text-white py-16 px-8 text-center"> <i class="fas fa-lock text-7xl mb-5 opacity-90 animate-pulse" aria-hidden="true"></i> <h1 class="text-5xl md:text-6xl font-extrabold mb-3 tracking-tight">Access Suspended</h1> <p class="text-xl opacity-95 font-light">Your license has expired and access has been temporarily suspended.</p>
        </div>

        <div class="px-8 sm:px-12 py-12 space-y-12">
            <div class="text-center space-y-6">
                @if($gracePeriodExpired)
                    <p class="text-xl text-gray-700 dark:text-gray-300">
                        Your license **officially expired** on <span class="font-bold text-red-600 dark:text-red-400">{{ $expirationDate }}</span>.
                        The **grace period has also ended** as of <span class="font-bold text-red-600 dark:text-red-400">{{ $gracePeriodEnd }}</span>.
                    </p>
                    <p class="text-4xl font-extrabold text-red-700 dark:text-red-500">
                        {{ $daysExpired }} Days Past Expiration
                    </p>
                @else
                    <p class="text-xl text-gray-700 dark:text-gray-300">
                        Your license expired on <span class="font-bold text-red-600 dark:text-red-400">{{ $expirationDate }}</span>.
                        Please renew before the grace period ends.
                    </p>
                    <p class="text-4xl font-extrabold text-orange-600 dark:text-orange-400">
                        {{ $daysExpired }} Days Past Expiration
                    </p>
                @endif

                <p class="text-lg text-gray-600 dark:text-gray-400 max-w-xl mx-auto pt-3">
                    **Immediate action is required** to restore full service and prevent any loss of access or features.
                </p>
            </div>

            <div class="flex flex-col sm:flex-row gap-5 justify-center">
                <a href="/renew-license" class="btn-primary inline-flex items-center justify-center px-10 py-4 from-red-500 to-red-700 hover:from-red-600 hover:to-red-800 text-white font-bold text-xl rounded-xl transition transform hover:scale-[1.02] active:scale-[0.98] focus-visible:ring-4 focus-visible:ring-red-500 focus-visible:ring-opacity-50" aria-label="Renew License Now and restore full access">
                    <i class="fas fa-sync-alt mr-3"></i>
                    Renew License Now
                </a>
                <a href="mailto:{{ $support['email'] }}" class="inline-flex items-center justify-center px-10 py-4 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-red-500 text-gray-800 dark:text-gray-200 font-semibold text-xl rounded-xl transition shadow-md">
                    <i class="fas fa-envelope-open-text mr-3"></i>
                    Contact Support
                </a>
            </div>

            <div class="bg-gray-50 dark:bg-gray-700 rounded-2xl p-8 mt-10 border border-gray-200 dark:border-gray-600">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6 text-center">Need Assistance? We're Here to Help</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                    <div class="hover:bg-gray-100 dark:hover:bg-gray-600 p-4 rounded-lg transition">
                        <i class="fas fa-envelope text-3xl text-red-600 mb-2"></i>
                        <p class="font-semibold text-gray-700 dark:text-gray-300 text-lg">Email Support</p>
                        <a href="mailto:{{ $support['email'] }}" class="text-red-600 dark:text-red-400 hover:underline break-all">{{ $support['email'] }}</a>
                    </div>
                    <div class="hover:bg-gray-100 dark:hover:bg-gray-600 p-4 rounded-lg transition">
                        <i class="fas fa-phone-alt text-3xl text-red-600 mb-2"></i>
                        <p class="font-semibold text-gray-700 dark:text-gray-300 text-lg">Call Us</p>
                        <a href="tel:{{ $support['phone'] }}" class="text-gray-600 dark:text-gray-400 hover:underline">{{ $support['phone'] }}</a>
                    </div>
                    <div class="hover:bg-gray-100 dark:hover:bg-gray-600 p-4 rounded-lg transition">
                        <i class="fas fa-calendar-alt text-3xl text-red-600 mb-2"></i>
                        <p class="font-semibold text-gray-700 dark:text-gray-300 text-lg">Support Hours</p>
                        <p class="text-gray-600 dark:text-gray-400 font-mono">{{ $support['hours'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-gray-100 dark:bg-gray-900 px-8 py-6 text-center text-sm text-gray-500 dark:text-gray-400 border-t border-gray-200 dark:border-gray-700 rounded-b-3xl">
            &copy; {{ date('Y') }} Your Company Name. We're here to help you get back up and running as quickly as possible.
        </div>
    </div>
</div>
</body>
</html>
