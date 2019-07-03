<?php

namespace App\Repository;

use App\Entity\CommentaireLecon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CommentaireLecon|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommentaireLecon|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommentaireLecon[]    findAll()
 * @method CommentaireLecon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentaireLeconRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CommentaireLecon::class);
    }

    // /**
    //  * @return CommentaireLecon[] Returns an array of CommentaireLecon objects
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
    public function findOneBySomeField($value): ?CommentaireLecon
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
