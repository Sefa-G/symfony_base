<?php

namespace App\DataFixtures;

use App\Entity\Onion;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OnionFixtures extends Fixture
{

    private const ONION_REFERENCE = 'Onion';

    public function load(ObjectManager $manager): void
    {
        $onionNames = [
            'Oignon jaune',
            'Oignon doux',
            'Oignon rouge'
        ];
 
        foreach ($onionNames as $key => $onionName) {
            $onion = new Onion();
            $onion->setType($onionName);
            $manager->persist($onion);
            $this->addReference(self::ONION_REFERENCE . '_' . $key, $onion);
        }

        $manager->flush();
    }
}
