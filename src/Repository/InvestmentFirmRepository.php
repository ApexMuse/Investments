<?php

namespace App\Repository;

use App\Entity\InvestmentFirm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<InvestmentFirm>
 *
 * @method InvestmentFirm|null find($id, $lockMode = null, $lockVersion = null)
 * @method InvestmentFirm|null findOneBy(array $criteria, array $orderBy = null)
 * @method InvestmentFirm[]    findAll()
 * @method InvestmentFirm[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InvestmentFirmRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InvestmentFirm::class);
    }

    public function save(InvestmentFirm $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(InvestmentFirm $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return InvestmentFirm[] Returns an array of InvestmentFirm objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?InvestmentFirm
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
