<?php

namespace App\DataFixtures;

use App\Entity\Movies;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Exception;

class MoviesFixtures extends Fixture
{
    /**
     * @throws Exception
     */
    public function load(ObjectManager $manager): void
    {
        // create 20 movies
        for ($i = 0; $i < 20; $i++) {
            $movie = new Movies();
            $movie->setName('Star Wars ' . $i);
            $movie->setReleaseDate(new \DateTime('200'.$i.'-01-01'));
            $movie->setDuration(mt_rand(1, 3));
            $movie->setSynopsis('Film de SF');
            $movie->setPicture('pictureStarWars.png '.$i);
            $manager->persist($movie);
        }
        $manager->flush();
    }
}
