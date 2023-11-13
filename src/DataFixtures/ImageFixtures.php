<?php

namespace App\DataFixtures;

use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ImageFixtures extends Fixture
{

    public const IMAGE_REFERENCE = 'Image';

    public function load(ObjectManager $manager): void
    {
        $imageSources = [
            'api.png',
            'trello.png',
            'smart.jpg'
        ];
 
        foreach ($imageSources as $key => $imageSource) {
            $image = new Image();
            $image->setSource($imageSource);
            $manager->persist($image);
            $this->setReference(self::IMAGE_REFERENCE . '_' . $key , $image);
        }

        $manager->flush();
    }
}
