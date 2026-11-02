<?php

namespace App\DataFixtures;

use App\Entity\Anime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Genre;
use App\Entity\StatutAnime;

class AnimeFixtures extends Fixture implements DependentFixtureInterface
{
    public static function getAnimes(): array
    {
        return [
            ['Naruto', '2002', 'Un jeune ninja rêve de devenir le chef de son village.', 'Terminé', ['Action', 'Aventure']],
            ['One Piece', '1999', 'Un pirate élastique part à la recherche du trésor ultime.', 'En cours de diffusion', ['Action', 'Aventure', 'Comédie']],
            ['Fullmetal Alchemist: Brotherhood', '2009', 'Deux frères alchimistes cherchent à retrouver leurs corps.', 'Terminé', ['Action', 'Aventure', 'Fantastique']],
            ['Death Note', '2006', 'Un lycéen trouve un carnet qui tue ceux dont on écrit le nom.', 'Terminé', ['Drame', 'Fantastique']],
            ['Your Name', '2016', 'Deux adolescents échangent leurs corps sans se connaître.', 'Terminé', ['Romance', 'Drame']],
        ];
    }

    public function load(ObjectManager $manager): void
    {
        foreach (self::getAnimes() as $i => [$nom, $annee, $synopsis, $statut, $genres]) {
            $anime = new Anime();
            $anime->setName($nom)
                ->setYear($annee)
                ->setSynopsis($synopsis)
                ->setImageUrl('https://placehold.co/300x420?text=' . urlencode($nom))
                ->setStatutAnime($this->getReference('statut_anime_' . $statut, StatutAnime::class));

            foreach ($genres as $genre) {
                $anime->addGenre($this->getReference('genre_' . $genre, Genre::class));
            }

            $manager->persist($anime);
            $this->addReference('anime_' . $i, $anime);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [StatutAnimeFixtures::class, GenreFixtures::class];
    }
}
