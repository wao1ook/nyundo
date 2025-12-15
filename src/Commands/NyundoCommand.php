<?php

namespace Emanate\Nyundo\Commands;

use Illuminate\Console\Command;

class NyundoCommand extends Command
{
    public $signature = 'nyundo';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
