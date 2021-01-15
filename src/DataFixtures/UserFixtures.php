<?php


namespace App\DataFixtures;


use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker;

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
        $claire->setScore(3230);
        $claire->setPassword($this->passwordEncoder->encodePassword(
            $claire,
            'claire'
        ));

        $manager->persist($claire);
        $this->addReference('user_46', $claire);

        $aude = new User();
        $aude->setUsername('aude');
        $aude->setRoles(['ROLE_USER']);
        $aude->setScore(320);
        $aude->setPassword($this->passwordEncoder->encodePassword(
            $aude,
            'aude'
        ));

        $manager->persist($aude);
        $this->addReference('user_47', $aude);

        $benji = new User();
        $benji->setUsername('benjamin');
        $benji->setRoles(['ROLE_USER']);
        $benji->setScore(180);
        $benji->setPassword($this->passwordEncoder->encodePassword(
            $benji,
            'benjamin'
        ));

        $manager->persist($benji);
        $this->addReference('user_48', $benji);


        $victor = new User();
        $victor->setUsername('victor');
        $victor->setRoles(['ROLE_USER']);
        $victor->setScore(7010);
        $victor->setPassword($this->passwordEncoder->encodePassword(
            $victor,
            'victor'
        ));

        $manager->persist($victor);
        $this->addReference('user_49', $victor);

        $maite = new User();
        $maite->setUsername('MaïtéQueCBon');
        $maite->setRoles(['ROLE_USER']);
        $maite->setScore(220);
        $maite->setPassword($this->passwordEncoder->encodePassword(
            $maite,
            'maite'
        ));

        $manager->persist($maite);
        $this->addReference('user_50', $maite);

        $serge = new User();
        $serge->setUsername('SergeDu38');
        $serge->setRoles(['ROLE_USER']);
        $serge->setScore(260);
        $serge->setPassword($this->passwordEncoder->encodePassword(
            $serge,
            'serge'
        ));

        $manager->persist($serge);
        $this->addReference('user_51', $serge);


        $jm = new User();
        $jm->setUsername('JeanMichMich');
        $jm->setRoles(['ROLE_USER']);
        $jm->setScore(2260);
        $jm->setPassword($this->passwordEncoder->encodePassword(
            $jm,
            'jm'
        ));

        $manager->persist($jm);
        $this->addReference('user_52', $jm);

        $dsk = new User();
        $dsk->setUsername('DSK');
        $dsk->setRoles(['ROLE_USER']);
        $dsk->setScore(12060);
        $dsk->setPassword($this->passwordEncoder->encodePassword(
            $dsk,
            'dsk'
        ));

        $manager->persist($dsk);
        $this->addReference('user_53', $dsk);

        $martine = new User();
        $martine->setUsername('MartineALaWild');
        $martine->setRoles(['ROLE_USER']);
        $martine->setScore(460);
        $martine->setPassword($this->passwordEncoder->encodePassword(
            $martine,
            'dsk'
        ));

        $manager->persist($martine);
        $this->addReference('user_54', $martine);

        $pascal = new User();
        $pascal->setUsername('Pascal_Obispo');
        $pascal->setRoles(['ROLE_USER']);
        $pascal->setScore(1820);
        $pascal->setPassword($this->passwordEncoder->encodePassword(
            $pascal,
            'pascal'
        ));

        $manager->persist($martine);
        $this->addReference('user_55', $martine);

        $pascal = new User();
        $pascal->setUsername('Pascal_Obispo');
        $pascal->setRoles(['ROLE_USER']);
        $pascal->setScore(8420);
        $pascal->setPassword($this->passwordEncoder->encodePassword(
            $pascal,
            'pascal'
        ));

        $manager->persist($pascal);
        $this->addReference('user_56', $pascal);

        $francis = new User();
        $francis->setUsername('Francis-Cabrel');
        $francis->setRoles(['ROLE_USER']);
        $francis->setScore(3320);
        $francis->setPassword($this->passwordEncoder->encodePassword(
            $francis,
            'francis'
        ));

        $manager->persist($francis);
        $this->addReference('user_57', $francis);




        $manager->flush();
    }
}


