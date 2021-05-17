<?php


namespace App\Controller;


use App\Entity\Artical;
use App\Entity\Category;
use App\Repository\ArticalRepository;
use App\Repository\CategoryRepository;
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

        return $this->render('base.html.twig',['articals'=>$articals]);


    }

    /**
     * @Route("/msin/mrnu/drow", name="main-menu-drow")
     *
     * @param Request $request
     *
     */
    public function mainMenuAction(Request $request, CategoryRepository $categoryRepository) {

        $caategories = $categoryRepository->findBy(['isEnabled'=>true]);

        return $this->render('main/menu.html.twig', ['categories'=>$caategories]);
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
     * @Route ("/articales-page-list/{categoryName}", name="artical-list",methods={"GET"})
     * @return Response
     */
    public function pages($categoryName,Request $request, ArticalRepository $articalRepository): Response
    {


        $paginator = $articalRepository->findArticlePagination($categoryName, $request->query->get('page', 1),'10');


        return $this->render('main/page.html.twig', ['total_cnt'=>$paginator->count(), 'paginator'=>$paginator->getIterator()]);

    }








}