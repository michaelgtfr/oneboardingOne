<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 20/12/2021
 * Time: 13:32
 */

namespace App\Tests\Controller;


use App\DataFixtures\AppFixtures;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContactControllerTest extends WebTestCase
{
    /** @var AbstractDatabaseTool */
    protected $databaseTool;

    private $client = null;


    public function setUp(): void
    {
        $this->client = static::createClient();
        $this->databaseTool = $this->client->getContainer()->get(DatabaseToolCollection::class)->get();
    }

    /**
     * Fixture data recover with LiipTestFixtureBundle
     */
    protected function dataFixture()
    {
        $this->databaseTool->loadFixtures([
            AppFixtures::class
        ]);
    }

    public function testDisplayAndContactFormFunctionWithSendEmail()
    {
        $this->dataFixture();
        $crawler = $this->client->request('GET', '/');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $form = $crawler->selectButton('Valider')->form();
        $form['contact_form[name]'] = 'usernameTest';
        $form['contact_form[firstName]'] = 'usernameTest';
        $form['contact_form[email]'] = 'emailTest@gmail.com';
        $form['contact_form[message]'] = 'contentTest';
        $this->client->submit($form);

        $crawler = $this->client->reload();

        $this->assertSame(1, $crawler->filter('.alert-success')->count());
    }
}