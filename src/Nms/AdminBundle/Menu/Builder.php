<?php

// src/Acme/DemoBundle/Menu/Builder.php

namespace Nms\AdminBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;
use Doctrine\Common\Util\Debug;

class Builder extends ContainerAware {

    public function mainMenu(FactoryInterface $factory, array $options) {
        $this->menu = $factory->createItem('root');
        $this->menu->setChildrenAttribute('class', 'page-sidebar-menu');
//        $menu->setAttribute('safe_label', true);

//        $this->menu->addChild('Dashboard', array(
//            'route' => 'NmsAdminBundle_homepage',
//            'extras' => array('safe_label' => true),
//                )
//        );
//        $this->menu['Dashboard']->setLabel('<i class="icon-home"></i><span class="title">Dashboard</span>');

        $this->em = $this->container->get('doctrine.orm.entity_manager');
        $level1 = $this->em->getRepository('NmsAdminBundle:Menu')->getChildren(0);
//        var_dump($entity);

        if (!$level1) {
            throw $this->createNotFoundException('Unable to find Menu entity.');
        }

        // loop over menu records, adding to the root
        foreach ($level1 as $row1) {
            $this->addMenu($this->menu, $row1);

            $level2 = $this->em->getRepository('NmsAdminBundle:Menu')->getChildren($row1['id']);

            if (count($level2) > 0) {
                $menuLabel = $this->menu[$row1['title']]->getLabel() . '<span class="arrow "></span>';
                $this->menu[$row1['title']]->setLabel($menuLabel);
                $this->menu[$row1['title']]->setChildrenAttribute('class', 'sub-menu');

                foreach ($level2 as $row2) {
                    $this->addMenu($this->menu[$row1['title']], $row2);

                    $level3 = $this->em->getRepository('NmsAdminBundle:Menu')->getChildren($row2['id']);

                    if (count($level3)>0) {
                        $menuLabel = $this->menu[$row1['title']][$row2['title']]->getLabel() . '<span class="arrow "></span>';
                        $this->menu[$row1['title']][$row2['title']]->setLabel($menuLabel);
                        $this->menu[$row1['title']][$row2['title']]->setChildrenAttribute('class', 'sub-menu');

                        foreach ($level3 as $row3) {
                            $this->addMenu($this->menu[$row1['title']][$row2['title']], $row3);

                            $level4 = $this->em->getRepository('NmsAdminBundle:Menu')->getChildren($row3['id']);

                            if (count($level4) > 0) {
                                $menuLabel = $this->menu[$row1['title']][$row2['title']][$row3['title']]->getLabel() . '<span class="arrow "></span>';
                                $this->menu[$row1['title']][$row2['title']][$row3['title']]->setLabel($menuLabel);
                                $this->menu[$row1['title']][$row2['title']][$row3['title']]->setChildrenAttribute('class', 'sub-menu');
                                foreach ($level3 as $row3) {
                                    $this->addMenu($this->menu[$row1['title']][$row2['title']][$row3['title']], $row3);
                                }
                            }
                        }
                    }
                }
            }
        }

        return $this->menu;
    }

    function addMenu($menu, $record) {
        $element = $record['title'];
        if ($record['external']) {
            $menu->addChild($element, array(
                'uri' => $record['url'],
                'extras' => array('safe_label' => true),
                    )
            );
        } else {
            $menu->addChild($element, array(
                'route' => $record['url'],
                'extras' => array('safe_label' => true),
                    )
            );
        }
        $label = '';
        if (!empty($record['icon'])) {
            $label = '<i class="icon-'. $record['icon'] . '"></i> ';
        }
        $label .= '<span class="title">' . $menu[$element]->getLabel() . '</span>';
        $menu[$element]->setLabel($label);
    }

}
