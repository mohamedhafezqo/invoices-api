<?php

namespace App\Test\Unit\Formatter;

use App\Entity\Company;
use App\Repository\CompanyRepository;
use App\Service\CompanyService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CompanyServiceTest extends WebTestCase
{
    public function testCreate()
    {
        $company = new Company();
        $company->setName('LIDL SÜD')
            ->setRiskLimit(1000);

        $repository = $this->createMock(CompanyRepository::class);
        $repository
            ->expects($this->once())
            ->method('create')
            ->willReturn($company)
        ;

        $companyService = new CompanyService($repository);
        $result = $companyService->create($company);

        $this->assertEquals(1000, $result->getRiskLimit());
        $this->assertEquals('LIDL SÜD', $result->getName());
    }
}
