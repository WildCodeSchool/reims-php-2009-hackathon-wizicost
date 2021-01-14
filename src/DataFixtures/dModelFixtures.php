<?php

namespace App\DataFixtures;

use App\Entity\Model;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class DmodelFixtures extends Fixture
{
    private const MODELS = [
        '1000',
        '2000',
        '3000',
        '250 gti',
        '328 turbo',
        '425 dti',
        'plus ultra',
        '750 cv',
        '325 kw',
    ];
    public function load(ObjectManager $manager)
    {
        foreach (self::MODELS as $key => $modelsName) {
            $model = new Model();
            $model->setModel($modelsName);
            $model->setMachineType($this->getReference('type_' . $key));
            $model->setBrand($this->getReference('brand_' . $key));
            $manager->persist($model);
            $this->addReference('model_' . $key, $model);
        }
        $manager->flush();
    }
}
