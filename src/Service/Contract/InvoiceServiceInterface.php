<?php

namespace App\Service\Contract;

use App\Entity\Invoice;

/**
 * Interface InvoiceServiceInterface
 *
 * @package App\Service\Contract
 */
interface InvoiceServiceInterface
{
    /**
     * @param array $data
     *
     * @return mixed
     */
    public function create(Invoice $invoice): Invoice;
}
