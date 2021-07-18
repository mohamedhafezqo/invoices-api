<?php

namespace App\Repository\Contract;

use App\Entity\Company;

/**
 * Interface CompanyRepositoryInterface
 *
 * @package App\Repository\Contract
 */
interface CompanyRepositoryInterface
{
    /**
     * @param Company $company
     *
     * @return Company
     */
    public function create(Company $company): Company;
}
