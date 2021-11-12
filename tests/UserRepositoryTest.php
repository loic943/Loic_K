<?php

namespace App\Tests;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserRepositoryTest extends KernelTestCase
{
    public function testCompteUsers(): void
    {
        self::bootKernel();

        $compteUsers = static::getContainer()->get(UserRepository::class)->count([]);

        $this->assertEquals(2, $compteUsers);
    }

    public function testChangePassword(): void
    {
        self::bootKernel();

        $em = static::getContainer()->get('doctrine')->getManager();

        $admin = $em->getRepository(User::class)->findOneBy(['email' => 'admin@test.com']);
        $admin->setPassword('987654');
        $em->persist($admin);
        $em->flush();

        $newAdmin = $em->getRepository(User::class)->findOneBy(['email' => 'admin@test.com']);
        $newPass = $newAdmin->getPassword();

        $this->assertTrue($newPass === '987654');
    }
}
