<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\AsciiSlugger;

/**
 * @Route("/")
 */
class PostController extends AbstractController
{
    /**
     * @Route("", name="post_index", methods={"GET"})
     */
    public function index(PostRepository $postRepository): Response
    {   

        return $this->render('post/index.html.twig', [
            'posts' => $postRepository->findAll(),
        ]);
    }

    /**
     * 
     * @Security("is_granted('ROLE_USER')")
     * 
     * @Route("post/new", name="post_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $slugger = new AsciiSlugger();
            //$post->setUrlAlias($slugger->slug($post->getTitle()));
            $post->setPublished(new \DateTime());
            $entityManager->persist($post);
            $entityManager->flush();

            return $this->redirectToRoute('post_index');
        }

        return $this->render('post/new.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("post/{slug}", name="post_show", methods={"GET"})
     */
    public function show(string $slug): Response
    {   
        $post = $this->getDoctrine()->getRepository(Post::class)->findOneBy(['url_alias' => $slug]);
        if(!$post){
            return $this->render('exception/error404.html.twig');
        }
        return $this->render('post/show.html.twig', [
            'post' => $post,
        ]);
    }

    /**
     * @Security("is_granted('ROLE_USER')")
     * 
     * @Route("post/{slug}/edit", name="post_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, string $slug): Response
    {
        $post = $this->getDoctrine()->getRepository(Post::class)->findOneBy(['url_alias' => $slug]);
        if(!$post){
            return $this->render('exception/error404.html.twig');
        }
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //$slugger = new AsciiSlugger();
            //$post->setUrlAlias($slugger->slug($post->getTitle()));
            $this->getDoctrine()->getManager()->flush();
            
            return $this->redirectToRoute('post_show', [
                'slug' => $post->getUrlAlias()
            ]);
        }

        return $this->render('post/edit.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Security("is_granted('ROLE_USER')")
     * 
     * @Route("post/{id}", name="post_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Post $post): Response
    {
        if ($this->isCsrfTokenValid('delete'.$post->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($post);
            $entityManager->flush();
        }

        return $this->redirectToRoute('post_index');
    }
}
