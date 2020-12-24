<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('en_US');
        for($i=0; $i < 50; $i++) {
           $episode = new Episode();
           $episode->setTitle($faker->domainWord);
           $episode->setNumber($faker->numberBetween(1, 30));
           $episode->setSynopsis($faker->text);
           $episode->setSeason($this->getReference('season_0'));
           $manager->persist($episode);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [SeasonFixtures::class];
    }
}
