<?php

namespace App\Controller;

use App\Entity\Rock;
use App\Entity\Area;
use App\Entity\Routes;
use App\Form\RockType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AreaRepository;
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
    public function index(RockRepository $rockRepository, Request $request, AreaRepository $areaRepository): Response
    {

        $rocks = $rockRepository->findSearchTerm(
            $request->get('q')
        );

        return $this->render('rock/index.html.twig', [
            'rocks' => $rocks,
            'areas' => $areaRepository->findAllAreasAlphabetical(),
        ]);
    }

    /**
     * @Route("/new", name="rock_new", methods={"GET","POST"})
     */
    public function new(Request $request, AreaRepository $areaRepository): Response
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
            'areas' => $areaRepository->findAllAreasAlphabetical(),
        ]);
    }

    /**
     * @Route("/{id}", name="rock_show", methods={"GET"})
     */
    public function show(Rock $rock, AreaRepository $areaRepository): Response
    {
        $routes = $rock->getRoutes();

        return $this->render('rock/show.html.twig', [
            'rock' => $rock,
            'routes' => $routes,
            'areas' => $areaRepository->findAllAreasAlphabetical(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="rock_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Rock $rock, AreaRepository $areaRepository): Response
    {
        $area = $rock->getArea();
        $routes = $rock->getRoutes();

        $form = $this->createForm(RockType::class, $rock);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Fels wurde erfolgreich aktualisiert');

            return $this->redirectToRoute('rock_index');
        }

        return $this->render('rock/edit.html.twig', [
            'rock' => $rock,
            'area' => $area,
            'form' => $form->createView(),
            'areas' => $areaRepository->findAllAreasAlphabetical(),
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
