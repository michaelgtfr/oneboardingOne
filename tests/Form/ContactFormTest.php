<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 20/12/2021
 * Time: 15:03
 */

namespace App\Tests\Form;

use App\Entity\Contact;
use App\Form\ContactForm;
use Symfony\Component\Form\Test\TypeTestCase;

class ContactFormTest extends TypeTestCase
{
    public function testBuildForm()
    {
        $data = [
            'name' => 'nameTest',
            'firstName' => 'firstnameTest',
            'email' => 'test_email@gmail.com',
            'message' => 'messageTest'
            ];

        $contact = new Contact();

        $form = $this->factory->create( ContactForm::class, $contact);

        $contactToCompare = new Contact();

        $contactToCompare->setName($data['name']);
        $contactToCompare->setFirstName($data['firstName']);
        $contactToCompare->setEmail($data['email']);
        $contactToCompare->setMessage($data['message']);

        //check the submission
        $form->submit($data);

        $this->assertTrue($form->isSynchronized());

        $this->assertEquals($contact->getName(), $contactToCompare->getName());
        $this->assertEquals($contact->getFirstName(), $contactToCompare->getFirstName());
        $this->assertEquals($contact->getEmail(), $contactToCompare->getEmail());
        $this->assertEquals($contact->getMessage(), $contactToCompare->getMessage());
    }
}