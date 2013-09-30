<?php

// src/Nms/AdminBundle/Entity/UserRepository.php

namespace Nms\AdminBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

class UserRepository extends EntityRepository implements UserProviderInterface {

    public function loadUserByUsername($username) {
        $q = $this
                ->createQueryBuilder('u')
                ->select('u, g')
                ->leftJoin('u.groups', 'g')
                ->where('u.username = :username OR u.email = :email')
                ->setParameter('username', $username)
                ->setParameter('email', $username)
                ->getQuery();
        try {
            // The Query::getSingleResult() method throws an exception
            // if there is no record matching the criteria.
            $user = $q->getSingleResult();
        } catch (NoResultException $e) {
            $message = sprintf('Unable to find an active user NmsAdminBundle:User object identified by "%s".', $username);
            throw new UsernameNotFoundException($message, 0, $e);
        }
        return $user;
    }

    public function refreshUser(UserInterface $user) {
        $class = get_class($user);
        if (!$this->supportsClass($class)) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', $class)
            );
        }

        return $this->find($user->getId());
    }

    public function supportsClass($class) {
        return $this->getEntityName() === $class || is_subclass_of($class, $this->getEntityName());
    }

    public function filteredFind($sort = "u.id", $direction = "ASC", $filterField = null, $filterVal = null) {

//        $q = $this->createQueryBuilder();
//        $q->select ('u, c')
//            ->Join('u.clubs', 'c')
//            ->orderBy($sort, $direction);
//        if (!empty($filterField)) {
//            $q->add('where', $filterField . ' LIKE  ?1')
//                ->setParameter(1, '%' . $filterVal . '%');
//        }
//        return $q->getQuery()->getResult();
        $query = $this->getEntityManager()->createQuery('SELECT u, c FROM Nms\AdminBundle\Entity\User u LEFT JOIN u.club c');
        $users = $query->getResult();
        return $users;
        }

}
