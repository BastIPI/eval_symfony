<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\BlogPost;
use App\Repository\BlogPostRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/blog")
 */
class BlogPostController extends AbstractController
{
    /**
     * @Route("/", name="blog_post")
     */
    public function index()
    {
        return $this->render('blog_post/index.html.twig', [
            'controller_name' => 'BlogPostController',
        ]);
    }
    
    /**
     * @Route("/list", name="blogpost_list")
     */
    public function listPostsAction(BlogPostRepository $blogPostRepository)
    {
        return $this->render('blog_post/index.html.twig', [
            'blogposts' => $blogPostRepository->findAll(),
            'title' => 'Tous les posts',
        ]);
    }
    
    /**
     * @Route("/list/featured", name="blogpost_list_featured")
     */
    public function listPostsFeatured(BlogPostRepository $blogPostRepository)
    {
        return $this->render('blog_post/index.html.twig', [
            'blogposts' => $blogPostRepository->findByFeatured(true),
            'title' => 'Posts featured',
        ]);
    }

    /**
     * @Route("/{id}", name="blogpost_show_id", methods={"GET"})
     * @Route("/slug/{slug}", name="blogpost_show_slug", methods={"GET"})
     */
    public function showPostAction(BlogPostRepository $blogPostRepository, $id = null, $slug = null): Response
    {
        $blogpost = new BlogPost();
        if ($id !== null) {
            $blogpost = $blogPostRepository->findOneById($id);
        } else if ($slug !== null) {
            $blogpost = $blogPostRepository->findOneBySlug($slug);
        }
        return $this->render('blog_post/post.html.twig', [
            'blogpost' => $blogpost,
        ]);
    }
}
