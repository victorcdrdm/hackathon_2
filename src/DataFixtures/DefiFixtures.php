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
        $defi = new Defi();
        $defi->setTitle('Eternuer fort');
        $defi->setDescription("Eternue sur son voisin en le croisant dans l'\ascenseur");
        $defi->setFormat(self::FORMATS[0]);
        $defi->setPoint(10*rand(1,100));
        $manager->persist($defi);
        $this->addReference('defi_' . 1, $defi);

        $defi = new Defi();
        $defi->setTitle('Manger mexicain');
        $defi->setDescription("Mange 3 jours d'affilés mexicain durant la pénurie de PQ");
        $defi->setFormat(self::FORMATS[1]);
        $defi->setPoint(10*rand(1,100));
        $manager->persist($defi);
        $this->addReference('defi_' . 2, $defi);

        $defi = new Defi();
        $defi->setTitle('Sors tes poubelles');
        $defi->setDescription("Déguise-toi en poubelle pour passer au moins 1h dehors");
        $defi->setFormat(self::FORMATS[1]);
        $defi->setPoint(10*rand(1,100));
        $manager->persist($defi);
        $this->addReference('defi_' . 3, $defi);

        $defi = new Defi();
        $defi->setTitle('PQ run');
        $defi->setDescription("Couvre-toi de PQ et fais 5 fois le tour de ton jardin");
        $defi->setFormat(self::FORMATS[1]);
        $defi->setPoint(10*rand(1,100));
        $manager->persist($defi);
        $this->addReference('defi_' . 4, $defi);

        $defi = new Defi();
        $defi->setTitle('Frère Jacques');
        $defi->setDescription("Chante 'Frère Jacques' version métal à 5h du matin");
        $defi->setFormat(self::FORMATS[2]);
        $defi->setPoint(10*rand(1,100));
        $manager->persist($defi);
        $this->addReference('defi_' . 5, $defi);

        $defi = new Defi();
        $defi->setTitle('Duckface');
        $defi->setDescription("Faire un duckface en réunion à chaque fois que quelqu'un dit 'd'accord'");
        $defi->setFormat(self::FORMATS[1]);
        $defi->setPoint(10*rand(1,100));
        $manager->persist($defi);
        $this->addReference('defi_' . 6, $defi);

        $defi = new Defi();
        $defi->setTitle('Apéro animal');
        $defi->setDescription("Prends l'apéritif avec ton animal de compagnie");
        $defi->setFormat(self::FORMATS[1]);
        $defi->setPoint(10*rand(1,100));
        $manager->persist($defi);
        $this->addReference('defi_' . 7, $defi);

        $defi = new Defi();
        $defi->setTitle('Ice Bucket Challenge');
        $defi->setDescription("Montre-moi ta résistance au froid et fais un Ice Bucket Challenge dans ton appart (+10 points si tu le fais dans ton salon)");
        $defi->setFormat(self::FORMATS[1]);
        $defi->setPoint(10*rand(1,100));
        $manager->persist($defi);
        $this->addReference('defi_' . 8, $defi);

        $defi = new Defi();
        $defi->setTitle('Justin Bieber');
        $defi->setDescription("A la prochaine réunion importante sur Google Meet, tu mets une photo de Justin Bieber en arrière-plan");
        $defi->setFormat(self::FORMATS[1]);
        $defi->setPoint(10*rand(1,100));
        $manager->persist($defi);
        $this->addReference('defi_' . 9, $defi);

        $defi = new Defi();
        $defi->setTitle('Hypnotise ton chien');
        $defi->setDescription("Fais en sorte que ton chien se prenne pour un chat");
        $defi->setFormat(self::FORMATS[1]);
        $defi->setPoint(10*rand(1,100));
        $manager->persist($defi);
        $this->addReference('defi_' . 10, $defi);

        $manager->flush();
    }
}


