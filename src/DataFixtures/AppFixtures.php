<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $this->loadUsers($manager);
        $this->loadPosts($manager);
    }


    private function loadPosts(ObjectManager $manager)
    {
        $text = '
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis erat ex, euismod sit amet arcu at, 
        hendrerit tempor metus. Maecenas non dapibus dui. Suspendisse cursus nunc sit amet dolor ultricies dictum. 
        Quisque vel dolor feugiat, ultrices tellus quis, consectetur justo. Donec gravida, metus sed dapibus ultricies, 
        purus turpis blandit felis, vitae euismod libero orci vel quam. Mauris sit amet libero mi. Maecenas nec nisi 
        lorem. Curabitur turpis ligula, finibus ac consequat sed, vestibulum a ante.</p>

        <p>Pellentesque vel velit vel urna ultricies viverra. Pellentesque nec sapien eget turpis mollis vestibulum. 
        Ut finibus orci ut metus mollis tincidunt. Cras ut sapien maximus, mattis diam ac, auctor lectus. Nulla 
        consectetur ac sem eu lacinia. Sed tempus ipsum ac arcu consequat vulputate. Morbi ornare viverra ornare.
        Nunc iaculis sem mauris, sit amet efficitur sem rutrum et. In mi felis, accumsan in suscipit nec, commodo 
        quis enim. Mauris urna quam, pellentesque eget justo a, auctor lacinia dolor. Integer in finibus arcu. 
        Phasellus nisi felis, mattis vitae nunc ac, sollicitudin vehicula ipsum. Nulla egestas aliquet est, 
        id porta tortor. Aenean tempus non est eget dignissim.</p>
         
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis erat ex, euismod sit amet arcu at, 
        hendrerit tempor metus. Maecenas non dapibus dui. Suspendisse cursus nunc sit amet dolor ultricies dictum. 
        Quisque vel dolor feugiat, ultrices tellus quis, consectetur justo. Donec gravida, metus sed dapibus ultricies, 
        purus turpis blandit felis, vitae euismod libero orci vel quam. Mauris sit amet libero mi. Maecenas nec nisi 
        lorem. Curabitur turpis ligula, finibus ac consequat sed, vestibulum a ante.</p>

        <p>Pellentesque vel velit vel urna ultricies viverra. Pellentesque nec sapien eget turpis mollis vestibulum. 
        Ut finibus orci ut metus mollis tincidunt. Cras ut sapien maximus, mattis diam ac, auctor lectus. Nulla 
        consectetur ac sem eu lacinia. Sed tempus ipsum ac arcu consequat vulputate. Morbi ornare viverra ornare.
        Nunc iaculis sem mauris, sit amet efficitur sem rutrum et. In mi felis, accumsan in suscipit nec, commodo 
        quis enim. Mauris urna quam, pellentesque eget justo a, auctor lacinia dolor. Integer in finibus arcu. 
        Phasellus nisi felis, mattis vitae nunc ac, sollicitudin vehicula ipsum. Nulla egestas aliquet est, 
        id porta tortor. Aenean tempus non est eget dignissim.</p>';

        $description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis erat ex, euismod sit amet arcu at, 
        hendrerit tempor metus.';

        for ($i = 0; $i < 10; $i++) {
            $post = new Post();
            $post->setTitle(
                'Some random text '.rand(
                    0,
                    100
                )
            );
            $post->setSlug(
                'some-random-text-'.rand(
                    0,
                    100
                )
            );
            $post->setDescription($description);
            $post->setText($text);
            $post->setCreated(new \DateTime('2018-03-15'));
            $post->setUser($this->getReference('thomaskanzig'));
            $manager->persist($post);
        }

        $manager->flush();
    }


    private function loadUsers(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('thomaskanzig');
        $user->setFullName('Thomas Kanzig');
        $user->setEmail('thomas.kanzig@gmail.com');
        $user->setPassword(
            $this->passwordEncoder->encodePassword(
                $user,
                '123456'
            )
        );
        $user->setRoles(['ROLE_ADMIN']);
        $user->setCreated(new \DateTime('2018-03-15'));
        $this->addReference('thomaskanzig', $user);

        $manager->persist($user);
        $manager->flush();
    }
}