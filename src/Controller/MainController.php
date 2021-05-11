<?php


namespace App\Controller;


use App\Entity\Artical;
use ContainerBiv4eCt\getArticalTypeService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class MainController extends AbstractController
{
    /**
     * @Route("/", name="homepage", methods={"GET"})
     * @Template()
     */
    public function indexAction(): Response
    {
        $find = $this->getDoctrine()->getManager();
        $articals = $find->getRepository(Artical::class)->findAll();

        return $this->render('main/artical_types.html.twig',['articals'=>$articals]);


    }

    /**
     * @Route ("/enable", name="enable",methods={"GET"})
     */

    public function  showIsEnableArtical(Request $request)
    {
        $find = $this->getDoctrine()->getManager();
        $enable = $find ->getRepository(Artical::class)->findAll();

        return $this->render('main/index.html.twig',['articals'=>$enable]);

    }
    /**
     * @Route ("/artical-category/{categoryName}", name="category",methods={"GET"})
     * @return Response
     */
    public function category($categoryName): Response
    {
        $em = $this->getDoctrine()->getManager();
        $show = $em->getRepository(Artical::class)->findArticleWithCategory($categoryName);

        return $this->render('artical/show.html.twig', ['articals'=>$show]);
    }

}