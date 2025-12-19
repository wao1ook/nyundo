<?php

namespace Emanate\Nyundo\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;

class NyundoStatusCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nyundo:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check the status of your Nyundo license';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $expirationDateString = config('nyundo.expiration_date');
        $holder = config('nyundo.holder');

        if (! $expirationDateString) {
            $this->error('Nyundo License configuration is missing (expiration_date).');

            return 1;
        }

        try {
            $expirationDate = Carbon::createFromFormat('Y-m-d', $expirationDateString)->startOfDay();
        } catch (\Exception $e) {
            $this->error('Nyundo License expiration date format is invalid. Must be YYYY-MM-DD.');

            return 1;
        }

        $today = Carbon::today();
        $daysRemaining = $today->diffInDays($expirationDate, false);

        $this->info('License Holder: '.($holder ?: 'Not specified'));
        $this->info('Expiration Date: '.$expirationDate->toDateString());

        if ($daysRemaining < 0) {
            $this->error('Status: EXPIRED ('.abs($daysRemaining).' days ago)');
        } elseif ($daysRemaining === 0) {
            $this->warn('Status: EXPIRES TODAY');
        } else {
            $this->info("Status: ACTIVE ({$daysRemaining} days remaining)");
        }

        return 0;
    }
}
