<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Movie;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $movie1 = new Movie();
        $movie1->setTitle('Title1');
        $movie1->setYear(1999);
        $movie1->setTime(189);
        $movie1->setDecription('Movie description');
        $manager->persist($movie1);

        $movie2 = new Movie();
        $movie2->setTitle('Title2');
        $movie2->setYear(1993);
        $movie2->setTime(183);
        $movie2->setDecription('Movie description');
        $manager->persist($movie2);

        $manager->flush();
    }
}
