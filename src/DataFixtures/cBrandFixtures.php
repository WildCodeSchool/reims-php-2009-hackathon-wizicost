<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CbrandFixtures extends Fixture
{
    private const BRANDS = [
        'John Deere',
        'New Holland',
        'Fendt',
        'Claas',
        'Amazone',
        'Lemken',
        'Deutz-Fahr',
        'Horsch',
        'Same',
        'Krone'
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::BRANDS as $key => $brand) {
            $brand = new Brand();
            $brand->setBrand(self::BRANDS[array_rand(self::BRANDS, 1)]);
            $brand->addMachineType($this->getReference('type_' . rand(0, 7)));
            $manager->persist($brand);
            $this->addReference('brand_' . $key, $brand);
        }
        $manager->flush();
    }
}
