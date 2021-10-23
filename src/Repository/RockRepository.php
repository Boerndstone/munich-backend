<?php

namespace App\Repository;

use App\Entity\Area;
use App\Entity\Rock;
use App\Entity\Routes;
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

    public function amountRocks($amount_rocks) {
        $sql = 'SELECT * FROM area INNER JOIN rock ON area.id = rock.area_relation_id WHERE area_relation_id = :amountRocks';
        $query = $this->pdo->prepare($sql);
        $query->bindParam(':amountRocks', $amount_rocks);
        $query->execute();
        $rocks = $query->rowCount();
        return $rocks;
    }

    /**
     * @return Rocks[] Returns an array of Rocks objects
     */
    public function findSearchTerm(string $search = null): array
    {
        $queryBuilder = $this->createQueryBuilder('rock')
            //->addCriteria(self::createApprovedCriteria())
            ->orderBy('rock.id', 'ASC')
            //->innerJoin('routes.rock_id', 'rock')
            ->addSelect('rock');
        if ($search) {
            $queryBuilder->andWhere('rock.name LIKE :searchTerm')
                ->setParameter('searchTerm', '%'.$search.'%');
        }
        return $queryBuilder
            //->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }




    
}
