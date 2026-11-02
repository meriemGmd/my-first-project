<?php

namespace App\DataFixtures;

use App\Entity\StatutAnime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StatutAnimeFixtures extends Fixture
{
    public static function getStatuts(): array
    {
        return ['En cours de diffusion', 'Terminé'];
    }

    public function load(ObjectManager $manager): void
    {
        foreach (self::getStatuts() as $nom) {
            $statut = new StatutAnime();
            $statut->setName($nom);
            $manager->persist($statut);
            $this->addReference('statut_anime_' . $nom, $statut);
        }
        $manager->flush();
    }
}
