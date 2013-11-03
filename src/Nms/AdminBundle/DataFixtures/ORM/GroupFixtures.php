<?php

// src/Nms/AdminBundle/DataFixtures/ORM/GroupFixtures.php

namespace Nms\AdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Nms\AdminBundle\Entity\Group;

class UserFixtures extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface {

    private $container;

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    public function load(ObjectManager $manager) {
        $group1 = new Group();
        $group1->setName('User');
        $group1->setRole('ROLE_USER');
        $group1->setCreated(new \DateTime());
        $group1->setUpdated($group1->getCreated());
        $manager->persist($group1);

        $group2 = new Group();
        $group2->setName('Administrator');
        $group2->setRole('ROLE_ADMIN');
        $group2->setCreated(new \DateTime());
        $group2->setUpdated($group2->getCreated());
        $manager->persist($group2);

        $group3 = new Group();
        $group3->setName('President');
        $group3->setRole('ROLE_PRESIDENT');
        $group3->setCreated(new \DateTime());
        $group3->setUpdated($group3->getCreated());
        $manager->persist($group3);

        $group4 = new Group();
        $group4->setName('Registrar');
        $group4->setRole('ROLE_REGISTRAR');
        $group4->setCreated(new \DateTime());
        $group4->setUpdated($group4->getCreated());
        $manager->persist($group4);

        $group5 = new Group();
        $group5->setName('Secretary');
        $group5->setRole('ROLE_SECRETARY');
        $group5->setCreated(new \DateTime());
        $group5->setUpdated($group5->getCreated());
        $manager->persist($group5);

        $group6 = new Group();
        $group6->setName('Treasurer');
        $group6->setRole('ROLE_TREASURER');
        $group6->setCreated(new \DateTime());
        $group6->setUpdated($group6->getCreated());
        $manager->persist($group6);

        $group7 = new Group();
        $group7->setName('Coach');
        $group7->setRole('ROLE_COACH');
        $group7->setCreated(new \DateTime());
        $group7->setUpdated($group7->getCreated());
        $manager->persist($group7);

        $group8 = new Group();
        $group8->setName('Manager');
        $group8->setRole('ROLE_MANAGER');
        $group8->setCreated(new \DateTime());
        $group8->setUpdated($group8->getCreated());
        $manager->persist($group8);

        $group9 = new Group();
        $group9->setName('Referee');
        $group9->setRole('ROLE_REFEREE');
        $group9->setCreated(new \DateTime());
        $group9->setUpdated($group9->getCreated());
        $manager->persist($group9);

        $group10 = new Group();
        $group10->setName('District');
        $group10->setRole('ROLE_DISTRICT');
        $group10->setCreated(new \DateTime());
        $group10->setUpdated($group10->getCreated());
        $manager->persist($group10);

        $group11 = new Group();
        $group11->setName('Competition Manager');
        $group11->setRole('ROLE_COMPMGR');
        $group11->setCreated(new \DateTime());
        $group11->setUpdated($group11->getCreated());
        $manager->persist($group11);

        $manager->flush();
    }

    public function getOrder() {
        return 1;
    }

}