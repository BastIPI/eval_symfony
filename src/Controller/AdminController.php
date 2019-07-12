<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\BlogPost;
use App\Form\BlogPostType;
use App\Repository\BlogPostRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="admin")
     */
    public function index(BlogPostRepository $blogPostRepository)
    {
        return $this->render('admin/index.html.twig', [
            'blogposts' => $blogPostRepository->findAll(),
            'title' => 'Tous les posts',
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_edit_post", methods={"GET","POST"})
     */
    public function edit(Request $request, BlogPost $blogpost): Response
    {
        $form = $this->createForm(BlogPostType::class, $blogpost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin');
        }

        return $this->render('admin/edit_post.html.twig', [
            'blogpost' => $blogpost,
            'form' => $form->createView(),
        ]);
    }
}
