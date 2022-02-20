<?php

namespace App\Controller;

use App\Model\WeatherModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(SessionInterface $session): Response
    {
        $citiesWeather = WeatherModel::getWeatherData();
        $currentCities = $session->get('cities_list', [0]);
       
        $addedCities = $currentCities[0];
        // var_dump($addedCities);
        // die();
        //$currentCities[$id] = $id;
        foreach ($currentCities as $newid) {
            $addedCities = WeatherModel::getWeatherByCityIndex($newid);
            //var_dump($addedCities);die();
        }
        //$cityweather[$addedCities]=
      
        return $this->render('main/home.html.twig', [
            'citiesWeather' => $citiesWeather,
           'cityweather'=>  $addedCities ,
        ]);
    }

    /**
        * @Route("/mountain", name="mountain")
        */
    public function mountain(SessionInterface $session): Response
    {
        $currentCities = $session->get('cities_list', [0]);
       
        $addedCities = $currentCities[0];
        // var_dump($addedCities);
        // die();
        //$currentCities[$id] = $id;
        foreach ($currentCities as $newid) {
            $addedCities = WeatherModel::getWeatherByCityIndex($newid);
            //var_dump($addedCities);die();
        }
        return $this->render('main/mountain.html.twig', [
            'cityweather'=>  $addedCities,
        ]);
    }
    /**
     * @Route("/beaches", name="beaches")
     */
    public function beaches(SessionInterface $session): Response
    {
        $currentCities = $session->get('cities_list', [0]);
       
        $addedCities = $currentCities[0];

        // var_dump($addedCities);
        // die();
        //$currentCities[$id] = $id;
        foreach ($currentCities as $newid) {
            $addedCities = WeatherModel::getWeatherByCityIndex($newid);
            //var_dump($addedCities);die();
        }
        return $this->render('main/beaches.html.twig', [
            'cityweather'=> $addedCities,
        ]);
    }



    // =================================================
    // ====================================================

    /**
     * @Route("/city_weather/{id}", name="city_weather")
     */
    public function show(int $id, SessionInterface $session,Request $request)
    {

  // récupérer le tableau qui est actuellement en session
        $currentCities = $session->get('cities_list', []);
        $currentCitiesids = [$id];
        //var_dump($currentCitiesids);die();
        $add = $session->set('cities_list', $currentCitiesids);
        //var_dump($add);die();
        $cityWeather = WeatherModel::getWeatherByCityIndex($id);
        //var_dump($cityWeather);
        //die();
        return $this->redirect($request->headers->get('referer'));
        return $this->render('main/city_weather.html.twig', [
            'cityweather' => $cityWeather
        ]);
    }
}
