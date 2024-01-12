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
                ->setParameter('term', '%' . $term . '%');
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

    public function findRoutesRock($rockSlug)
    {
        return $this->createQueryBuilder('routes')
            ->orderBy('routes.nr', 'ASC')
            ->innerJoin('routes.rock', 'routes_rock')
            ->andWhere('routes_rock.slug = :rockSlug')
            ->setParameter('rockSlug', $rockSlug)
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

    // function getParamsWithTopo($felsname, $value)
    // {
    //     global $pdo;
    //     $sql = 'SELECT  
    // 			area.name as areaName,
    // 			area.id as areaId,
    // 			area.slug as areaSlug,
    // 			rock.area_id as rockAreaId,
    // 			routes.id as routesId,
    // 			rock.id as rockId,
    // 			rock.nr as rockNr,
    // 			routes.nr as routesNr,
    // 			routes.name as routesName,
    // 			routes.grade as routesGrade,
    // 			routes.first_ascent as routesFirstAscent,
    // 			routes.year_first_ascent as routesYearFirstAscent,
    // 			routes.protection as routesProtection,
    // 			routes.description as routesDescription,
    // 			routes.rating as routesRating,
    // 			topo.with_sector as topoWithSector,
    // 			topo.name as topoName,
    // 			topo.image as topoImage,
    // 			topo.svg as topoSVG
    // 			FROM area 
    // 			INNER JOIN rock ON area.id = rock.area_id 
    // 			INNER JOIN routes ON rock.id = routes.rock_id 
    // 			INNER JOIN topo ON routes.topo_id = topo.number 
    // 			WHERE rock.name = :felsname 
    // 			AND routes.rock_id = topo.rocks_id 
    // 			AND routes.topo_id = topo.number 
    // 			AND routes.topo_id = :value 
    // 			ORDER BY routes.nr';
    //     $query = $pdo->prepare($sql);
    //     $query->bindParam(':felsname', $felsname);
    //     $query->bindParam(':value', $value);
    //     $query->execute();
    //     return $query;
    // }
}
