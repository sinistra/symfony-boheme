<?php

// src/Nms/AdminBundle/DataFixtures/ORM/MenuFixtures.php

namespace Nms\AdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Nms\AdminBundle\Entity\Menu;

class UserFixtures extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface {

    private $container;

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    public function load(ObjectManager $manager) {
        $parent0 = 0;

        $menu1 = new Menu();
        $menu1->setName('Player');
        $menu1->setUrl('/player');
        $menu1->setSeq(1);
        $menu1->setSecured(1);
        $menu1->setParent($parent0);
        $menu1->setCreated(new \DateTime());
        $menu1->setUpdated($menu1->getCreated());
        $manager->persist($menu1);

        $parent1 = $menu1->getId();

        $menu2 = new Menu();
        $menu2->setName('Current List');
        $menu2->setUrl('index.php?action=playerlist');
        $menu2->setSeq(1);
        $menu2->setSecured(1);
        $menu2->setParent($parent1);
        $menu2->setCreated(new \DateTime());
        $menu2->setUpdated($menu2->getCreated());
        $manager->persist($menu2);

        $menu3 = new Menu();
        $menu3->setName('Renew');
        $menu3->setUrl('index.php?action=playerrenew');
        $menu3->setSeq(2);
        $menu3->setSecured(1);
        $menu3->setParent($parent1);
        $menu3->setCreated(new \DateTime());
        $menu3->setUpdated($menu3->getCreated());
        $manager->persist($menu3);

        $menu4 = new Menu();
        $menu4->setName('Online Registrations');
        $menu4->setUrl('index.php?action=playeronline');
        $menu4->setSeq(3);
        $menu4->setSecured(1);
        $menu4->setParent($parent1);
        $menu4->setCreated(new \DateTime());
        $menu4->setUpdated($menu4->getCreated());
        $manager->persist($menu4);

        $menu5 = new Menu();
        $menu5->setName('Add,index');
        $menu5->setUrl('index.php?action=playeradd');
        $menu5->setSeq(4);
        $menu5->setSecured(1);
        $menu5->setParent($parent1);
        $menu5->setCreated(new \DateTime());
        $menu5->setUpdated($menu5->getCreated());
        $manager->persist($menu5);

        $menu6 = new Menu();
        $menu6->setName('Merge');
        $menu6->setUrl(',index.php?action=playermerge');
        $menu6->setSeq(5);
        $menu6->setSecured(1);
        $menu6->setParent($parent1);
        $menu6->setCreated(new \DateTime());
        $menu6->setUpdated($menu6->getCreated());
        $manager->persist($menu6);

        $menu7 = new Menu();
        $menu7->setName('Search');
        $menu7->setUrl('index.php?action=playerfind');
        $menu7->setSeq(3);
        $menu7->setSecured(1);
        $menu7->setParent($parent1);
        $menu7->setCreated(new \DateTime());
        $menu7->setUpdated($menu7->getCreated());
        $manager->persist($menu6);

        $menu8 = new Menu();
        $menu8->setName('Search');
        $menu8->setUrl('index.php?action=playerfind');
        $menu8->setSeq(3);
        $menu8->setSecured(1);
        $menu8->setParent($parent1);
        $menu8->setCreated(new \DateTime());
        $menu8->setUpdated($menu8->getCreated());
        $manager->persist($menu6);

//rec_id,parent_id,menu_order,menu_name,url,secured
//1045,1000,5,Merge,index.php?action=playermerge,1
//1050,1000,5,Search,index.php?action=playerfind,1
//1060,1000,6,Download,,1
//1061,1060,1,Player details,index.php?action=playerdownload,1
//1062,1060,2,Reg forms,index.php?action=playerregdownload,1
//1063,1060,3,Blank forms,index.php?action=playerregblank,1
//1064,1060,4,"ARU ",index.php?action=aruplayerdownload,1
//1065,1060,5,Waratah coupons,index.php?action=coupondownload,1
//1070,1000,7,Import,index.php?action=playerimport,1
//1080,1000,8,load photos,index.php?action=playerphotoimport,1
//2000,0,2,Members,,1
//2010,2000,1,Current List,index.php?action=memberlist,1
//2020,2000,2,Renew,index.php?action=memberrenew,1
//2040,2000,4,Add,index.php?action=memberadd,1
//2045,2000,5,Merge,index.php?action=membermerge,1
//2050,2000,5,Search,index.php?action=memberfind,1
//2060,2000,6,Download,,1
//2061,2060,1,Members,index.php?action=memberdownload,1
//2062,2060,2,Reg Forms,index.php?action=memberregdownload,1
//2063,2060,3,Blank forms,index.php?action=memberregblank,1
//2064,2060,4,ARU,index.php?action=arumemberdownload,1
//2070,2000,7,Import,index.php?action=memberimport,1
//3000,0,3,Manage,,1
//3010,3000,1,Match Report,index.php?action=matchreport,1
//3020,3000,2,Team lists,index.php?action=teamplayerlist,1
//3030,3000,3,Email,index.php?action=email,1
//3040,3000,4,Signon update,index.php?action=signonupdate,1
//3050,3000,5,Edit Results,index.php?action=results,1
//3060,3000,6,Photo sheet,index.php?action=photolist,1
//3070,3000,7,Download Refs draw,index.php?action=refdrawdownload,1
//3080,3000,8,Edit finals draw,index.php?action=finals_draw,1
//3090,3000,9,Edit Finals Results,index.php?action=finals_results,1
//4000,0,4,View,,0
//4010,4000,1,Signon sheets,index.php?action=teamsheet,0
//4020,4000,2,Draw & Results,index.php?action=view_results,0
//4030,4000,3,Tables,index.php?action=tables,0
//4040,4000,4,Download,,0
//4041,4040,1,Results,index.php?action=download_results,0
//4042,4040,2,Tables,index.php?action=download_tables,0
//5000,0,5,Reports,,1
//5010,5000,1,Season awards,index.php?action=rpt_top,1
//5020,5000,2,Player count by Club,index.php?action=rpt_playerclub,1
//5030,5000,3,ID card reports,,1
//5031,5030,1,Incomplete ID cards,index.php?action=player_idlist,1
//5032,5030,2,ID Cards to be printed,index.php?action=player_idready,1
//5033,5030,3,ID cards printed,index.php?action=player_idprinted,1
//5050,5000,5,Analysis,,1
//5040,5000,4,Schools report,index.php?action=rpt_schools,1
//5051,5050,1,Age analysis,index.php?action=rpt_age,1
//5052,5050,2,Registrations,index.php?action=rpt_rego,1
//5053,5050,3,Reg. Analysis,index.php?action=rpt_anal,1
//5070,5000,7,Coaches,index.php?action=rpt_coach,1
//5080,5000,8,Refs & TJs,index.php?action=rpt_referee,1
//5090,5000,9,Volunteers,index.php?action=rpt_volunteers,1
//5091,5000,10,Games Played,index.php?action=rpt_gamesplayed,1
//8000,0,8,Admin,,1
//8005,8000,1,Competitions,index.php?action=comps,1
//8010,8000,2,Clubs,,1
//8020,8000,3,Setup,,1
//8023,8020,3,Edit Zones,index.php?action=zones,1
//8022,8020,2,Edit Rounds,index.php?action=rounds,1
//8024,8020,4,Edit Finals,index.php?action=finals,1
//8025,8020,6,Load draw,index.php?action=draw_load,1
//8026,8020,7,Edit draw,index.php?action=draw,1
//8027,8020,8,Amend results,index.php?action=amend_results,1
//8029,8020,10,Clear tables,index.php?action=zap,1
//8011,8010,1,Club list,index.php?action=clublist,1
//8012,8010,2,Club edit,index.php?action=clubedit,1
//8013,8010,3,Club Add,index.php?action=clubadd,1
//8021,8020,1,Age Groups,index.php?action=ages,1
//8030,8000,4,Grades,,1
//8031,8030,1,Grade list,index.php?action=gradelist,1
//8032,8030,2,Grade edit,index.php?action=gradeedit,1
//8033,8030,3,Grade add,index.php?action=gradeadd,1
//8040,8000,5,Schools,,1
//8041,8040,1,School list,index.php?action=schoollist,1
//8042,8040,2,School edit,index.php?action=schooledit,1
//8043,8040,3,School add,index.php?action=schooladd,1
//8050,8000,6,Teams,,1
//8051,8050,1,Team list,index.php?action=teamlist,1
//8052,8050,2,Team add,index.php?action=teamadd,1
//8060,8000,7,ID card maintenance,index.php?action=player_idmaint,1
//8080,8000,8,Credit Card reports,index.php?action=ccrpt,1
//8090,8000,9,My Account,index.php?action=myaccount,1
//9000,0,9,System,,1
//9010,9000,1,User List,index.php?action=userlist,1
//9020,9000,2,Add Users,index.php?action=register,1
//9030,9000,3,Edit User,index.php?action=useredit,1
//9040,9000,4,Preferences,index.php?action=iniedit&op=edit,1
//9050,9000,5,Options,index.php?action=option_edit,1
//9060,9000,6,Hits by day,index.php?action=hitcount,1
//9070,9000,7,Banners,index.php?action=banners,1
//9080,9000,8,PHP info,index.php?action=phpinfo,1
//9090,9000,9,Database,index.php?action=dbinfo,1
        $menu2 = new Menu();
        $menu2->setName('Administrator');
        $menu2->setRole('ROLE_ADMIN');
        $menu2->setCreated(new \DateTime());
        $menu2->setUpdated($menu2->getCreated());
        $manager->persist($menu2);

        $menu3 = new Menu();
        $menu3->setName('President');
        $menu3->setRole('ROLE_PRESIDENT');
        $menu3->setCreated(new \DateTime());
        $menu3->setUpdated($menu3->getCreated());
        $manager->persist($menu3);

        $menu4 = new Menu();
        $menu4->setName('Registrar');
        $menu4->setRole('ROLE_REGISTRAR');
        $menu4->setCreated(new \DateTime());
        $menu4->setUpdated($menu4->getCreated());
        $manager->persist($menu4);

        $menu5 = new Menu();
        $menu5->setName('Secretary');
        $menu5->setRole('ROLE_SECRETARY');
        $menu5->setCreated(new \DateTime());
        $menu5->setUpdated($menu5->getCreated());
        $manager->persist($menu5);

        $menu6 = new Menu();
        $menu6->setName('Treasurer');
        $menu6->setRole('ROLE_TREASURER');
        $menu6->setCreated(new \DateTime());
        $menu6->setUpdated($menu6->getCreated());
        $manager->persist($menu6);

        $menu7 = new Menu();
        $menu7->setName('Coach');
        $menu7->setRole('ROLE_COACH');
        $menu7->setCreated(new \DateTime());
        $menu7->setUpdated($menu7->getCreated());
        $manager->persist($menu7);

        $menu8 = new Menu();
        $menu8->setName('Manager');
        $menu8->setRole('ROLE_MANAGER');
        $menu8->setCreated(new \DateTime());
        $menu8->setUpdated($menu8->getCreated());
        $manager->persist($menu8);

        $menu9 = new Menu();
        $menu9->setName('Referee');
        $menu9->setRole('ROLE_REFEREE');
        $menu9->setCreated(new \DateTime());
        $menu9->setUpdated($menu9->getCreated());
        $manager->persist($menu9);

        $menu10 = new Menu();
        $menu10->setName('District');
        $menu10->setRole('ROLE_DISTRICT');
        $menu10->setCreated(new \DateTime());
        $menu10->setUpdated($menu10->getCreated());
        $manager->persist($menu10);

        $menu11 = new Menu();
        $menu11->setName('Competition Manager');
        $menu11->setRole('ROLE_COMPMGR');
        $menu11->setCreated(new \DateTime());
        $menu11->setUpdated($menu11->getCreated());
        $manager->persist($menu11);

        $manager->flush();
    }

    public function getOrder() {
        return 1;
    }

}