<?php

namespace App\Repository;

use App\Entity\Topo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Topo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Topo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Topo[]    findAll()
 * @method Topo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TopoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Topo::class);
    }

    /**
     * @return Topos[] Returns an array of Rocks objects
     */
    public function getTopos($rockId): array
    {
        $queryBuilder = $this->createQueryBuilder('topo')
            ->select('topo.name')
            ->innerJoin('topo.rocks', 'rocks')
            ->where('rocks.id LIKE :rockId')
            ->andWhere('topo.withSector = 1')
            ->setParameter('rockId', $rockId)
            ->getQuery()
            ->getResult();
        return $queryBuilder;
    }
}
