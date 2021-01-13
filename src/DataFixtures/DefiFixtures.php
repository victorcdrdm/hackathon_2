<?php


namespace App\DataFixtures;


use App\Entity\Defi;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class DefiFixtures extends Fixture
{
    CONST FORMATS = [
        'Photo',
        'Vidéo',
        'Son',
    ];

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 50; $i++) {
            $defi = new Defi();
            $defi->setTitle($faker->realText(11));
            $defi->setDescription($faker->realText(200));
            $defi->setFormat(self::FORMATS[rand(0,2)]);
            $defi->setPoint(10*rand(1,10));
            $manager->persist($defi);
            $this->addReference('defi_' . $i, $defi);
        }
        $manager->flush();
    }
}


