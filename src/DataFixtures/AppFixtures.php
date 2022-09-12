<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\Product;
use App\Entity\Invoice;
Use App\Entity\User;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('alicia.pilar83@gmail.com');
        $user->setRoles(['ADMIN']);

        $password = $this->hasher->hashPassword($user, 'pass_1234');
        $user->setPassword($password);

        $manager->persist($user);
        $manager->flush();
        // create 20 products
            for ($i = 0; $i < 20; $i++) {
            $product = new Product();
            $product->setName('product '.$i);
            $product->setPriceExl(mt_rand(10, 100));
            $product->setPriceAti(mt_rand(10, 100));
            $manager->persist($product);
        }
        $manager->flush();
        
        // create 20 invoice
        for ($i = 0; $i < 20; $i++) {
            $invoice = new Invoice();
            $invoice->setUser($user);
            $invoice->addProducts($product);
            $invoice->setDesignation('invoice designation'.$i);
            $invoice->setDescription('invoice description'.$i);
            $invoice->setPriceExl(mt_rand(10, 100));
            $invoice->setPriceAti(mt_rand(10, 100));
            $manager->persist($invoice);
        }
        $manager->flush();

    }
}