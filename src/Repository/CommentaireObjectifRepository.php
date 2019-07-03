<?php

namespace App\Repository;

use App\Entity\CommentaireObjectif;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CommentaireObjectif|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommentaireObjectif|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommentaireObjectif[]    findAll()
 * @method CommentaireObjectif[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentaireObjectifRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CommentaireObjectif::class);
    }

    // /**
    //  * @return CommentaireObjectif[] Returns an array of CommentaireObjectif objects
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
    public function findOneBySomeField($value): ?CommentaireObjectif
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
