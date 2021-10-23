<?php

namespace App\Repository;

use App\Entity\Area;
use App\Entity\Rock;
use App\Entity\Routes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

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

    /**
     * @return Area[] Returns an array of Area objects
     */
    public function findAllAreasAlphabetical ()
    {
        return $this->createQueryBuilder('area')
            ->orderBy('area.id', 'ASC')
            //->where('area.online = 1')
            /*->innerJoin('area.rocks', 'rocks')
            ->innerJoin('area.routes', 'routes')
            ->addSelect('area.name as areaName')
            ->addSelect('area.slug as areaSlug')
            ->addSelect('area.image as areaImage')
            ->addSelect('rocks.name as rocksName')
            ->addSelect('rocks.id as rocksID')*/
            //->addSelect('routes.name as routesName')
            
            //->addSelect("COUNT(rocks.areaRelation) as amountRocks")
           
            //->addSelect("COUNT(routes.id) as amountRoutes")
            

            //->groupBy('rocks.areaRelation')
            //->addGroupBy('routes.id')
            //->addSelect('rocks.name as areaRocks')
            

            ->getQuery()
            ->getResult()
            
        ;

        // Das wäre dann der inner join!!!!!
        /*$qb = $this->createQueryBuilder('area')
            ->innerJoin('area.rocks', 'rocks')
            //->addSelect('rocks')
            ->orderBy('area.sequence', 'ASC')
            ->andWhere('area.online = 1')
            ->addSelect('area.name as areaName')
            ->addSelect('rocks.name as rocksName')

        ;*/

        //$query = $qb->getQuery();
        //var_dump($query->getDQL());
        //die();

        //return $query->getArrayResult();
        //getOneORNullResult
    }

    /**
     * @return Area[] Returns an array of Area objects
     */
    public function getAreasFrontend ()
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.sequence', 'ASC')
            ->where('a.online = 1')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Rocks[] Returns an array of Rocks objects
     */
    public function getRocksAreasFrontend ()
    {
        $entityManager = $this->getEntityManager();

        return $this->createQueryBuilder('area')
            ->innerJoin('area.rocks', 'area_rocks')
            ->select('area.name as areaName')
            ->addSelect('area.online as areaOnline')
            //->addSelect('area.rockName as name')
            //->andWhere('area.online = 1')
            
            ->getQuery()
            ->execute()
        ;

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
    public function getRocksRoutesFrontend ()
    {
        $entityManager = $this->getEntityManager();

        return $this->createQueryBuilder('area')
            ->andWhere('area.online = 1')
            ->leftJoin('area.routes', 'area_routes')
            ->getQuery()
            ->execute()
        ;

    }

    /**
     * @return RoutesLowerFiveteen[]
     */

    public function getRocksLowerFiveteen ($value) : array
    {
        $entityManager = $this->getEntityManager();

        return $this->createQueryBuilder('area')
            //->where('routes.gradeNo < 15')
            //->setParameter('routes.areaId', $grade)
            ->andWhere('area.id = :val')
            ->setParameter('val', $value)
            ->innerJoin('area.routes', 'routes')
            ->addSelect('routes.gradeNo')
            ->where('routes.gradeNo < 15')
            ->getQuery()
            ->getResult()
        ;

    }



    // /**
    //  * @return Area[] Returns an array of Area objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Area
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
