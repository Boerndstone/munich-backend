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

    /**
     * @return Rock[] Returns an array of Rock objects
     */
    
    public function findByAreaId($amount_rocks) : array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT * FROM area INNER JOIN rock ON area.id = rock.area_relation_id WHERE area_relation_id = :amountRocks';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['amount_rocks' => $amount_rocks]);

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAllAssociative();
    }
    

    
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

    public function amountRocks($amount_rocks) {
        $sql = 'SELECT * FROM area INNER JOIN rock ON area.id = rock.area_relation_id WHERE area_relation_id = :amountRocks';
        $query = $this->pdo->prepare($sql);
        $query->bindParam(':amountRocks', $amount_rocks);
        $query->execute();
        $rocks = $query->rowCount();
        return $rocks;
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
