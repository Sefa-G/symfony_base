<?php

namespace App\Repository;

use App\Entity\Onion;
use App\Entity\Burger;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Onion>
 *
 * @method Onion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Onion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Onion[]    findAll()
 * @method Onion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OnionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Onion::class);
    }

    public function findOnionsByBurger(Burger $burger)
    {
        $qb = $this->createQueryBuilder("p")
            ->where(':burger MEMBER OF p.burgers')
            ->setParameters(array('burger' => $burger))
        ;
        return $qb->getQuery()->getResult();
    }

//    /**
//     * @return Onion[] Returns an array of Onion objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Onion
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
