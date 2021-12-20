<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 20/12/2021
 * Time: 13:07
 */

namespace App\Tests\Entity;


use App\Entity\BusinessDepartment;
use PHPUnit\Framework\TestCase;

class BusinessDepartmentTest extends  testCase
{
    /**
     * Command of test "php bin/phpunit"
     */
    public function testBusinessDepartmentEntityWithCorrectData()
    {
        $data = [
            'email' => 'emailtest@gmail.com',
            'nameDepartement' => 'nameDepartement'
        ];

        $businessDepatment = new BusinessDepartment();
        $businessDepatment->setEmail($data['email']);
        $businessDepatment->setNameDepartment($data['nameDepartement']);

        $this->assertEquals($data['email'], $businessDepatment->getEmail());
        $this->assertEquals($data['nameDepartement'], $businessDepatment->getNameDepartment());
    }
}