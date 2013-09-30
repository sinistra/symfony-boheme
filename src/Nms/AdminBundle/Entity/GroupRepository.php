<?php

// src/Nms/AdminBundle/Entity/GroupRepository.php

namespace Nms\AdminBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

class GroupRepository extends EntityRepository {

    public function filteredFind($sort = "g.id", $direction = "ASC", $filterField = null, $filterVal = null) {

        $q = $this->createQueryBuilder('g')
            ->select ('g')
            ->orderBy($sort, $direction);
        if (!empty($filterField)) {
            $q->add('where', $filterField . ' LIKE  ?1')
                ->setParameter(1, '%' . $filterVal . '%');
        }

        return $q->getQuery()->getResult();
        }

}
