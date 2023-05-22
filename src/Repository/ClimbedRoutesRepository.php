<?php

namespace App\Repository;

use App\Entity\ClimbedRoutes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ClimbedRoutes>
 *
 * @method ClimbedRoutes|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClimbedRoutes|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClimbedRoutes[]    findAll()
 * @method ClimbedRoutes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClimbedRoutesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClimbedRoutes::class);
    }

    public function save(ClimbedRoutes $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ClimbedRoutes $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ClimbedRoutes[] Returns an array of ClimbedRoutes objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ClimbedRoutes
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
