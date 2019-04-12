<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        for($i=0;$i<10;$i++){
            $user = new User();
            $user->setUsername('user'.$i)
                ->setEmail('user'.$i.'@ccsd.cnrs.fr');
            $manager->persist($user);
        }
        $manager->flush();
    }
}
