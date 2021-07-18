<?php

namespace App\Service;

use App\Entity\Company;
use App\Repository\Contract\CompanyRepositoryInterface;
use App\Service\Contract\CompanyServiceInterface;

/**
 * Class CompanyService
 *
 * @package App\Service
 */
class CompanyService implements CompanyServiceInterface
{
    /**
     * @var CompanyRepositoryInterface
     */
    private CompanyRepositoryInterface $repository;

    /**
     * InvoiceService constructor.
     *
     * @param CompanyRepositoryInterface $repository
     */
    public function __construct(CompanyRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Company $company
     *
     * @return Company
     */
    public function create(Company $company): Company
    {
        return $this->repository->create($company);
    }
}
