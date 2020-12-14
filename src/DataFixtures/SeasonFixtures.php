<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 1; $i <= 10; $i++) {
            $season = new Season();
            $season->setDescription($faker->text(100));
            $season->setNumber($faker->numberBetween(1, 10));
            $season->setYear($faker->year);
            $season->setProgram($this->getReference('program_0'));
            $manager->persist($season);
            $this->addReference('season_' . $i, $season);
        }


        $manager->flush();
    }

    public function getDependencies()
    {
        return [ProgramFixtures::class];
    }
}
