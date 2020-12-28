<?php

namespace App\DataFixtures;

use App\Entity\Post;
use DateInterval;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\AsciiSlugger;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $slugger = new AsciiSlugger();
        for($i=0; $i<20; $i++){
            $post = new Post();
            $post->setTitle("Post " . $i);
            $post->setUrlAlias($slugger->slug($post->getTitle()));
            $post->setPublished((new \DateTime())->sub(new DateInterval('P'.$i.'D')));
            $manager->persist($post);
        }

        $manager->flush();
    }
}
