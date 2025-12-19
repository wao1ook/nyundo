<?php

namespace Emanate\Nyundo\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class CheckLicense
{
    public const SESSION_WARNING = 'nyundo_license_warning';

    public const SESSION_ERROR = 'nyundo_license_error';

    public function handle(Request $request, Closure $next)
    {
        $expirationDateString = config('nyundo.expiration_date');
        $holder = config('nyundo.holder');
        $warningDays = config('nyundo.warning_days', 7);
        $gracePeriodDays = config('nyundo.grace_period_days', 0);
        $supportInfo = config('nyundo.support', []);

        if (! $expirationDateString) {
            abort(500, 'Nyundo License configuration is missing or malformed (expiration_date).');
        }

        try {
            $expirationDate = Carbon::createFromFormat('Y-m-d', $expirationDateString)->startOfDay();
        } catch (\Exception $e) {
            abort(500, 'Nyundo License expiration date format is invalid. Must be YYYY-MM-DD.');
        }

        $today = Carbon::today();
        $gracePeriodEnd = $expirationDate->copy()->addDays($gracePeriodDays);

        // License is fully expired (beyond grace period)
        if ($today > $gracePeriodEnd) {
            return $this->renderExpiredView($expirationDate, $gracePeriodEnd, $gracePeriodDays, $supportInfo, $holder);
        }

        // Within grace period
        if ($today > $expirationDate) {
            $daysInGrace = $today->diffInDays($expirationDate, false);
            $daysLeftInGrace = $gracePeriodEnd->diffInDays($today, false);
            session()->flash(self::SESSION_ERROR, "Your license expired {$daysInGrace} days ago. Grace period ends in {$daysLeftInGrace} days.");
        }

        // Within warning period
        $daysRemaining = $today->diffInDays($expirationDate, false);
        if ($daysRemaining <= $warningDays && $daysRemaining >= 0) {
            session()->flash(self::SESSION_WARNING, "Your license will expire in {$daysRemaining} days. Please renew soon.");
        }

        return $next($request);
    }

    protected function renderExpiredView(Carbon $expirationDate, Carbon $gracePeriodEnd, int $gracePeriodDays, array $supportInfo, ?string $holder)
    {
        $daysExpired = Carbon::today()->diffInDays($expirationDate, false);

        return response()->view('nyundo::expired', [
            'expirationDate' => $expirationDate->toDateString(),
            'daysExpired' => $daysExpired,
            'gracePeriodExpired' => $gracePeriodDays > 0,
            'gracePeriodEnd' => $gracePeriodEnd->toDateString(),
            'support' => $supportInfo,
            'holder' => $holder,
        ]);
    }
}
