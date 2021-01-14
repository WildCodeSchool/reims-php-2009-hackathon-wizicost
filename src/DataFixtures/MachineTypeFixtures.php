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
        'Camion Benne',
        'Moissonneuse Batteuse',
        'Tracteur',
        'Faucheuse',
        'Semoir',
        'Charrue',
    ];
    public function load(ObjectManager $manager)
    {
        /*foreach (self::TYPES as $key => $typeName) {
            $type = new MachineType();
            $type->setType($typeName);
            $type->setCategory($this->getReference('category_' . rand(0, 5)));
            $manager->persist($type);
            $this->addReference('type_' . $key, $type);
        }*/
        $distributrice = new MachineType();
        $distributrice->setType('Distributrice');
        $distributrice->setCategory($this->getReference('category_1'));
        $manager->persist($distributrice);

        $pulverisateur = new MachineType();
        $pulverisateur->setType('Pulverisateur');
        $pulverisateur->setCategory($this->getReference('category_2'));
        $manager->persist($pulverisateur);

        $camionBenne = new MachineType();
        $camionBenne->setType('Camion Benne');
        $camionBenne->setCategory($this->getReference('category_3'));
        $manager->persist($camionBenne);

        $debardeuse = new MachineType();
        $debardeuse->setType('Debardeuse');
        $debardeuse->setCategory($this->getReference('category_4'));
        $manager->persist($debardeuse);

        $moissonneuseBatteuse = new MachineType();
        $moissonneuseBatteuse->setType('Moissonneuse Batteuse');
        $moissonneuseBatteuse->setCategory($this->getReference('category_4'));
        $manager->persist($moissonneuseBatteuse);

        $tracteur = new MachineType();
        $tracteur->setType('Tracteur');
        $tracteur->setCategory($this->getReference('category_5'));
        $manager->persist($tracteur);

        $faucheuse = new MachineType();
        $faucheuse->setType('Faucheuse');
        $faucheuse->setCategory($this->getReference('category_4'));
        $manager->persist($faucheuse);

        $semoir = new MachineType();
        $semoir->setType('Semoir');
        $semoir->setCategory($this->getReference('category_6'));
        $manager->persist($semoir);

        $charrue = new MachineType();
        $charrue->setType('Charrue');
        $charrue->setCategory($this->getReference('category_6'));
        $manager->persist($charrue);
        
        $manager->flush();
    }
}
