<?php

namespace App\DataFixtures;

use App\Entity\Ville;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VilleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $v1 = new Ville();
        $v1->setNom('Belfort');
        $this->addReference('90000', $v1);
        $manager->persist($v1);

        $v2 = new Ville();
        $v2->setNom('caillou');
        $this->addReference('24000', $v2);
        $manager->persist($v2);

        $v3 = new Ville();
        $v3->setNom('paris');
        $this->addReference('12000', $v3);
        $manager->persist($v3);

        $v4 = new Ville();
        $v4->setNom('perpignan');
        $this->addReference('08080', $v4);
        $manager->persist($v4);


        $manager->flush();
    }
}
