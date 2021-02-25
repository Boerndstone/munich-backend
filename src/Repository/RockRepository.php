<?php

namespace App\Repository;

use App\Entity\Area;
use App\Entity\Rock;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Rock|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rock|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rock[]    findAll()
 * @method Rock[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RockRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rock::class);
    }

    // /**
    //  * @return Rock[] Returns an array of Rock objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    
    public function findAllRocksFromAreaFrontend(int $areaRelation)
    {
        /*return $this->createQueryBuilder('r')
            ->andWhere('r.areaRelation = :val')
            ->setParameter('rocks', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;*/

        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT a, r
            FROM App\Entity\Area a
            JOIN a.rocks r
            WHERE a.id = :rocks'
        )->setParameter('rocks', $areaRelation);

        return $query->getResult();
    }

    public function getAreaRockCountFrontend(int $areaRelation)
    {
        /*return $this->createQueryBuilder('r')
            ->andWhere('r.areaRelation = :val')
            ->setParameter('rocks', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;*/

        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT count(r.id)
            FROM App\Entity\Area a
            JOIN a.rocks r
            WHERE a.id = :rocks'
        )->setParameter('rocks', $areaRelation);

        return $query->getResult();
    }




    
}
