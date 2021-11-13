<?php

namespace App\Tests;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testIsTrue(): void
    {
        $user = new User();

        $user->setEmail("true@email.com")
            ->setPassword("password")
            ->setRoles(['ROLE_ADMIN'])
            ->setIsVerified(true);

        $this->assertTrue($user->getEmail() === "true@email.com");
        $this->assertTrue($user->getUserIdentifier() === "true@email.com");
        $this->assertTrue($user->getPassword() === "password");
        $this->assertTrue($user->getRoles() === ['ROLE_ADMIN', 'ROLE_USER']);
        $this->assertTrue($user->isVerified() === true);
        $this->assertTrue($user->getSalt() === null);
    }

    public function testIsFalse(): void
    {
        $user = new User();

        $user->setEmail("true@email.com")
            ->setPassword("password")
            ->setRoles(['ROLE_ADMIN'])
            ->setIsVerified(true);

        $this->assertFalse($user->getEmail() === "false@email.com");
        $this->assertFalse($user->getUserIdentifier() === "false@email.com");
        $this->assertFalse($user->getPassword() === "false");
        $this->assertFalse($user->getRoles() === ['ROLE_FALSE']);
        $this->assertFalse($user->isVerified() === false);
        $this->assertFalse($user->getSalt() === "false");
    }

    public function testIsEmpty(): void
    {
        $user = new User();

        $this->assertEmpty($user->getId());
        $this->assertEmpty($user->getPassword());
        $this->assertNotEmpty($user->getRoles());
        $this->assertEmpty($user->isVerified());
        $this->assertEmpty($user->getSalt());
    }
}
