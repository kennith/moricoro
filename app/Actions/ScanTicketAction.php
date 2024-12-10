<?php

namespace App\Actions;

use App\Events\TicketScannedEvent;
use App\Models\Ticket;

class ScanTicketAction
{
    public function execute(Ticket $ticket)
    {
        TicketScannedEvent::dispatch($ticket);
    }
}
