<?php

namespace Boheme\CafeBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * MealRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MealRepository extends EntityRepository {

    public function filteredFind($sort = "m.id", $direction = "ASC", $filterField = null, $filterVal = null) {
        $q = $this->createQueryBuilder('m')
                ->select('m')
                ->orderBy($sort, $direction);
        if (!empty($filterField)) {
            $q->add('where', $filterField . ' LIKE  ?1')
                ->setParameter(1, '%' . $filterVal . '%');
        }
        return $q->getQuery()->getResult();

//        $query = $em->createQuery('SELECT c FROM Club c JOIN t.clubtype t WHERE u.id = ?1');
//        $query-> $query->setParameter(1, 3);  // set ?1 to 3
//        $users = $query->getResult(); // array of ForumUser objects
    }

}
