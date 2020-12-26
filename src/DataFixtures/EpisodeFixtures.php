<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Service\Slugify;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    private $slugify;

    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('en_US');
        for($i=0; $i < 50; $i++) {
           $episode = new Episode();
           $episode->setTitle($faker->domainWord);
           $episode->setNumber($faker->numberBetween(1, 30));
           $episode->setSynopsis($faker->text);
           $episode->setSeason($this->getReference('season_0'));
           $slug = $this->slugify->generate($episode->getTitle());
           $episode->setSlug($slug);
           $manager->persist($episode);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [SeasonFixtures::class];
    }
}
