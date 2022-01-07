<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 20/12/2021
 * Time: 15:03
 */

namespace App\Tests\Form;

use App\Entity\BusinessDepartment;
use App\Entity\Contact;
use App\Form\ContactForm;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\Form\DoctrineOrmExtension;
use Symfony\Component\Form\Test\TypeTestCase;

class ContactFormTest extends TypeTestCase
{
    protected function getExtensions()
    {
        $mockEntityManager = $this->createMock(EntityManager::class);
        $mockEntityManager->method('getClassMetadata')
            ->willReturn(new ClassMetadata(BusinessDepartment::class));

        $execute = $this->createMock(AbstractQuery::class);
        $execute->method('execute')
            ->willReturn([]);

        $query = $this->createMock(QueryBuilder::class);
        $query->method('getQuery')
            ->willReturn($execute);

        $entityRepository = $this->createMock(EntityRepository::class);
        $entityRepository->method('createQueryBuilder')
            ->willReturn($query);

        $mockEntityManager->method('getRepository')->willReturn($entityRepository);

        $mockRegistry = $this->createMock(ManagerRegistry::class);
        $mockRegistry->method('getManagerForClass')
            ->willReturn($mockEntityManager);

      return array_merge(parent::getExtensions(), [new DoctrineOrmExtension($mockRegistry)]);
   }

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