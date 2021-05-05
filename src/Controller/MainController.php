<?php


namespace App\Controller;


use App\Entity\Artical;
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
     * @Route ("/politics",name="politics",methods={"GET"})
     * @return Response
     */

    public function typePolitics(Request $request)
    {
        $find = $this->getDoctrine()->getManager();
        $types = $find ->getRepository(Artical::class)->findAll();

        return $this->render('main/politics.html.twig',['articals' => $types]);
    }

    /**
     * @Route ("/coronavirus",name="coronavirus",methods={"GET"})
     * @return Response
     */

    public function typeCoronavirus(Request $request)
    {
        $find = $this->getDoctrine()->getManager();
        $types = $find ->getRepository(Artical::class)->findAll();

        return $this->render('main/coronavirus.html.twig',['articals' => $types]);
    }

    /**
     * @Route ("/tech",name="tech",methods={"GET"})
     * @return Response
     */

    public function typeTech(Request $request)
    {
        $find = $this->getDoctrine()->getManager();
        $types = $find ->getRepository(Artical::class)->findAll();

        return $this->render('main/tech.html.twig',['articals' => $types]);
    }
    /**
     * @Route ("/world",name="world",methods={"GET"})
     * @return Response
     */

    public function typeWorld(Request $request)
    {
        $find = $this->getDoctrine()->getManager();
        $types = $find ->getRepository(Artical::class)->findAll();

        return $this->render('main/world.html.twig',['articals' => $types]);
    }




}