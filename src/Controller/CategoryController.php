<?php

namespace App\Controller;

use App\Entity\Artical;
use App\Entity\Category;
use App\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{

    /**
     * @Route("/new-category/{$category}", name="new-category", methods={"GET","POST"})
     */
    public function newCategory(Request $request): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();

            return $this->redirectToRoute('artical_index');
        }

        return $this->render('artical/newCategory.html.twig', [
            'category' => $category,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route ("/artical-category/{categoryName}", name="category",methods={"GET"})
     * @return Response
     */
    public function indexAction($categoryName): Response
    {
        $em = $this->getDoctrine()->getManager();
        $show = $em->getRepository(Artical::class)->findArticleWithCategory($categoryName);

        return $this->render('artical/show.html.twig', ['articals'=>$show]);
    }

}
