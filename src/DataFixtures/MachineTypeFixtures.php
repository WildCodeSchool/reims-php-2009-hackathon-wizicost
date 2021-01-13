<?php

namespace App\DataFixtures;

use App\Entity\MachineType;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class MachineTypeFixtures extends Fixture
{
    private const TYPES = [
        'Distributrice',
        'Pulverisateur',
        'Debardeuse',
        'Moissonneuse Batteuse',
        'Tracteur',
        'Faucheuse',
        'Semoir',
        'Charrue',
    ];
    public function load(ObjectManager $manager)
    {
        foreach (self::TYPES as $key => $typeName) {
            $type = new MachineType();
            $type->setType($typeName);
            $type->setCategory($this->getReference('category_' . rand(0, 5)));
            $manager->persist($type);
            $this->addReference('type_' . $key, $type);
        }
        $manager->flush();
    }
}
