<?php

namespace App\DataFixtures;

use App\Entity\MachineType;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class BmachineTypeFixtures extends Fixture
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
        $distributrice = new MachineType();
        $distributrice->setType('Distributrice');
        $distributrice->setCategory($this->getReference('category_0'));
        $manager->persist($distributrice);
        $this->addReference('type_0', $distributrice);

        $pulverisateur = new MachineType();
        $pulverisateur->setType('Pulverisateur');
        $pulverisateur->setCategory($this->getReference('category_1'));
        $manager->persist($pulverisateur);
        $this->addReference('type_1', $pulverisateur);

        $camionBenne = new MachineType();
        $camionBenne->setType('Camion Benne');
        $camionBenne->setCategory($this->getReference('category_2'));
        $manager->persist($camionBenne);
        $this->addReference('type_2', $camionBenne);

        $debardeuse = new MachineType();
        $debardeuse->setType('Debardeuse');
        $debardeuse->setCategory($this->getReference('category_3'));
        $manager->persist($debardeuse);
        $this->addReference('type_3', $debardeuse);

        $moissonneuseBatteuse = new MachineType();
        $moissonneuseBatteuse->setType('Moissonneuse Batteuse');
        $moissonneuseBatteuse->setCategory($this->getReference('category_3'));
        $manager->persist($moissonneuseBatteuse);
        $this->addReference('type_4', $moissonneuseBatteuse);

        $tracteur = new MachineType();
        $tracteur->setType('Tracteur');
        $tracteur->setCategory($this->getReference('category_4'));
        $manager->persist($tracteur);
        $this->addReference('type_5', $tracteur);

        $faucheuse = new MachineType();
        $faucheuse->setType('Faucheuse');
        $faucheuse->setCategory($this->getReference('category_3'));
        $manager->persist($faucheuse);
        $this->addReference('type_6', $faucheuse);

        $semoir = new MachineType();
        $semoir->setType('Semoir');
        $semoir->setCategory($this->getReference('category_5'));
        $manager->persist($semoir);
        $this->addReference('type_7', $semoir);

        $charrue = new MachineType();
        $charrue->setType('Charrue');
        $charrue->setCategory($this->getReference('category_5'));
        $manager->persist($charrue);
        $this->addReference('type_8', $charrue);

        $manager->flush();
    }
}
