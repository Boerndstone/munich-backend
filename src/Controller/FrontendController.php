<?php

namespace App\Controller;

use App\Entity\Area;
use App\Entity\Rock;
use App\Entity\Contact;
use App\Service\FooterAreas;
use App\Form\ContactFormType;
use Doctrine\ORM\Mapping\Entity;
use App\Repository\AreaRepository;
use App\Repository\RockRepository;
use App\Repository\TopoRepository;
//use App\Form\RoutesAutocompleteField;
use App\Repository\PhotosRepository;
use App\Repository\RoutesRepository;
use App\Repository\VideosRepository;
use App\Repository\CommentRepository;
use Symfony\Component\Asset\Packages;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;


class FrontendController extends AbstractController
{
    // I have to define the static routes before the dynamic routes with $slug otherwise I get a 404 for the static routes!!!
    #[Route('/neuesteRouten', name: 'neuesteRouten')]
    public function neuesteRouten(
        AreaRepository $areaRepository,
        RoutesRepository $routesRepository,
        FooterAreas $footerAreas,
    ): Response {

        $areas = $footerAreas->getFooterAreas();

        $getDate = date("Y");
        $calculateDate = $getDate - 2;
        $latestRoutes = $routesRepository->latestRoutesPage($calculateDate);

        $sideBar = $areaRepository->sidebarNavigation();

        return $this->render('frontend/neuesteRouten.html.twig', [
            'areas' => $areas,
            'latestRoutes' => $latestRoutes,
            'sideBar' => $sideBar,
        ]);
    }

    #[Route('/Datenschutz', name: 'datenschutz')]
    public function datenschutz(
        AreaRepository $areaRepository,
        FooterAreas $footerAreas,
    ): Response {
        $areas = $footerAreas->getFooterAreas();
        $sideBar = $areaRepository->sidebarNavigation();

        return $this->render('frontend/datenschutz.html.twig', [
            'areas' => $areas,
            'sideBar' => $sideBar,
        ]);
    }

    #[Route('/Impressum', name: 'impressum')]
    public function impressum(
        AreaRepository $areaRepository,
        FooterAreas $footerAreas,
        Request $request,
        EntityManagerInterface $entityManager,
        MailerInterface $mailer
    ): Response {
        $areas = $footerAreas->getFooterAreas();
        $sideBar = $areaRepository->sidebarNavigation();

        $form = $this->createForm(ContactFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                /** @var Contact $contact */
                $contact = $form->getData();

                $entityManager->persist($contact);
                $entityManager->flush();

                // Prepare and send the email
                $email = (new TemplatedEmail())
                    ->from($contact->getEmail()) // Sender's email
                    ->to('admin@munichclimbs.de') // Recipient's email
                    ->subject('Kontaktformular munichclimbs. Betreff:' . $contact->getSubject())
                    ->htmlTemplate('emails/contact.html.twig')
                    ->context([
                        'name' => $contact->getName(),
                        'emailAdress' => $contact->getEmail(),
                        'subject' => $contact->getSubject(),
                        'comment' => $contact->getComment(),
                    ]);

                $mailer->send($email);
                $this->addFlash('success', 'Ihre Nachricht wurde erfolgreich versendet!');

                return $this->redirectToRoute('impressum');
            } else {
                // This block now only executes if the form is submitted but not valid
                $this->addFlash('error', 'Ihre Nachricht konnte nicht versendet werden!');
            }
        }

        return $this->render('frontend/impressum.html.twig', [
            'areas' => $areas,
            'sideBar' => $sideBar,
            'contactForm' => $form->createView(),
        ]);
    }

    #[Route('/Database', name: 'databasequeries')]
    public function databasequeries(
        AreaRepository $areaRepository,
        RockRepository $rockRepository,
    ): Response {

        $dummyData = $areaRepository->sidebarNavigation();

        return $this->render('frontend/database-queries.html.twig', [
            'dummyData' => $dummyData,
        ]);
    }

    #[Route('/', name: 'index')]
    public function index(
        AreaRepository $areaRepository,
        RockRepository $rockRepository,
        RoutesRepository $routesRepository,
        CommentRepository $commentRepository,
        Request $request
    ): Response {

        $latestRoutes = $routesRepository->latestRoutes();
        $latestComments = $commentRepository->latestComments();
        $banned = $rockRepository->saisonalGesperrt();
        $areas = $areaRepository->getAreasInformation();
        $sideBar = $areaRepository->sidebarNavigation();
        $searchTerm = $request->query->get('q');
        $searchRoutes = $areaRepository->search($searchTerm);
        //dd($searchRoutes);

        return $this->render('frontend/index.html.twig', [
            'areas' => $areas,
            'latestRoutes' => $latestRoutes,
            'latestComments' => $latestComments,
            'banned' => $banned,
            'sideBar' => $sideBar,
        ]);
    }

    #[Route('/{slug}', name: 'show_rocks')]
    public function showRocksArea(
        AreaRepository $areaRepository,
        RockRepository $rockRepository,
        Area $area,
        string $slug,
        FooterAreas $footerAreas
    ): Response {

        $areas = $footerAreas->getFooterAreas();
        $areaName = $area->getName();
        $areaSlug = $area->getSlug();
        $areaLat = $area->getLat();
        $areaLng = $area->getLng();
        $areaZoom = $area->getZoom();
        $areaImage = $area->getHeaderImage();

        $sideBar = $areaRepository->sidebarNavigation();
        $rocks = $rockRepository->getRocksInformation($slug);


        return $this->render('frontend/rocks.html.twig', [
            'areas' => $areas,
            'areaName' => $areaName,
            'areaSlug' => $areaSlug,
            'areaLat' => $areaLat,
            'areaLng' => $areaLng,
            'areaZoom' => $areaZoom,
            'areaImage' => $areaImage,
            'rocks' => $rocks,
            'sideBar' => $sideBar,
        ]);
    }

    #[Route('/{areaSlug}/{slug}', name: 'show_rock')]
    public function showRock(
        AreaRepository $areaRepository,
        RoutesRepository $routesRepository,
        RockRepository $rockRepository,
        TopoRepository $topoRepository,
        PhotosRepository $photosRepository,
        Rock $rock,
        $areaSlug,
        $slug,
        FooterAreas $footerAreas,
        Packages $assetPackages
    ): Response {

        $rockId = $rockRepository->getRockId($slug);

        $topos = $topoRepository->getTopos($rockId);

        $rockName = $rock->getSlug();
        $areaName = $rock->getArea();

        $rockDescription = $rock->getDescription();

        $rocks = $rockRepository->getRockInformation($slug);
        $routes = $rockRepository->getRoutesTopo($slug);
        $comments = $rockRepository->getCommentsForRoutes($slug);

        foreach ($routes as &$route) {
            $route['routeComment'] = [];
            foreach ($comments as $comment) {
                if ($comment['routeId'] === $route['routeId']) {
                    $route['routeComment'][]
                        = [
                            'comment' => $comment['routeComment'],
                            'username' => $comment['username'],
                            'date' => $comment['date'],
                        ];
                }
            }
        }


        $galleryItems = $photosRepository->findPhotosForRock($rockId);

        // Serialize data to JSON format
        $jsonData = [];
        foreach ($galleryItems as $item) {
            $extension = pathinfo($item->getName(), PATHINFO_EXTENSION);
            $filenameWithoutExtension = pathinfo($item->getName(), PATHINFO_FILENAME);
            $newName = $filenameWithoutExtension . "@2x." . $extension;
            $thumbName = $filenameWithoutExtension . "_thumb." . $extension;
            $jsonData[] = [
                'src' =>
                $assetPackages->getUrl('https://www.munichclimbs.de/uploads/galerie/' . $item->getName()),
                'subHtml' => $item->getDescription(),
                'srcset' => 'https://www.munichclimbs.de/uploads/galerie/' . $newName,
                'thumb' => 'https://www.munichclimbs.de/uploads/galerie/' . $thumbName
            ];
        }

        $sideBar = $areaRepository->sidebarNavigation();

        $areas = $footerAreas->getFooterAreas();

        return $this->render('frontend/rock.html.twig', [
            'areaName' => $areaName,
            'areas' => $areas,
            'slug' => $slug,
            'areaSlug' => $areaSlug,
            'rocks' => $rocks,
            'rockName' => $rockName,
            'rockDescription,' => $rockDescription,
            'routes' => $routes,
            'routesRepository' => $routesRepository,
            'topos' => $topos,
            'sideBar' => $sideBar,
            'jsonData' => $jsonData
        ]);
    }
}
