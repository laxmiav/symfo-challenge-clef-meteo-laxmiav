<?php

namespace App\Controller;

use App\Model\WeatherModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="homepage", methods={"GET"})
     */
    public function homepage(): Response
    {
        // préparation des données
        // selon l'énoncé on utilise cette méthode pour récupérer toutes les données
        $forecastList = WeatherModel::getWeatherData();

        return $this->render('main/homepage.html.twig', [
            'forecast_list' => $forecastList,
        ]);
    }

    /**
     * @Route("/meteo/montagne", name="mountain", methods={"GET"})
     */
    public function mountain(): Response
    {
        return $this->render('main/mountain.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/meteo/plage", name="beach", methods={"GET"})
     */
    public function beach(): Response
    {
        return $this->render('main/beach.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/widget/add/{cityId}", name="widget_add", methods={"GET"}, requirements={"cityId"="\d+"})
     */
    public function widgetAdd(int $cityId, SessionInterface $session): Response
    {
        // récupérer la ville à ajouter
        $cityInformation = WeatherModel::getWeatherByCityIndex($cityId);
        
        // gérer le cas ou la ville n'existe pas
        // et renvoyer une page 404
        if (is_null($cityInformation))
        {
            return $this->createNotFoundException('Cette ville n\'existe pas');
        }

        // écrire en session les informations de la ville
        $session->set('widget_city', $cityInformation);
        // si on veut lire cette valeur dans un controleur on utilise la méthode get
        // $session->get('widget_city', null]);

        // $_SESSION['widget_city'] = ;

        // rajouter un flash message

        // rediriger vers la page d'accueil
        return $this->redirectToRoute('homepage');
    }
}
