<?php


namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;


    class ActorFixtures extends Fixture implements DependentFixtureInterface
    {
        const ACTOR = [
            'Andrew Lincoln',
            'Norman Reedus',
            'Lauren Cohan',
            'Danai-Gurira',
        ];

        public function load(ObjectManager $manager)
        {
            $i = 0;
            foreach(self::ACTOR as $key => $actorName) {
                $actor = new Actor();
                $actor->setName($actorName);
                $actor->addProgram($this->getReference('program_4'));
                $manager->persist($actor);
                $this->addReference('actor_' . $key, $actor);
            }
            $manager->flush();
        }

        public function getDependencies()
        {
            return [ProgramFixtures::class];
        }
    }