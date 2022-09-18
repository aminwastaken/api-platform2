<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Product;
use App\Entity\Order;
use Faker\Factory;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\DataFixtures\CategoryFixtures;
use App\Entity\Category;
use App\Entity\OrderProduct;


class OrderProductFixtures extends Fixture  implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $products = $manager->getRepository(Product::class)->findAll();
        for ($i = 0; $i < 10; $i++) {
            $object = (new OrderProduct())
            ->setQuantity($faker->numberBetween(1, 100))
            ->setProduct($faker->randomElement($products));

        $manager->persist($object);
        }


        // $product = new Product();

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProductFixtures::class,
        ];
    }


}
