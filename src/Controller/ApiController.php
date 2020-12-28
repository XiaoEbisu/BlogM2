<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

        return $this->json('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }
}
