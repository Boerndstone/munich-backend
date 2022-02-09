<?php

namespace App\Controller;

use App\Entity\Routes;
use App\Form\RoutesType;
use App\Repository\AreaRepository;
use App\Repository\RoutesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @Route("/Route")
 */
class RoutesController extends AbstractController
{
    /**
     * @Route("/", name="routes_index", methods={"GET"})
     */
    public function index(RoutesRepository $RoutesRepository, AreaRepository $areaRepository): Response
    {
        // One way to solve access control!!!!
        //$this->denyAccessUnlessGranted('ROLE_USER');

        return $this->render('routes/index.html.twig', [
            'routes' => $RoutesRepository->findAll(),
            'areas' => $areaRepository->findAllAreasAlphabetical(),
        ]);
    }

    /**
     * @Route("/new", name="routes_new", methods={"GET","POST"})
     */
    public function new(ManagerRegistry $doctrine, Request $request, AreaRepository $areaRepository): Response
    {
        $routes = new Routes();
        $form = $this->createForm(RoutesType::class, $routes);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($routes);
            $entityManager->flush();

            return $this->redirectToRoute('routes_index');
        }

        return $this->render('Routes/new.html.twig', [
            'routes' => $routes,
            'form' => $form->createView(),
            'areas' => $areaRepository->findAllAreasAlphabetical(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="routes_edit", methods={"GET","POST"})
     */
    public function edit(ManagerRegistry $doctrine, Request $request, Routes $routes, AreaRepository $areaRepository): Response
    {
        $form = $this->createForm(RoutesType::class, $routes);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $doctrine->getManager()->flush();

            return $this->redirect($request->request->get('referer'));
        }

        return $this->render('routes/edit.html.twig', [
            'routes' => $routes,
            'form' => $form->createView(),
            'areas' => $areaRepository->findAllAreasAlphabetical(),
        ]);
    }

    /**
     * @Route("/{id}", name="routes_delete", methods={"DELETE"})
     */
    public function delete(ManagerRegistry $doctrine, Request $request, Routes $routes): Response
    {
        if ($this->isCsrfTokenValid('delete'.$routes->getId(), $request->request->get('_token'))) {
            $entityManager = $doctrine->getManager();
            $entityManager->remove($routes);
            $entityManager->flush();
        }

        return $this->redirectToRoute('rock_index');
    }
}
