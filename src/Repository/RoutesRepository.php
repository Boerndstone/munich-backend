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

    public function findAllRoutesBelowSix()
    {
        return $this->createQueryBuilder('routes')
            ->orderBy('routes.id', 'ASC')
            ->where('routes.gradeNo < 15')
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

    public function findAllRoutesGreaterEight()
    {
        return $this->createQueryBuilder('routes')
            ->orderBy('routes.id', 'ASC')
            ->where('routes.gradeNo > 29')
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
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
    }

    public function latestRoutesPage($calculateDate)
    {
        return $this->createQueryBuilder('routes')
            ->orderBy('routes.yearFirstAscent', 'DESC')
            ->innerJoin('routes.rock', 'routes_rock')
            ->where('routes.yearFirstAscent >= :calculateDate')
            ->setParameter('calculateDate', $calculateDate)
            ->getQuery()
            ->getResult();
    }

    public function getGrades($area, $gradeLow, $gradeHigh)
    {
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
            ->getSingleScalarResult();
    }

    public function getProjects($area, $gradeLow, $gradeHigh)
    {
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
            ->getSingleScalarResult();
    }

    public function getToposWithRoutes($rockName, $counter)
    {
        return $this->createQueryBuilder('routes')
            ->select('routes.name')
            ->where('rock.name = :rockName')
            ->innerJoin('routes.rock', 'routes_rock')
            // ->innerJoin('routes.rock', 'routes_rock')
            ->setParameter('rockName', $rockName)
            ->setParameter('counter', $counter)
            ->getQuery()
            ->getResult();
    }

    public function search($query)
    {
        return $this->createQueryBuilder('r')
            ->where('r.name LIKE :query')
            ->setParameter('query', "%$query%")
            ->getQuery()
            ->getResult();
    }
}
