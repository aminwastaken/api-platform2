<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Order;
use Faker\Factory;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\DataFixtures\CategoryFixtures;
use App\Entity\Category;
use App\Entity\OrderProduct;
use App\DataFixtures\OrderProductFixtures;

class OrderFixtures extends Fixture  implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $orderProducts = $manager->getRepository(OrderProduct::class)->findAll();
 
        for ($i = 0; $i < 10; $i++) {
            $object = (new Order())
            ->setDate($faker->dateTimeBetween('-1 years', 'now'))
            ->setDiscount($faker->numberBetween(0, 100))
            ->setTotal($faker->numberBetween(0, 100))
        ;

        for($j = 0; $j < 10; $j++) {
            $object->addOrderProduct($faker->randomElement($orderProducts));
        }

 
        }

        $manager->persist($object);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            OrderProductFixtures::class,
        ];
    }


}
