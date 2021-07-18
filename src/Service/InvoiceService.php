<?php

namespace App\Service;

use App\Entity\Invoice;
use App\Repository\Contract\InvoiceRepositoryInterface;
use App\Service\Constant\InvoiceStatus;
use App\Service\Contract\InvoiceServiceInterface;

/**
 * Class InvoiceService
 *
 * @package App\Service
 */
class InvoiceService implements InvoiceServiceInterface
{
    /**
     * @var InvoiceRepositoryInterface
     */
    private InvoiceRepositoryInterface $repository;

    /**
     * InvoiceService constructor.
     *
     * @param InvoiceRepositoryInterface $repository
     */
    public function __construct(InvoiceRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Invoice $invoice
     *
     * @return Invoice
     */
    public function create(Invoice $invoice): Invoice
    {
        $invoice->setStatus(InvoiceStatus::PENDING);

        if ($this->isRiskLimitExceeded($invoice)) {
            $invoice->setStatus(InvoiceStatus::ON_HOLD);
        }

        return $this->repository->create($invoice);
    }

    /**
     * @param Invoice $invoice
     *
     * @return Invoice
     */
    public function update(Invoice $invoice): Invoice
    {
        return $this->repository->update($invoice);
    }

    /**
     * @param \App\Entity\Invoice $invoice
     *
     * @return bool
     */
    private function isRiskLimitExceeded(Invoice $invoice): bool
    {
        $total = $this->repository->getTotalAmountBy([
            'status' => InvoiceStatus::PENDING,
            'company_id' => $invoice->getCompany()->getId(),
        ]);

        $total += $invoice->getCost();

        return $total > $invoice->getCompany()->getRiskLimit();
    }
}
