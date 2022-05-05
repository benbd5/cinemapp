<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegisterTest extends WebTestCase
{
    // Test d'affichage de la page login
    public function testGetLogin()
    {
        $client = static::createClient();

        $client->request('GET', '/login');

        $this->assertResponseStatusCodeSame(200);
    }

    // Test du login avec un utilisateur existant
    public function testPostLogin()
    {
        $client = static::createClient();

        // On récupère la page login avec le crawler
        $crawler = $client->request('GET', '/login');

        // On récupère le bouton login et on passe les informations du formulaire
        $form = $crawler->selectButton('Login')->form(['_username' => 'test@test.fr', '_password' => '123456']);
        $client->submit($form);
        $client->followRedirects(true);
        $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
    }

    // Test d'affichage de la page register
    public function testGetRegister()
    {
        $client = static::createClient();

        $client->request('GET', '/register');

        $this->assertResponseStatusCodeSame(200);
    }
}