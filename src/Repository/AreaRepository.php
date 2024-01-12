<?php

namespace App\Repository;

use App\Entity\Area;
use App\Entity\Routes;
use Doctrine\ORM\Query;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Common\Collections\Criteria;

/**
 * @method Area|null find($id, $lockMode = null, $lockVersion = null)
 * @method Area|null findOneBy(array $criteria, array $orderBy = null)
 * @method Area[]    findAll()
 * @method Area[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AreaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Area::class);
    }

    // Doctrine's normal mode is to always return objects, not an array of data.
    public function findAllOrderedBy()
    {
        //die('Servus');

        //$dql = 'SELECT area From App\Entity\Area area';
        //$query = $this->getEntityManager()->createQuery($dql);
        //var_dump($query->getSQL()); die;

        $qb = $this->createQueryBuilder('area')
            ->addOrderBy('area.name', 'DESC');
        $query = $qb->getQuery();
        //var_dump($query->getSQL()); die;

        return $query->execute();
    }

    public function getAreaName($slug)
    {
        return $this->createQueryBuilder('area')
            ->innerJoin('area.rock', 'rock')
            ->where('rock.slug = :slug')
            ->setParameter('slug', $slug)
            ->getQuery()
            ->getResult();
    }

    public function getAreaId($slug)
    {
        return $this->createQueryBuilder('area')

            ->where('rocks.slug = :slug')
            ->innerJoin('area.rocks', 'rocks')
            ->setParameter('slug', $slug)
            ->getQuery()
            ->getResult();
    }

    public function search($term)
    {
        return $this->createQueryBuilder('area')
            // always use andWhere!!!!
            ->andWhere('area.name LIKE :searchTerm OR area.orientation LIKE :searchTerm OR route.name LIKE :searchTerm')
            ->leftJoin('area.routes', 'route')
            ->addSelect('route')
            ->setParameter('searchTerm', '%' . $term . '%')
            ->getQuery()
            ->execute();
    }

    public function getAllAreas()
    {
        return $this->createQueryBuilder('areas')
            ->select('count(areas.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * @return Area[] Returns an array of Area objects
     */
    public function findAllAreasAlphabetical()
    {
        return $this->createQueryBuilder('area')
            ->orderBy('area.id', 'ASC')
            // ->where('area.online = 1')
            /*->innerJoin('area.rocks', 'rocks')
            ->innerJoin('area.routes', 'routes')
            ->addSelect('area.name as areaName')
            ->addSelect('area.slug as areaSlug')
            ->addSelect('area.image as areaImage')
            ->addSelect('rocks.name as rocksName')
            ->addSelect('rocks.id as rocksID')*/
            // ->addSelect('routes.name as routesName')

            // ->addSelect("COUNT(rocks.areaRelation) as amountRocks")

            // ->addSelect("COUNT(routes.id) as amountRoutes")

            // ->groupBy('rocks.areaRelation')
            // ->addGroupBy('routes.id')
            // ->addSelect('rocks.name as areaRocks')

            ->getQuery()
            ->getResult();

        // Das wäre dann der inner join!!!!!
        /*$qb = $this->createQueryBuilder('area')
            ->innerJoin('area.rocks', 'rocks')
            //->addSelect('rocks')
            ->orderBy('area.sequence', 'ASC')
            ->andWhere('area.online = 1')
            ->addSelect('area.name as areaName')
            ->addSelect('rocks.name as rocksName')

        ;*/

        // $query = $qb->getQuery();
        // var_dump($query->getDQL());
        // die();

        // return $query->getArrayResult();
        // getOneORNullResult
    }

    /**
     * @return Area[] Returns an array of Area objects
     */
    public function getAreasFrontend()
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.sequence', 'ASC')
            ->where('a.online = 1')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return AreaRocksRoutes[] Returns an array of Area objects
     */
    public function getTheStuff()
    {
        return $this->createQueryBuilder('area')
            //->orderBy('area.sequence', 'ASC')
            ->join('area.rocks', 'rocks')
            ->addSelect('rocks')
            ->join('area.routes', 'routes')
            ->addSelect('routes')
            ->where('area.online = 1')
            ->getQuery()
            ->getResult();
    }

    public function priceHistoryImportQuery(): Query
    {
        return $this
            ->createQueryBuilder('u')
            ->select('u, o, city')
            ->leftJoin('u.object', 'o')
            ->leftJoin('o.city', 'city')
            ->where('u.entry_type is null')
            ->orderBy('u.id', Criteria::DESC)
            ->getQuery();
    }

    /**
     * @return Grades[] Returns an array of Grades objects
     */
    public function getGradesArea($id, $gradeLow, $gradeHigh)
    {
        return $this->createQueryBuilder('area')
            ->innerJoin('area.routes', 'routes')
            ->andWhere('routes.area = :id')
            ->setParameter('id', $id)
            ->andWhere('routes.gradeNo > :gradeLow')
            ->setParameter('gradeLow', $gradeLow)
            ->andWhere('routes.gradeNo <= :gradeHigh')
            ->setParameter('gradeHigh', $gradeHigh)
            ->select('count(routes.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * @return Rocks[] Returns an array of Rocks objects
     */
    public function getRocksAreasFrontend()
    {
        $entityManager = $this->getEntityManager();

        return $this->createQueryBuilder('area')
            ->innerJoin('area.rocks', 'area_rocks')
            ->select('area.name as areaName')
            ->addSelect('area.online as areaOnline')
            // ->addSelect('area.rockName as name')
            // ->andWhere('area.online = 1')

            ->getQuery()
            ->execute();
    }

    /* $qb = $em
            ->createQueryBuilder()
            ->from(Image::class, 'i')
            ->select('i.id as id')
            ->addSelect('i.status as status')
            ->addSelect('i.img_nr as imgnr')
            ->addSelect('i.flag as flag')
            ->addSelect('i.img_width as imgwidth')
            ->addSelect('i.img_height as imgheight')
            ->addSelect('i.notice as notice')
            ->addSelect('i.description as description')
            ->addSelect('i.img_group as igroup')
            ->addSelect("Field(i.img_group, '', 'blueprint', 'newsletter',  'nl_premium', 'rotation', 'banner_listing','banner_portal',  'theme', 'square', 'other', 'zfile', 'unit') as orderField")
            ->where("i.data_type='object'")
            ->andWhere('i.data_id LIKE :objId')
            ->andWhere('i.status>0')
            ->orderBy('i.status', 'DESC')
            ->addOrderBy('orderField', 'ASC')
            ->addOrderBy('i.flag', 'DESC')
            ->addOrderBy('i.priority', 'DESC')
            ->addOrderBy('i.id', 'DESC')
            ->setParameter('objId', $object->getId());
        $query = $qb->getQuery();
        $images = $query->getArrayResult();*/

    /**
     * @return Routes[] Returns an array of Routes objects
     */
    public function getRocksRoutesFrontend()
    {
        $entityManager = $this->getEntityManager();

        return $this->createQueryBuilder('area')
            ->andWhere('area.online = 1')
            ->leftJoin('area.routes', 'area_routes')
            ->getQuery()
            ->execute();
    }

    public function getAreasInformation()
    {
        $qb = $this->createQueryBuilder('area')
            ->select(
                'area.id as areaId',
                'area.name as name',
                'area.slug as slug',
                'area.image as image',
                'area.lat as lat',
                'area.lng as lng',
                'COUNT(DISTINCT route.id) AS routes',
                'COUNT(DISTINCT rock.id) AS rocks',
                'COUNT(DISTINCT CASE WHEN route.gradeNo > 0 AND route.gradeNo <= 15 THEN route.id ELSE 0 END) AS amountEasy',
                'COUNT(DISTINCT CASE WHEN route.gradeNo > 15 AND route.gradeNo <= 29 THEN route.id ELSE 0 END) AS amountMiddle',
                'COUNT(DISTINCT CASE WHEN route.gradeNo > 29 AND route.gradeNo <= 60 THEN route.id ELSE 0 END) AS amountHard',
                'COUNT(DISTINCT CASE WHEN route.gradeNo = 0 OR route.gradeNo IS NULL THEN route.id ELSE 0 END) AS amountProjects'
            )
            ->leftJoin('area.routes', 'route')
            ->leftJoin('area.rocks', 'rock')
            ->where('area.online = 1')
            ->groupBy('area.id, area.name')
            ->orderBy('area.sequence');

        return $qb->getQuery()->getResult();
    }
}
