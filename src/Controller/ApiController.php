<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * 
 * @Route("/api")
 */
class ApiController extends AbstractController
{
    /**
     * @Route("/", name="api_index")
     */
    public function index(PostRepository $postRepository): Response
    {   
        $posts = $postRepository->findBy(array(), array('published' => 'DESC'), 5);
        $serializedPosts = [];
        foreach($posts as $post){
            array_push($serializedPosts, $this->serializePost($post));
        }

        return new JsonResponse(['post' => $serializedPosts, 'items' => count($serializedPosts)]);
    }

    private function serializePost(Post $post){
        return array(
            'title' => $post->getTitle(),
            'url_alias' => $post->getUrlAlias(),
            'content' => $post->getContent(),
            'published' => $post->getPublished()
        );
    }
}
