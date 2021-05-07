<?php

namespace App\Controller;

use App\Entity\Artical;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
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
