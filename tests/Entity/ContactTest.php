<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 20/12/2021
 * Time: 13:13
 */

namespace App\Tests\Entity;


use App\Entity\Contact;
use PHPUnit\Framework\TestCase;

class ContactTest extends TestCase
{
    /**
     * Command of test "php bin/phpunit"
     */
    public function testContactEntityWithCorrectData()
    {
        $data = [
            'name' => 'nametest',
            'firstName' => 'firstnametest',
            'message' => 'messagetest',
            'email' => 'emailtest'
        ];

        $contact = new Contact();
        $contact->setEmail($data['email']);
        $contact->setName($data['name']);
        $contact->setFirstName($data['firstName']);
        $contact->setMessage($data['message']);

        $this->assertEquals($data['email'], $contact->getEmail());
        $this->assertEquals($data['name'], $contact->getName());
        $this->assertEquals($data['firstName'], $contact->getFirstName());
        $this->assertEquals($data['message'], $contact->getMessage());
    }
}