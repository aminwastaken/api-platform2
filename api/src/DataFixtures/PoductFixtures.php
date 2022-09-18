<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Product;
use Faker\Factory;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\DataFixtures\CategoryFixtures;
use App\Entity\Category;


class PoductFixtures extends Fixture  implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $categories = $manager->getRepository(Category::class)->findAll();
        for ($i = 0; $i < 10; $i++) {
            $object = (new Product())
            ->setName($faker->colorName)
            ->setPrice($faker->randomFloat(2, 0, 1000))
            ->setDescription($faker->paragraph)
            ->setStock($faker->numberBetween(1, 100))
            ->setNutriscore($faker->randomElement(['A', 'B', 'C', 'D', 'E']))
        ;

        for($j = 0; $j < $faker->numberBetween(1, 3); $j++) {
            $object->addCategory($faker->randomElement($categories));
        }
        $manager->persist($object);
        }


        // $product = new Product();

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }


}
