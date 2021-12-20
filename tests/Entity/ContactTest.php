<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 20/12/2021
 * Time: 13:13
 */

namespace App\Tests\Entity;


use App\Entity\BusinessDepartment;
use App\Entity\Contact;
use Error;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;

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
            'email' => 'emailtest@gmail.com'
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

    public function testContactEntityWithBadDataLengthPart()
    {
        $data = [
            'name' => str_pad(1,51 , "1", STR_PAD_BOTH),
            'firstName' => str_pad(1, 51, "1", STR_PAD_BOTH),
            'message' => str_pad(1, 256, "1", STR_PAD_BOTH),
        ];

        $contact = new Contact();
        $contact->setName($data['name']);
        $contact->setFirstName($data['firstName']);
        $contact->setMessage($data['message']);

        $validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping()
            ->getValidator();

        $errors = $validator->validate($contact);

        $this->assertEquals(3, count($errors));
    }

    public function testContactEntityWithBadDataExceptionPartOnTheEmailAttribute()
    {
        $data = [
            'email' => [],
        ];

        $this->expectException(Error::class);
        $contact = new Contact();
        $contact->setEmail($data['email']);
    }
    public function testContactEntityWithBadDataExceptionPartOnTheOrderRelationAttribute()
    {
        $data = [
            'order' => [],
        ];

        $this->expectException(Error::class);
        $contact = new Contact();
        $contact->setBusinessDepartment($data['order']);
    }
}