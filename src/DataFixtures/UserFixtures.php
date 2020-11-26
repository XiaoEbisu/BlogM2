<?php 
namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\String\Slugger\AsciiSlugger;

class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('admin@blog.com');
        $user->setPassword($this->encoder->encodePassword($user, 'some'));
        $user->setRoles(["ROLE_ADMIN"]);
        $manager->persist($user);

        $manager->flush();
    }
}

?>