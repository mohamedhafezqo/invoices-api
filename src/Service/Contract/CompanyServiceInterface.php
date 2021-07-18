<?php

namespace App\Service\Contract;

use App\Entity\Company;

/**
 * Interface CompanyServiceInterface
 *
 * @package App\Service\Contract
 */
interface CompanyServiceInterface
{
    /**
     * @param Company $company
     *
     * @return Company
     */
    public function create(Company $company): Company;
}
