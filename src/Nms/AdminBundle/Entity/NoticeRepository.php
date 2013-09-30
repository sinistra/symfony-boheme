<?php

// src/Nms/AdminBundle/Entity/NoticeRepository.php

namespace Nms\AdminBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

class NoticeRepository extends EntityRepository {

    public function filteredFind($sort = "g.id", $direction = "ASC", $filterField = null, $filterVal = null) {

        $q = $this->createQueryBuilder('n')
            ->select ('n')
            ->orderBy($sort, $direction);
        if (!empty($filterField)) {
            $q->add('where', $filterField . ' LIKE  ?1')
                ->setParameter(1, '%' . $filterVal . '%');
        }

        return $q->getQuery()->getResult();
        }

    public function published() {

        $q = $this->createQueryBuilder('n')
            ->select ('n')
            ->orderBy('n.publish', 'DESC')
            ->add('where', 'n.publish <=' . date('Y-m-d'))
            ->add('where', 'n.expire >=' . date('Y-m-d'))
            ;

        return $q->getQuery()->getResult();
    }

}
