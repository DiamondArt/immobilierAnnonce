<?php

namespace App\DataFixtures;

use App\Entity\Ad;
use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i=0; $i<20; $i++)
       {
        $ads= new Ad();
        $ads->setTitle('titre de l\'annonce num '.$i);
        $ads->setSlug('htpps://placehold.it/1000x300');
        $ads->setPrice(mt_rand(50,200));
        $ads->setIntroduction('belle maison à louer');
        $ads->setContent('<p>lorem ipsum lorem ipsum lorem ipsum</p>');
        $ads->setCoverImage('maison.jpg');
        $ads->setRooms(mt_rand(1,5));
 
        for($j=1; $j<= mt_rand(2,5); $j++)
        {
            $image= new Image();
            $image->setUrl('htpps://placehold.it/1000x300');
            $image->setCaption('titre de l\'image '.$j);
            $image->setAd($ads);
            
            $manager->persist($image);
        }
        $manager->persist($ads);
       }
        $manager->flush();
    }
}
