<?php


namespace App\Controller;


use App\Entity\Artical;
use App\Repository\ArticalRepository;
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
    public function indexAction(Request $request)
    {
        $find = $this->getDoctrine()->getManager();
        $articals = $find->getRepository(Artical::class)->findAll();

        return $this->render('artical/show.html.twig', ['articals'=>$articals]) ;

    }

}