<?php

namespace App\DataFixtures;

use App\Entity\Option;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class EoptionFixtures extends Fixture
{
    private const OPTIONS = [
        'Gps',
        'Autoradio',
        'Climatisation',
        'Cabine fermée',
        'Attelage 3 points',
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::OPTIONS as $key => $optionName) {
            $option = new Option();
            $option->setName($optionName);
            $option->setModel($this->getReference('model_' . rand(0, 5)));
            $manager->persist($option);
            $this->addReference('option_' . $key, $option);
        }
        $manager->flush();
    }
}
