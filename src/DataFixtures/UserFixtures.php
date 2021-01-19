<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Ville;
use App\Repository\VilleRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture 
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $ville = $manager->getRepository(Ville::class)->find(90000);

        $u1 = new User();
        $u1->setNom('Sonet')
            ->setPrenom('Thomas')
            ->setEmail('thomas.s@gmx.com')
            ->setPassword($this->passwordEncoder->encodePassword($u1, 'password'))
            ->setRoles(['ROLE_USER'])
            ->setNaissance(new \DateTime())
            ->setVille($ville);

        $this->setReference('u1', $u1);

        $manager->persist($u1);

        $manager->flush();
    }

    // public function getDependencies()
    // {
    //     return [Ville::class];
    // }
}
