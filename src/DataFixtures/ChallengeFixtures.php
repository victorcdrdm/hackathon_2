<?php


namespace App\DataFixtures;


use App\Entity\Challenge;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class ChallengeFixtures extends Fixture implements DependentFixtureInterface
{
    CONST FORMATS = [
        'Photo',
        'Vidéo',
        'Son',
    ];

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 12; $i++) {
            $rand1 = 0;
            $rand2 = 0;
            while ($rand1 === $rand2) {
                $rand1 = rand(46, 49);
                $rand2 = rand(46, 49);
            }
            $challenge = new Challenge();
            $challenge->setCatcher($this->getReference('user_' . $rand1));
            $challenge->setCreator($this->getReference('user_' . $rand2));
            $challenge->setDefi($this->getReference('defi_' . $i));
            $challenge->setIsSuccess(rand(0, 1));
            $manager->persist($challenge);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            DefiFixtures::class,
            UserFixtures::class,
        );
    }
}


