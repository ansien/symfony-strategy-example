<?php

namespace App\Repository;

use App\Entity\TestProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TestProduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method TestProduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method TestProduct[]    findAll()
 * @method TestProduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TestProductRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TestProduct::class);
    }

//    /**
//     * @return TestProduct[] Returns an array of TestProduct objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TestProduct
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
