<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class UserFixtures extends Fixture
{
    public const REFERENCE_IDENTIFIER = 'user_';
    public const FIXTURE_RANGE = 5;

    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        foreach (range(1, self::FIXTURE_RANGE) as $i) {
            $mainRole = 1 === $i ? 'admin' : 'user';
            $user = new User();
            $user
                ->setEmail('user'.$i.'@test.fr')
                ->setPassword($this->passwordHasher->hashPassword($user, 'admin' === $mainRole ? 'Admin123!' : 'User123!'))
                ->setRoles(['ROLE_USER'])
            ;

            if ('admin' === $mainRole) {
                $user->addRole('ROLE_ADMIN');
            }

            $manager->persist($user);
            $this->setReference(self::REFERENCE_IDENTIFIER.$i, $user);
        }

        $manager->flush();
    }
}
