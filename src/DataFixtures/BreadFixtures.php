<?php

namespace App\DataFixtures;

use App\Entity\Bread;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BreadFixtures extends Fixture
{

    private const BREAD_REFERENCE = 'Bread';

    public function load(ObjectManager $manager): void
    {
        $breadNames = [
            'Pain classic',
            'Pain au sésame',
            'Pain au brioche'
        ];
 
        foreach ($breadNames as $key => $breadName) {
            $bread = new Bread();
            $bread->setType($breadName);
            $manager->persist($bread);
            $this->addReference(self::BREAD_REFERENCE . '_' . $key, $bread);
        }

        $manager->flush();
    }
}
