<?php

namespace App\DataFixtures;

use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ImageFixtures extends Fixture
{

    private const IMAGE_REFERENCE = 'Image';

    public function load(ObjectManager $manager): void
    {
        $imageSources = [
            '/img/api.png',
            '/img/trello.png'
        ];
 
        foreach ($imageSources as $key => $imageSource) {
            $image = new Image();
            $image->setSource($imageSource);
            $manager->persist($image);
            $this->addReference(self::IMAGE_REFERENCE . '_' . $key, $image);
        }

        $manager->flush();
    }
}
