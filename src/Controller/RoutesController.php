<?php

namespace App\Controller;

use App\Entity\Routes;
use App\Form\RoutesType;
use App\Repository\RoutesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/Route")
 */
class RoutesController extends AbstractController
{
    /**
     * @Route("/", name="routes_index", methods={"GET"})
     * @IsGranted("ROLE_USER")
     */
    public function index(RoutesRepository $RoutesRepository): Response
    {
        // One way to solve access control!!!!
        //$this->denyAccessUnlessGranted('ROLE_USER');

        return $this->render('routes/index.html.twig', [
            'routes' => $RoutesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="routes_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $routes = new Routes();
        $form = $this->createForm(RoutesType::class, $routes);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($routes);
            $entityManager->flush();

            return $this->redirectToRoute('routes_index');
        }

        return $this->render('Routes/new.html.twig', [
            'routes' => $routes,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="routes_show", methods={"GET"})
     */
    public function show(Routes $routes): Response
    {
        return $this->render('routes/show.html.twig', [
            'routes' => $routes,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="routes_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Routes $routes): Response
    {
        $form = $this->createForm(RoutesType::class, $routes);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoutes('routes_index');
        }

        return $this->render('routes/edit.html.twig', [
            'routes' => $routes,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="routes_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Routes $routes): Response
    {
        if ($this->isCsrfTokenValid('delete'.$routes->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($routes);
            $entityManager->flush();
        }

        return $this->redirectToRoutes('Routes_index');
    }
}
