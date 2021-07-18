<?php

namespace App\Test\Unit\Formatter;

use App\Entity\Company;
use App\Entity\Invoice;
use App\Repository\Contract\InvoiceRepositoryInterface;
use App\Service\Constant\InvoiceStatus;
use App\Service\InvoiceService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class InvoiceServiceTest extends WebTestCase
{
    public function testCreatePendingAndOnHoldInvoices()
    {
        $company = $this->createInvoice();
        
        $invoice = new Invoice();
        $invoice->setCost(800.50)
            ->setCompany($company)
            ->setQuantity(20)
            ->setDescription('Lorem Ipsum')
        ;

        $repository = $this->mockInvoiceRepository($invoice);

        $invoiceService = new InvoiceService($repository);
        $result = $invoiceService->create($invoice);

        $this->assertEquals(InvoiceStatus::PENDING, $result->getStatus());

    }

    public function testCreateOnHoldInvoice()
    {
        $company = $this->createInvoice();

        $invoice = new Invoice();
        $invoice->setCost(9000)
            ->setCompany($company)
            ->setQuantity(20)
            ->setDescription('Lorem Ipsum')
        ;

        $repository = $this->mockInvoiceRepository($invoice);
        $invoiceService = new InvoiceService($repository);
        $result = $invoiceService->create($invoice);

        $this->assertEquals(InvoiceStatus::ON_HOLD, $result->getStatus());

    }

    public function createInvoice()
    {
        $company = new Company();
        $company->setId(10)
            ->setName('LIDL SÜD')
            ->setRiskLimit(1000);

        return $company;
    }

    public function mockInvoiceRepository(Invoice $invoice)
    {
        $repository = $this->createMock(InvoiceRepositoryInterface::class);
        $repository
            ->expects($this->once())
            ->method('create')
            ->willReturn($invoice)
        ;
        
        return $repository;
    }
}
