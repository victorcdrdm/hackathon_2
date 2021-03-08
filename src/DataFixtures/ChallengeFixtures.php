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
        $challenge = new Challenge();
        $challenge->setCatcher($this->getReference('user_' . 50));
        $challenge->setCreator($this->getReference('user_' . 46));
        $challenge->setDefi($this->getReference('defi_' . 1));
        $challenge->setIsSuccess(0);
        $manager->persist($challenge);

        $challenge = new Challenge();
        $challenge->setCatcher($this->getReference('user_' . 48));
        $challenge->setCreator($this->getReference('user_' . 46));
        $challenge->setDefi($this->getReference('defi_' . 7));
        $challenge->setIsSuccess(0);
        $manager->persist($challenge);

        $challenge = new Challenge();
        $challenge->setCatcher($this->getReference('user_' . 55));
        $challenge->setCreator($this->getReference('user_' . 46));
        $challenge->setDefi($this->getReference('defi_' . 2));
            $challenge->setUrl('https://2.bp.blogspot.com/_9Z9Hsy423eg/TR0bTVkvT4I/AAAAAAAAAR0/POstZXmBl-E/s1600/IMG_0384.JPG');
        $challenge->setIsSuccess(1);
        $manager->persist($challenge);

        $challenge = new Challenge();
        $challenge->setCatcher($this->getReference('user_' . 57));
        $challenge->setCreator($this->getReference('user_' . 46));
        $challenge->setDefi($this->getReference('defi_' . 3));
        $challenge->setUrl('https://static.hitek.fr/img/up_m/1686087778/hitekz42autraliensdeguisementssortiespoubellesconfinement75.jpg');
        $challenge->setIsSuccess(1);
        $manager->persist($challenge);

        $challenge = new Challenge();
        $challenge->setCatcher($this->getReference('user_' . 51));
        $challenge->setCreator($this->getReference('user_' . 46));
        $challenge->setDefi($this->getReference('defi_' . 6));
        $challenge->setUrl('https://upload.wikimedia.org/wikipedia/commons/thumb/d/d7/I_woke_up_looking_this_good.jpg/286px-I_woke_up_looking_this_good.jpg');
        $challenge->setIsSuccess(1);
        $manager->persist($challenge);

        $challenge = new Challenge();
        $challenge->setCatcher($this->getReference('user_' . 46));
        $challenge->setCreator($this->getReference('user_' . 52));
        $challenge->setDefi($this->getReference('defi_' . 4));
        $challenge->setIsSuccess(0);
        $manager->persist($challenge);

        $challenge = new Challenge();
        $challenge->setCatcher($this->getReference('user_' . 46));
        $challenge->setCreator($this->getReference('user_' . 49));
        $challenge->setDefi($this->getReference('defi_' . 10));
        $challenge->setUrl('https://nsa40.casimages.com/img/2021/01/14//210114072101102679.jpg' );
        $challenge->setIsSuccess(1);
        $manager->persist($challenge);



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


