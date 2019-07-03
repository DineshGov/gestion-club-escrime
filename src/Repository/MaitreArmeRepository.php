<?php

namespace App\Repository;

use App\Entity\MaitreArme;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MaitreArme|null find($id, $lockMode = null, $lockVersion = null)
 * @method MaitreArme|null findOneBy(array $criteria, array $orderBy = null)
 * @method MaitreArme[]    findAll()
 * @method MaitreArme[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MaitreArmeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MaitreArme::class);
    }

    // /**
    //  * @return MaitreArme[] Returns an array of MaitreArme objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MaitreArme
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
