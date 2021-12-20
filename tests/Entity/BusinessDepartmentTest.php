<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 20/12/2021
 * Time: 13:07
 */

namespace App\Tests\Entity;


use App\Entity\BusinessDepartment;
use Error;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;

class BusinessDepartmentTest extends  testCase
{
    /**
     * Command of test "php bin/phpunit"
     */
    public function testBusinessDepartmentEntityWithCorrectData()
    {
        $data = [
            'email' => 'emailtest@gmail.com',
            'nameDepartment' => 'nameDepartment'
        ];

        $businessDepartment = new BusinessDepartment();
        $businessDepartment->setEmail($data['email']);
        $businessDepartment->setNameDepartment($data['nameDepartment']);

        $this->assertEquals($data['email'], $businessDepartment->getEmail());
        $this->assertEquals($data['nameDepartment'], $businessDepartment->getNameDepartment());
    }

    public function testContactEntityWithBadDataLengthPart()
    {
        $data = [
            'email' => str_pad(1,61 , "1", STR_PAD_BOTH),
            'nameDepartment' => str_pad(1, 51, "1", STR_PAD_BOTH),
        ];

        $businessDepartment = new BusinessDepartment();
        $businessDepartment->setEmail($data['email']);
        $businessDepartment->setNameDepartment($data['nameDepartment']);

        $validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping()
            ->getValidator();

        $errors = $validator->validate($businessDepartment);

        $this->assertEquals(2, count($errors));
    }

    public function testContactEntityWithBadDataExceptionPartOnTheEmailAttribute()
    {
        $data = [
            'email' => [],
        ];

        $this->expectException(Error::class);
        $businessDepartment = new BusinessDepartment();
        $businessDepartment->setEmail($data['email']);
    }
    public function testContactEntityWithBadDataExceptionPartOnTheOrderRelationAttribute()
    {
        $data = [
            'order' => [],
        ];

        $this->expectException(Error::class);
        $businessDepartment = new BusinessDepartment();
        $businessDepartment->addContact($data['order']);
    }
}