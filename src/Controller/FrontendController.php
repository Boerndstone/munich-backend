<?php

namespace App\Controller;

use App\Entity\Area;
use App\Entity\Rock;
use App\Entity\Routes;

use App\Repository\AreaRepository;
use App\Repository\RockRepository;
use App\Repository\RoutesRepository;

use Symfony\Contracts\Cache\CacheInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontendController extends AbstractController
{
    /**
     * @Route("/", name="frontend")
     */
    public function index(): Response
    {

        //$areas = $areaRepository->findAll();

        $areas = $this->getDoctrine()->getRepository(Area::class)->getAreasFrontend();

        //dd($areas->getId());
        //$amount = $this->getDoctrine()->getRepository(Area::class)->getRocksLowerFiveteen($areas->getId());

        
        
        //$user = $this->getDoctrine()->getRepository(Area::class)->getId();

        //$rocks = $this->getDoctrine()->getRepository(Area::class)->getRocksAreasFrontend();
        //$routes = $this->getDoctrine()->getRepository(Area::class)->getRocksRoutesFrontend();

        //dd($areas);

        //print_r($areas->getRocks());

        //$amountRocks = $this->getDoctrine()->getRepository(Area::class)->countRoutesForArea($areas);

        //var_dump($amountRocks);die;

        return $this->render('frontend/index.html.twig', [
            'areas' => $areas,
            //'amount' => $amount
            //'amountRocks' => $amountRocks
            //'rocks' => $rocks,
            //'routes' => $routes,
        ]);
    }


    /**
     * @Route("/frontend/create-topo", name="create_topo")
     */
    public function create() : Response
    {
        return $this->render('frontend/create.topo.html.twig', []);
    }

    /**
     * @Route("/Klettergebiet/{slug}", name="show_rocks")
     */
    public function show($slug,  CacheInterface $cache, Request $request)
    {
        $areas = $this->getDoctrine()->getRepository(Area::class)->getAreasFrontend();
        $rocks = $this->getDoctrine()->getRepository(Rock::class)->findRocksArea($slug);

        //$areaName = $this->getDoctrine()->getRepository(Rock::class)->findRocksAreaName($slug);
        //$areaName = $area->getName();
        //$areaName = $rock->getArea();
        //dd($rocks);

        return $this->render('frontend/rocks.html.twig', [
            'areas' => $areas,
            'rocks' => $rocks,
            //'areaName' => $areaName,
        ]);
    }

     /**
     * @Route("/questions/{slug}", name="app_question_show")
     */
    /*public function show($slug, MarkdownParserInterface $markdownParser, CacheInterface $cache)
    {
        $answers = [
            'Answer 1',
            'Answer 2',
            'Answer 3'
        ];
        $questionText = 'I\'ve been turned into a cat, any thoughts on how to turn back? While I\'m **adorable**, I don\'t really care for cat food.';
        $parsedQuestionText = $cache->get('markdown_'.md5($questionText), function() use ($questionText, $markdownParser) {
            return $markdownParser->transformMarkdown($questionText);
        });

        // This creates an responde object
        return $this->render('question/show.html.twig', [

            'answers' => $answers,
            'question' => 'Servus',
            'questionText' => $parsedQuestionText

        ]);
    }*/
}




/**
     * @Route("/questions/{slug}", name="app_question_show")
     */