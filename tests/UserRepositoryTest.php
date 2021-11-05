<?php

namespace App\Tests;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserRepositoryTest extends KernelTestCase
{
    private $em;

    public function testCompteUsers(): void
    {
        self::bootKernel();

        $compteUsers = static::getContainer()->get(UserRepository::class)->count([]);

        $this->assertEquals(2, $compteUsers);
    }

    public function testChangePassword(): void
    {
        self::bootKernel();

        $this->em = static::getContainer()->get('doctrine')->getManager();

        $admin = $this->em->getRepository(User::class)->findOneBy(['email' => 'admin@test.com']);
        $admin->setPassword('987654');
        $this->em->persist($admin);
        $this->em->flush();

        $newAdmin = $this->em->getRepository(User::class)->findOneBy(['email' => 'admin@test.com']);
        $newPass = $newAdmin->getPassword();

        $this->assertTrue($newPass === '987654');
    }
}
