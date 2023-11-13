<?php

namespace App\DataFixtures;

use App\Entity\Review;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\DataFixtures\BurgerFixtures;

class ReviewFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

        for ($i = 0; $i < 3; $i++) {
            $review = new Review();
            $review->setText('text '.$i);
            $review->setBurger($this->getReference(BurgerFixtures::BURGER_REFERENCE . '_' . $i));
            $manager->persist($review);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            BurgerFixtures::class,
        ];
    }
}
