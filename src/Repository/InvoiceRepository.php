<?php

namespace App\Repository;

use App\Entity\Invoice;
use App\Repository\Contract\InvoiceRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

/**
 * Class InvoiceRepository
 *
 * @package App\Repository
 */
class InvoiceRepository implements InvoiceRepositoryInterface
{
    private EntityManagerInterface $entityManager;
    private ObjectRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository(Invoice::class);
    }

    /**
     * @param Invoice $invoice
     *
     * @return Invoice
     */
    public function create(Invoice $invoice): Invoice
    {
        $this->entityManager->persist($invoice);
        $this->entityManager->flush();

        return $invoice;
    }

    /**
     * @param Invoice $invoice
     *
     * @return Invoice
     */
    public function update(Invoice $invoice): Invoice
    {
        $this->entityManager->persist($invoice);
        $this->entityManager->flush();

        return $invoice;
    }

    /**
     * @param array  $criteria
     *
     * @return float|null
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getTotalAmountBy(array $criteria): ?float
    {
        // todo validate isset keys
        /** @var \Doctrine\ORM\QueryBuilder $QueryBuilder */
        $QueryBuilder = $this->repository->createQueryBuilder('i');
        $QueryBuilder
            ->select("SUM(i.cost)")
            ->andWhere($QueryBuilder->expr()->eq('i.company', ':company_id'))
            ->setParameter('company_id', $criteria['company_id'])
        ;

        $QueryBuilder
            ->andWhere($QueryBuilder->expr()->eq('i.status', ':status'))
            ->setParameter('status', $criteria['status'])
        ;

        return $QueryBuilder
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }
}
