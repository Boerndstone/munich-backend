<?php

namespace App\Controller;

use App\Entity\Rock;
use App\Entity\Area;
use App\Entity\Routes;
use App\Form\RockType;
use App\Repository\RockRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/rock")
 */
class RockController extends AbstractController
{
    /**
     * @Route("/", name="rock_index", methods={"GET"})
     */
    public function index(RockRepository $rockRepository, Request $request): Response
    {

        $rocks = $rockRepository->findSearchTerm(
            $request->query->get('q')
        );

        return $this->render('rock/index.html.twig', [
            'rocks' => $rocks,
        ]);
    }

    /**
     * @Route("/new", name="rock_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $rock = new Rock();
        $form = $this->createForm(RockType::class, $rock);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($rock);
            $entityManager->flush();

            return $this->redirectToRoute('rock_index');
        }

        return $this->render('rock/new.html.twig', [
            'rock' => $rock,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="rock_show", methods={"GET"})
     */
    public function show(Rock $rock): Response
    {
        $routes = $rock->getRoutes();

        return $this->render('rock/show.html.twig', [
            'rock' => $rock,
            'routes' => $routes
        ]);
    }

    /**
     * @Route("rock/routes", name="rock_search_routes", requirements={"id":"\d+"}))
     */
    public function searchRoutes(RockRepository $rockRepository, Request $request)
    {
        $routes = $rockRepository->findSearchTerm(
            $request->query->get('q')
        );
        return $this->render('routes/search.html.twig', [
            'routes' => $routes
        ]);
    }

    /**
     * @Route("/{id}/edit", name="rock_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Rock $rock): Response
    {
        $area = $rock->getArea();
        $routes = $rock->getRoutes();

        $form = $this->createForm(RockType::class, $rock);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('rock_index');
        }

        return $this->render('rock/edit.html.twig', [
            'rock' => $rock,
            'area' => $area,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="rock_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Rock $rock): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rock->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($rock);
            $entityManager->flush();
        }

        return $this->redirectToRoute('rock_index');
    }
}
