<?php

namespace App\DataFixtures;

use App\Entity\Genre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GenreFixtures extends Fixture
{
    public static function getStatuts(): array
    {
        return ['Action', 'Aventure', 'Comédie', 'Drame', 'Fantastique', 'Romance'];
    }

    public function load(ObjectManager $manager): void
    {
        foreach (self::getStatuts() as $nom) {
            $statut = new Genre();
            $statut->setName($nom);
            $manager->persist($statut);
            $this->addReference('genre_' . $nom, $statut);
        }
        $manager->flush();
    }
}
