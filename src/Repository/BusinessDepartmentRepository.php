<?php

namespace App\Repository;

use App\Entity\BusinessDepartment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BusinessDepartment|null find($id, $lockMode = null, $lockVersion = null)
 * @method BusinessDepartment|null findOneBy(array $criteria, array $orderBy = null)
 * @method BusinessDepartment[]    findAll()
 * @method BusinessDepartment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BusinessDepartmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BusinessDepartment::class);
    }

    // /**
    //  * @return BusinessDepartment[] Returns an array of BusinessDepartment objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BusinessDepartment
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
