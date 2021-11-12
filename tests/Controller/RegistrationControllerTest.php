<?php

namespace App\Tests\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationControllerTest extends WebTestCase
{
    public function testRegisterPage(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/register');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Register');
    }

    public function testEmailIsVerified(): void
    {
        $client = static::createClient();
        $em = static::getContainer()->get('doctrine')->getManager();
        $testUser = $em->getRepository(User::class) ->findOneByEmail('user@test.com');

        $testUser->setIsVerified(true);
        $em->persist($testUser);
        $em->flush();

        $crawler = $client->request('GET', '/verify/email');

        // $this->assertResponseIsSuccessful();
        $this->assertResponseRedirects('/login');
        // $this->assertSelectorTextContains('h1', 'Register');
    }

    public function testEmailIsNotVerified(): void
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('user@test.com');

        $testUser->setIsVerified(false);

        $crawler = $client->request('GET', '/verify/email');

        // $this->assertResponseIsSuccessful();
        $this->assertResponseRedirects('/login');
        // $this->assertSelectorTextContains('h1', 'Register');
    }
}
