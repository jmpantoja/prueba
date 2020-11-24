<?php

namespace App\Infrastructure\Doctrine\DataFixtures;


use App\Domain\Example\Contact;
use App\Domain\Example\FullName;
use Carbon\CarbonImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ContactFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $count = 100;
        while ($count >= 0) {
            $faker = Factory::create();

            $fullName = new FullName(...[
                $faker->firstName,
                $faker->lastName
            ]);

            $date = $faker->dateTimeBetween('-60 years', 'now');
            $bithDate = CarbonImmutable::make($date) ;


            $contact = new Contact($fullName, $bithDate);
            $manager->persist($contact);
            $count--;
        }


        $manager->flush();

    }
}
