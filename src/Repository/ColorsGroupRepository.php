<?php

namespace App\Repository;

use App\Entity\ColorsGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ColorsGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method ColorsGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method ColorsGroup[]    findAll()
 * @method ColorsGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ColorsGroupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ColorsGroup::class);
    }

    // /**
    //  * @return ColorsGroup[] Returns an array of ColorsGroup objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ColorsGroup
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
