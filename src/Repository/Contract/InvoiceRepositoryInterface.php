<?php

namespace App\Repository\Contract;

use App\Entity\Invoice;

/**
 * Interface InvoiceRepositoryInterface
 *
 * @package App\Repository\Contract
 */
interface InvoiceRepositoryInterface
{
    /**
     * @param Invoice $invoice
     *
     * @return Invoice
     */
    public function create(Invoice $invoice): Invoice;

    /**
     * @param array $criteria
     *
     * @return float|null
     */
    public function getTotalAmountBy(array $criteria): ?float;
}
