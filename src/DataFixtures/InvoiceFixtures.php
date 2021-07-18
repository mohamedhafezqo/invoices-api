<?php

namespace App\DataFixtures;

use App\Entity\Invoice;
use App\Entity\Ride;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class InvoiceFixtures extends BaseFixtures
{
    private $faker;
    private const GENERATE_COUNT = 60;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function loadData(ObjectManager $manager)
    {
        $this->createMany(Invoice::class, self::GENERATE_COUNT, function(Invoice $invoice, $count) {

            $invoice->setStatus($this->faker->numberBetween(1, 3))
                ->setCost($this->faker->randomFloat(2, 2.5, 150.5))
                ->setQuantity($this->faker->randomDigit)
                ->setDescription($this->faker->streetAddress)
                ->setCompany($this->getReference('company-'.$this->faker->numberBetween(1, 9)))
                ->setCreatedAt(new \DateTime('now'))
            ;
        });

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
