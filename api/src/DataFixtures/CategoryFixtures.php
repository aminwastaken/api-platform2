<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Category;
use Faker\Factory;


class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        // $categories = $manager->getRepository(Category::class)->findAll();
        for ($i = 0; $i < 10; $i++) {
            $object = (new Category())
            ->setName($faker->colorName)
        ;
        $manager->persist($object);
        }

        $manager->flush();
    }
}
