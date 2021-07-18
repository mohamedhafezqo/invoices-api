<?php

namespace App\Repository;

use App\Entity\Company;
use App\Repository\Contract\CompanyRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

/**
 * Class CompanyRepository
 *
 * @package App\Repository
 */
class CompanyRepository implements CompanyRepositoryInterface
{
    private EntityManagerInterface $entityManager;
    private ObjectRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository(Company::class);
    }

    public function create(Company $company): Company
    {
        $this->entityManager->persist($company);
        $this->entityManager->flush();

        return $company;
    }
}
