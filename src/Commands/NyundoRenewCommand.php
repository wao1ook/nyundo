<?php

namespace Emanate\Nyundo\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class NyundoRenewCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nyundo:renew
                            {--warning-days= : Number of days before expiration to start showing a warning}
                            {--expiry-date= : The date the license expires (YYYY-MM-DD)}
                            {--grace-period= : Number of days after expiration to allow access}
                            {--license-key= : The license key}
                            {--password= : The management password to authorize this action}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Apply a new license to the application';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $password = $this->option('password');

        if (empty($password)) {
            $password = $this->secret('Please enter the management password');
        }

        $expectedPassword = config('nyundo.nyundo_password');

        if (empty($expectedPassword)) {
            $this->error('Management password is not set in nyundo config. Please set NYUNDO_nyundo_password in your .env file.');

            return 1;
        }

        if ($password !== $expectedPassword) {
            $this->error('Unauthorized: Incorrect management password.');

            return 1;
        }

        $updates = [
            'LICENSE_KEY' => $this->option('license-key'),
            'LICENSE_EXPIRATION_DATE' => $this->option('expiry-date'),
            'LICENSE_WARNING_DAYS' => $this->option('warning-days'),
            'LICENSE_GRACE_PERIOD_DAYS' => $this->option('grace-period'),
        ];

        // Filter out null values (options not provided)
        $updates = array_filter($updates, fn ($value) => ! is_null($value));

        if (empty($updates)) {
            $this->warn('No license details provided to update.');

            return 0;
        }

        if ($this->updateDotEnv($updates)) {
            $this->info('License applied successfully.');

            return 0;
        }

        $this->error('Failed to update .env file.');

        return 1;
    }

    /**
     * Update the .env file with the given key-value pairs.
     */
    protected function updateDotEnv(array $data): bool
    {
        $envPath = base_path('.env');

        if (! File::exists($envPath)) {
            return false;
        }

        $content = File::get($envPath);

        foreach ($data as $key => $value) {
            $pattern = "/^{$key}=.*/m";
            $replacement = "{$key}={$value}";

            if (preg_match($pattern, $content)) {
                $content = preg_replace($pattern, $replacement, $content);
            } else {
                $content .= "\n{$key}={$value}";
            }
        }

        return File::put($envPath, $content) !== false;
    }
}
