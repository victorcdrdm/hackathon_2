<?php


namespace App\Fixtures;


use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    public function load(ObjectManager $manager)
    {
        $claire = new User();
        $claire->setUsername('claire');
        $claire->setRoles(['ROLE_USER']);
        $claire->setScore(0);
        $claire->setPassword($this->passwordEncoder->encodePassword(
            $claire,
            'claire'
        ));

        $manager->persist($claire);

        $aude = new User();
        $aude->setUsername('aude');
        $aude->setRoles(['ROLE_USER']);
        $aude->setScore(0);
        $aude->setPassword($this->passwordEncoder->encodePassword(
            $aude,
            'aude'
        ));

        $manager->persist($aude);

        $benji = new User();
        $benji->setUsername('benjamin');
        $benji->setRoles(['ROLE_USER']);
        $benji->setScore(0);
        $benji->setPassword($this->passwordEncoder->encodePassword(
            $benji,
            'benjamin'
        ));

        $manager->persist($benji);

        $victor = new User();
        $victor->setUsername('victor');
        $victor->setRoles(['ROLE_USER']);
        $victor->setScore(0);
        $victor->setPassword($this->passwordEncoder->encodePassword(
            $victor,
            'victor'
        ));

        $manager->persist($victor);



        // Sauvegarde des 2 nouveaux utilisateurs :
        $manager->flush();
    }

}
