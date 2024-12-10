<?php

namespace App\Console\Commands;

use App\Actions\ScanTicketAction;
use App\Models\Ticket;
use Illuminate\Console\Command;

class ScanTicketCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:scan-ticket';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scan ticket';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $ticket = Ticket::first();
        $scanTicketAction = new ScanTicketAction();
        $scanTicketAction->execute($ticket);
    }
}
