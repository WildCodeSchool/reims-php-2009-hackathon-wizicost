<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AcategoryFixtures extends Fixture
{
    private const CATEGORIES = [
        'Distribution Aliments',
        'Epandage / Fertilisation',
        'Manutention / Transport',
        'Recolte',
        'Traction',
        'Travail du Sol',
    ];
    public function load(ObjectManager $manager)
    {
        foreach (self::CATEGORIES as $key => $categoryName) {
            $category = new Category();
            $category->setName($categoryName);
            $manager->persist($category);
            $this->addReference('category_' . $key, $category);
        }
        $manager->flush();
    }
}
