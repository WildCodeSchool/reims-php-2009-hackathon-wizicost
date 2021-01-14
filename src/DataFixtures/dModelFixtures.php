<?php

namespace App\DataFixtures;

use App\Entity\Model;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class DmodelFixtures extends Fixture
{
    private const MODELS = [
        'Tracteur 1000',
        'Tracteur 2000',
        'Tracteur 3000',
        'Moissonneuse 1000',
        'Moissonneuse 2000',
        'Moissonneuse 3000',
        'Charrue 1000',
        'Charrue 2000',
        'Charrue 3000',
    ];
    public function load(ObjectManager $manager)
    {
        foreach (self::MODELS as $key => $modelsName) {
            $model = new Model();
            $model->setModel($modelsName);
            $model->setBrand($this->getReference('brand_' . $key));
            $manager->persist($model);
            $this->addReference('model_' . $key, $model);
        }
        $manager->flush();
    }
}
