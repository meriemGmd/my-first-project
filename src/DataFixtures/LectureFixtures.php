<?php

namespace App\DataFixtures;

use App\Entity\Lecture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Anime;
use App\Entity\StatutLecture;
use App\Entity\User;

class LectureFixtures extends Fixture implements DependentFixtureInterface
{
    protected $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        $animeIds = range(0, count(AnimeFixtures::getAnimes()) - 1);

        for ($i = 0; $i <= UserFixtures::NB_USERS; $i++) {
            $choix = $this->faker->randomElements($animeIds, $this->faker->numberBetween(2, 4));

            foreach ($choix as $j) {
                $statut = $this->faker->randomElement(StatutLectureFixtures::getStatuts());

                $lecture = new Lecture();
                $lecture->setUserId($this->getReference('user_' . $i, User::class))
                    ->setAnimeId($this->getReference('anime_' . $j, Anime::class))
                    ->setStatutId($this->getReference('statut_lecture_' . $statut, StatutLecture::class));
                $manager->persist($lecture);
            }
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [UserFixtures::class, AnimeFixtures::class, StatutLectureFixtures::class];
    }
}
