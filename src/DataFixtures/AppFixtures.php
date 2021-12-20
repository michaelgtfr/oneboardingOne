<?php

namespace App\DataFixtures;

use App\Entity\BusinessDepartment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    /**
     * Send the data in the bdd. Command "php bin/console doctrine:fixtures:load"
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        foreach ($this->arrayDataBusinessDepartment() as $value) {
            $business = new BusinessDepartment();
            $business->setEmail($value['email']);
            $business->setNameDepartment($value['nameDepartment']);
            $manager->persist($business);
            $manager->flush();
        };
    }

    /**
     * Array of fixture for the compagny department
     *
     * @return array
     */
    public function arrayDataBusinessDepartment()
    {
        return [
            [
                'email' => 'service_commercial_marketing@onbordingone.com',
                'nameDepartment' => 'Service commercial et marketing'
            ],
            [
                'email' => 'direction_financière_compabilité@onbordingone.com',
                'nameDepartment' => 'Direction financière et compabilité'
            ],
            [
                'email' => 'département_ressources_humaines@onbordingone.com',
                'nameDepartment' => 'Département des ressources humaines'
            ],
            [
                'email' => 'direction_achats@onbordingone.com',
                'nameDepartment' => 'Direction des achats'
            ],
            [
                'email' => 'Service_juridique@onbordingone.com',
                'nameDepartment' => 'Service juridique'
            ],
            [
                'email' => 'Service_technique@onbordingone.com',
                'nameDepartment' => 'Service technique'
            ],
            [
                'email' => 'Service_direction_administration_générale@onbordingone.com',
                'nameDepartment' => 'Service direction et administration générale'
            ],
            [
                'email' => 'Service_recherche_développement@onbordingone.com',
                'nameDepartment' => 'Service recherche et développement'
            ],
        ];
    }
}
