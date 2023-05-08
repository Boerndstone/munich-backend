<?php

namespace App\Repository;

use App\Entity\Area;
use App\Entity\Rock;
use App\Entity\Routes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Routes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Routes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Routes[]    findAll()
 * @method Routes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoutesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Routes::class);
    }

    public function getAllRoutes()
    {
        return $this->createQueryBuilder('routes')
            ->select('count(routes.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * Search by rock and/or term
     *
     * @return Routes[]
     */
    public function search(?Rock $rock, ?string $term)
    {
        $qb = $this->createQueryBuilder('routes');

        if ($rock) {
            $qb->andWhere('routes.rock = :rock')
                ->setParameter('rock', $rock);
        }

        if ($term) {
            $qb->andWhere('routes.name LIKE :term')
                ->setParameter('term', '%'.$term.'%');
        }

        return $qb
            ->getQuery()
            ->execute();
    }

    public function findAllRoutesBelowSix()
    {
        return $this->createQueryBuilder('routes')
            ->orderBy('routes.id', 'ASC')
            ->where('routes.gradeNo < 15')
            ->select('count(routes.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function findRoutesBelowSixForRock($rockSlug)
    {
        return $this->createQueryBuilder('routes')
            ->innerJoin('routes.rock', 'routes_rock')
            ->where('routes.gradeNo > 0 and routes.gradeNo < 15')
            ->andWhere('routes_rock.slug = :rockSlug')
            ->setParameter('rockSlug', $rockSlug)
            ->select('count(routes.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function findAllRoutesBelowEight()
    {
        return $this->createQueryBuilder('routes')
            ->orderBy('routes.id', 'ASC')
            ->where('routes.gradeNo >= 15 and routes.gradeNo <= 29')
            ->select('count(routes.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function findRoutesBelowEightForRock($rockSlug)
    {
        return $this->createQueryBuilder('routes')
            ->innerJoin('routes.rock', 'routes_rock')
            ->where('routes.gradeNo >= 15 and routes.gradeNo <= 29')
            ->andWhere('routes_rock.slug = :rockSlug')
            ->setParameter('rockSlug', $rockSlug)
            ->select('count(routes.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function findAllRoutesGreaterEight()
    {
        return $this->createQueryBuilder('routes')
            ->orderBy('routes.id', 'ASC')
            ->where('routes.gradeNo > 29')
            ->select('count(routes.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function findRoutesGreaterEightForRock($rockSlug)
    {
        return $this->createQueryBuilder('routes')
            ->innerJoin('routes.rock', 'routes_rock')
            ->where('routes.gradeNo > 29')
            ->andWhere('routes_rock.slug = :rockSlug')
            ->setParameter('rockSlug', $rockSlug)
            ->select('count(routes.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function findAllProjectds()
    {
        return $this->createQueryBuilder('routes')
            ->orderBy('routes.id', 'ASC')
            ->where('routes.gradeNo is NULL')
            ->select('count(routes.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function findProjectForRock($rockSlug)
    {
        return $this->createQueryBuilder('routes')
            ->innerJoin('routes.rock', 'routes_rock')
            ->where('routes.gradeNo = 0')
            ->andWhere('routes_rock.slug = :rockSlug')
            ->setParameter('rockSlug', $rockSlug)
            ->select('count(routes.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function findAllAlreadyClimbed()
    {
        return $this->createQueryBuilder('routes')
            ->orderBy('routes.id', 'ASC')
            ->where('routes.climbed = 1')
            ->select('count(routes.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function latestRoutes()
    {
        return $this->createQueryBuilder('routes')
            ->orderBy('routes.yearFirstAscent', 'DESC')
            ->innerJoin('routes.rock', 'routes_rock')
            ->setMaxResults( 5)
            ->getQuery()
            ->getResult()
        ;
    }

    public function latestRoutesPage($calculateDate)
    {
        return $this->createQueryBuilder('routes')
            ->orderBy('routes.yearFirstAscent', 'DESC')
            ->innerJoin('routes.rock', 'routes_rock')
            ->where('routes.yearFirstAscent >= :calculateDate')
            ->setParameter('calculateDate', $calculateDate)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findRoutesRock($rockSlug)
    {
        return $this->createQueryBuilder('routes')
            ->orderBy('routes.nr', 'ASC')
            ->innerJoin('routes.rock', 'routes_rock')
            ->andWhere('routes_rock.slug = :rockSlug')
            ->setParameter('rockSlug', $rockSlug)
            ->getQuery()
            ->getResult()
        ;
    }

    public function getGrades($area, $gradeLow, $gradeHigh) {
        return $this->createQueryBuilder('routes')
            ->innerJoin('routes.area', 'area')
            ->andWhere('routes.area = :area')
            ->setParameter('area', $area)
            ->andWhere('routes.gradeNo > :gradeLow')
            ->setParameter('gradeLow', $gradeLow)
            ->andWhere('routes.gradeNo <= :gradeHigh')
            ->setParameter('gradeHigh', $gradeHigh)
            ->select('count(routes.id)')
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }

    public function getProjects($area, $gradeLow, $gradeHigh) {
        return $this->createQueryBuilder('routes')
            ->innerJoin('routes.area', 'area')
            ->andWhere('routes.area = :area')
            ->setParameter('area', $area)
            ->andWhere('routes.gradeNo > :gradeLow')
            ->setParameter('gradeLow', $gradeLow)
            ->andWhere('routes.gradeNo <= :gradeHigh')
            ->setParameter('gradeHigh', $gradeHigh)
            ->select('count(routes.id)')
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }
}
