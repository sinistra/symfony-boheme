<?php

// src/Nms/AdminBundle/DataFixtures/ORM/UserFixtures.php

namespace Nms\AdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Nms\AdminBundle\Entity\User;

class UserFixtures extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface {

    private $container;

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    public function load(ObjectManager $manager) {
        $user1 = new User();
        $user1->setUsername('paul');
        $user1->setName('Paul Taylor');
        $user1->setSalt(md5(uniqid(null, true)));

        $encoder = $this->container->get('security.encoder_factory')->getEncoder($user1);
        $user1->setPassword($encoder->encodePassword('gordon', $user1->getSalt()));
        $user1->setEmail('paul@nms.com.au');
        $user1->setActive(true);
        $user1->setClub_id(0);
        $user1->setCreated(new \DateTime());
        $user1->setUpdated($user1->getCreated());
        $manager->persist($user1);

        $user2 = new user();
        $user2->setUsername('user');
        $user2->setName('User One');
        $user2->setSalt(md5(uniqid(null, true)));

        $encoder = $this->container->get('security.encoder_factory')->getEncoder($user2);
        $user2->setPassword($encoder->encodePassword('userpass', $user2->getSalt()));
        $user2->setEmail('user@nms.com.au');
        $user2->setActive(true);
        $user2->setClub_id(1);
        $user2->setCreated(new \DateTime());
        $user2->setUpdated($user1->getCreated());
        $manager->persist($user2);

        $manager->flush();
    }

    public function getOrder() {
        return 2;
    }

}