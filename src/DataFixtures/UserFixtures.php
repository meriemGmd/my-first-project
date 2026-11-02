<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    protected $faker;
    public const NB_USERS = 8;

    public function __construct(private UserPasswordHasherInterface $hasher)
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setEmail('admin@gmail.com')->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->hasher->hashPassword($admin, 'admin123'));
        $manager->persist($admin);
        $this->addReference('admin', $admin);


        for ($i = 0; $i <= self::NB_USERS; $i++) {
            $user = new User();
            $user->setEmail($i === 0 ? 'user@gmail.com' : $this->faker->unique()->safeEmail())
                ->setRoles([]);
            $user->setPassword($this->hasher->hashPassword($user, $i === 0 ? 'user123' : 'password'));
            $manager->persist($user);
            $this->addReference('user_' . $i, $user);
        }

        $manager->flush();
    }
}
