<?php

namespace App\Observers;

use App\Models\Invoice;

class InvoiceObserver
{
    public function creating(Invoice $invoice): void
    {
        if (! $invoice->number) {
            $invoice->number = strtoupper(uniqid('INVOICE-'));
        }
    }
}
