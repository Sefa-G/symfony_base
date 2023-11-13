<?php

namespace App\DataFixtures;

use App\Entity\Burger;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\DataFixtures\BreadFixtures;
use App\DataFixtures\ImageFixtures;

class BurgerFixtures extends Fixture implements DependentFixtureInterface
{

    public const BURGER_REFERENCE = 'Burger';

    public function load(ObjectManager $manager): void
    {

        for ($i = 0; $i < 3; $i++) {
            $burger = new Burger();
            $burger->setName('burger '.$i);
            $burger->setBread($this->getReference(BreadFixtures::BREAD_REFERENCE . '_' . $i));
            $burger->setImage($this->getReference(ImageFixtures::IMAGE_REFERENCE . '_' . $i));
            $burger->setPrice(mt_rand(10, 100));
            $manager->persist($burger);
            $this->setReference(self::BURGER_REFERENCE . '_' . $i, $burger);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            BreadFixtures::class,
            ImageFixtures::class,
        ];
    }
}
