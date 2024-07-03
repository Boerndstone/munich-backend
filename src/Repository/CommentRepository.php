<?php

namespace App\Repository;

use App\Entity\Comment;
use App\Entity\User;
use App\Entity\Routes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Comment>
 *
 * @method Comment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comment[]    findAll()
 * @method Comment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comment::class);
    }

    public function latestComments()
    {
        return $this->createQueryBuilder('comment')
            ->select(
                'comment',
                'user.firstname AS username',
                'route.name AS routeName',
                'rock.slug AS rockSlug',
                'area.slug AS areaSlug',
                'comment.comment AS commentComment',
                'comment.datetime AS commentDate'
            )
            ->innerJoin('comment.user', 'user')
            ->innerJoin('comment.route', 'route')
            ->innerJoin('route.rock', 'rock')
            ->innerJoin('route.area', 'area')
            ->where('comment.datetime IS NOT NULL') // Ensure datetime is not null
            ->orderBy('comment.datetime', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
    }
}
