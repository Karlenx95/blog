<?php

namespace App\Controller;

use App\Entity\Artical;
use App\Form\ArticalType;
use App\Repository\ArticalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/artical")
 */
class ArticalController extends AbstractController
{
    /**
     * @Route("/", name="artical_index", methods={"GET"})
     */
    public function index(ArticalRepository $articalRepository): Response
    {
        return $this->render('artical/index.html.twig', [
            'articals' => $articalRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="artical_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $artical = new Artical();
        $form = $this->createForm(ArticalType::class, $artical);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($artical);
            $entityManager->flush();

            return $this->redirectToRoute('artical_index');
        }

        return $this->render('artical/new.html.twig', [
            'artical' => $artical,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="artical_show", methods={"GET"})
     */
    public function show(Artical $artical): Response
    {
        return $this->render('artical/show_one.html.twig', [
            'artical' => $artical,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="artical_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Artical $artical): Response
    {
        $form = $this->createForm(ArticalType::class, $artical);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('artical_index');
        }

        return $this->render('artical/edit.html.twig', [
            'artical' => $artical,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="artical_delete", methods={"POST"})
     */
    public function delete(Request $request, Artical $artical): Response
    {
        if ($this->isCsrfTokenValid('delete'.$artical->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($artical);
            $entityManager->flush();
        }

        return $this->redirectToRoute('artical_index');
    }
}
