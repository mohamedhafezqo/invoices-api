<?php

namespace App\DataFixtures;

use App\Entity\Company;
use App\Entity\Ride;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CompanyFixtures extends BaseFixtures
{
    private $faker;
    private const GENERATE_COUNT = 10;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function loadData(ObjectManager $manager)
    {
        $this->createMany(Company::class, self::GENERATE_COUNT, function(Company $company, $count) {

            $company->setName($this->faker->company)
                ->setRiskLimit($this->faker->numberBetween(1000, 20000))
            ;
            var_dump($count);
            $this->addReference('company-'.$count, $company);

        });

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
