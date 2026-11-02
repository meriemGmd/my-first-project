<?php

namespace App\DataFixtures;

use App\Entity\StatutLecture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StatutLectureFixtures extends Fixture
{
    public static function getStatuts(): array
    {
        return ['A regardé','En cours','Terminé'];
    }

    public function load(ObjectManager $manager): void
    {
        foreach (self::getStatuts() as $nom) {
            $statut = new StatutLecture();
            $statut->setName($nom);
            $manager->persist($statut);
            $this->addReference('statut_lecture_' . $nom, $statut);
        }
        $manager->flush();
    }
}
