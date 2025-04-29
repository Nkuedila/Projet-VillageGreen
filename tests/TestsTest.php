<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TestsTest extends WebTestCase
{
    public function test1(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('.display-4', 'Bienvenue dans notre site village green');
    }

    public function test2(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        $this->assertResponseIsSuccessful();


        $lien = $crawler->filter(".card a")->first()->link();

        $crawler = $client->click($lien);
        $this->assertResponseIsSuccessful();

        $tab = $crawler->filter(".card.shadow-lg.border-0");

        $this->assertEquals($tab->count(), 4);
    }

    public function test3(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        $this->assertResponseIsSuccessful();


        $lien = $crawler->filter(".card a")->first()->link();

        $crawler = $client->click($lien);
        $this->assertResponseIsSuccessful();

        $tab = $crawler->filter(".card.shadow-lg.border-0");

        $this->assertEquals($tab->count(), 4);
    }
}
