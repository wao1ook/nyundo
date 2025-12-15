<?php

namespace Emanate\Nyundo\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class CheckLicense
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Get configuration values from the package config file
        $expirationDateString = config('nyundo.expiration_date');
        $warningDays = config('nyundo.warning_days', 7);
        $gracePeriodDays = config('nyundo.grace_period_days', 0);
        $supportInfo = config('nyundo.support', []);

        // 1. Check if license expiration date is configured
        if (! $expirationDateString) {
            // Log this error, but don't abort unless this is critical for your application's use.
            // For a package, it's safer to just proceed if configuration is missing,
            // or return an error view if you intend for the license to be mandatory.
            // For this package, we'll follow the original intent and abort.
            abort(500, 'Nyundo License configuration is missing or malformed (expiration_date).');
        }

        // Convert the configuration string to a Carbon date instance
        try {
            // Ensure the date is treated as midnight of the expiration day
            $expirationDate = Carbon::createFromFormat('Y-m-d', $expirationDateString)->startOfDay();
        } catch (\Exception $e) {
            abort(500, 'Nyundo License expiration date format is invalid. Must be YYYY-MM-DD.');
        }

        $today = Carbon::today();
        $gracePeriodEnd = $expirationDate->copy()->addDays($gracePeriodDays);

        // --- 3. License has expired beyond grace period (Blocking) ---
        if ($today > $gracePeriodEnd) {
            $daysExpired = $today->diffInDays($expirationDate, false);

            return response()->view('nyundo::expired', [
                'expirationDate' => $expirationDate->toDateString(),
                'daysExpired' => $daysExpired,
                'gracePeriodExpired' => $gracePeriodDays > 0,
                'gracePeriodEnd' => $gracePeriodEnd->toDateString(),
                'support' => $supportInfo,
            ], 403);
        }

        // --- 4. Show warning if in grace period (Soft Warning) ---
        if ($expirationDate < $today && $today <= $gracePeriodEnd) {
            $daysInGrace = $today->diffInDays($expirationDate, false);
            $daysLeftInGrace = $gracePeriodEnd->diffInDays($today, false);
            session()->flash('nyundo_license_error', "Your license expired {$daysInGrace} days ago. Grace period ends in {$daysLeftInGrace} days.");
        }

        // --- 5. Show warning if license expires soon (Soft Warning) ---
        $daysRemaining = $today->diffInDays($expirationDate, false);
        if ($daysRemaining <= $warningDays && $daysRemaining > 0) {
            session()->flash('nyundo_license_warning', "Your license will expire in {$daysRemaining} days. Please renew soon.");
        }

        // If all checks pass, proceed
        return $next($request);
    }
}
