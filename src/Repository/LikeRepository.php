<?php

namespace App\Repository;

use App\Entity\Like;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Like|null find($id, $lockMode = null, $lockVersion = null)
 * @method Like|null findOneBy(array $criteria, array $orderBy = null)
 * @method Like[]    findAll()
 * @method Like[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LikeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Like::class);
    }

    public function nombreObjets($idArticle)
    {
        try {
            return $this->createQueryBuilder('l')
                ->select('count(l.id)')
                ->where('l.article = :idArticle')
                ->setParameter('idArticle', $idArticle)
                ->getQuery()
                ->getSingleScalarResult();
        } catch (NoResultException | NonUniqueResultException $e) {
            return 0;
        }
    }

    public function nombreLikes($idArticle)
    {
        try {
            return $this->createQueryBuilder('l')
                ->select('count(l.id)')
                ->andWhere('l.article = :idArticle')
                ->andWhere('l.typeLike = :likeType')
                ->setParameters(['likeType' => true, 'idArticle' => $idArticle])
                ->getQuery()
                ->getSingleScalarResult();
        } catch (NoResultException | NonUniqueResultException $e) {
            return 0;
        }
    }
}
