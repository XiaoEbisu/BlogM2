<?php

namespace App\DataFixtures;

use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\AsciiSlugger;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {   
        $index = 0;
        // $product = new Product();
        // $manager->persist($product);
        for($index; $index < 10; $index++){
            $post = new Post();
            $post->setTitle("My Post {$index}");
            $post->setContent("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse et ultrices mi. Vivamus ornare nunc sit amet ligula pulvinar, non facilisis lorem tempor. Phasellus at justo volutpat, vulputate neque sed, vestibulum odio. Proin eleifend tortor nec pretium venenatis. Fusce scelerisque lacinia elit et rhoncus. Mauris at enim a lectus pretium mollis in eget odio. Sed velit tellus, aliquam a aliquet sit amet, efficitur eget nisi. Vestibulum a augue nec massa suscipit lobortis. Curabitur vulputate efficitur dignissim. Sed feugiat, arcu ut viverra tempor, justo nulla feugiat libero, vel consectetur tellus nisi et massa. Duis vitae scelerisque ex. Nam nec risus ut nunc euismod molestie quis et ipsum. Duis massa enim, sagittis nec augue eu, auctor condimentum odio. Ut sit amet magna eu velit laoreet auctor. Proin id nibh quis sem fermentum porta at eu lectus. Integer rutrum magna a diam lobortis volutpat.
    
            Aliquam et enim elementum, pulvinar metus sed, malesuada dolor. Nulla accumsan lacus in tristique commodo. Morbi venenatis risus eros, ut maximus purus pellentesque eget. Nam consectetur sollicitudin tristique. Sed sagittis eu purus consectetur tempus. Nam sed malesuada erat, eget porttitor libero. Vivamus venenatis pellentesque leo vitae molestie. Mauris sit amet massa accumsan, scelerisque tortor id, ullamcorper neque. Mauris porttitor tortor quis volutpat scelerisque.
            
            Vestibulum lorem dolor, bibendum varius massa quis, mollis mollis nisl. Duis vel aliquet nisl, eu aliquet libero. Cras convallis tempus interdum. Nunc finibus consequat nulla, vel congue sem pulvinar at. In sodales velit felis. Donec vel egestas ante. Morbi arcu libero, laoreet in eros ac, sodales consequat mi. Cras vehicula justo a ultrices lobortis. Nulla et justo vestibulum ipsum sodales faucibus ut non elit. Nullam ante lacus, interdum eget consequat vel, auctor vel ipsum. Proin tincidunt ornare felis vitae gravida. Aliquam vestibulum convallis nisi eu malesuada.
            
            Aenean malesuada non magna malesuada lobortis. Mauris malesuada leo vestibulum libero rutrum tempus. Quisque pharetra nibh sit amet nibh blandit interdum. Etiam feugiat suscipit lectus nec pulvinar. Phasellus blandit, lacus ut venenatis tincidunt, justo est venenatis leo, ac ullamcorper nibh enim in dui. Pellentesque consequat urna et ornare vestibulum. Integer rhoncus in orci eu vestibulum. Maecenas nec tristique tortor. Nunc tincidunt gravida elit, ac dignissim ex congue sed. Suspendisse nibh odio, dapibus sollicitudin leo at, dictum dapibus libero. Morbi ex ante, ultricies in purus non, congue sodales est. Quisque lorem nisi, luctus in tincidunt ut, viverra venenatis risus. Nulla facilisi. Cras eleifend elit at aliquam lacinia.
            
            Nunc vel ligula sed ante tristique efficitur. Sed est nisi, consectetur vel condimentum et, lacinia ut erat. Vivamus aliquam enim eget libero rutrum, non malesuada orci fermentum. Aenean orci nisl, convallis pharetra ornare at, scelerisque nec dui. Fusce vulputate suscipit purus in vestibulum. In urna mauris, ultrices ac scelerisque nec, maximus at turpis. Maecenas ultrices vitae urna sed rutrum. Nulla porttitor elit vel risus efficitur, eu sagittis velit rhoncus. Integer velit nisi, tempor a luctus a, luctus nec libero. Mauris eu eros maximus, finibus massa tempor, ultricies metus. Praesent ac tortor sed leo congue eleifend et a diam. Donec interdum non sapien vitae commodo.");
            $slugger = new AsciiSlugger();
            $post->setUrlAlias($slugger->slug($post->getTitle()));
            $post->setPublished(new \DateTime());
            $manager->persist($post);
        }
        
        $manager->flush();
    }
}
