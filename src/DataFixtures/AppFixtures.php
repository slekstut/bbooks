<?php

namespace App\DataFixtures;

use App\Entity\Knyga;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        // Generate 20 dummy books
        for ($i = 0; $i < 20; $i++) {
            $knyga = new Knyga();
            $knyga->setTitle($faker->sentence(3)); // Random book title
            $knyga->setAuthor($faker->name);       // Random author name
            $knyga->setPublishedDate(\DateTime::createFromFormat('Y-m-d', $faker->date('Y-m-d')));
            $knyga->setDescription($faker->text(200)); // Random description
            $knyga->setIsbn($faker->isbn13); // Random ISBN

            $manager->persist($knyga);
        }

        $manager->flush(); // Save all data to the database
    }
}
