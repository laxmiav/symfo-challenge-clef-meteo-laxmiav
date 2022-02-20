<?php

namespace App\Controller;
use App\Model\WeatherModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(): Response
    {
        $citiesWeather = WeatherModel::getWeatherData();
        
      
        return $this->render('main/home.html.twig', [
            'citiesWeather' => $citiesWeather,
           'cityweather'=> [],
        ]);
    }

    /**
        * @Route("/mountain", name="mountain")
        */
    public function mountain(): Response
    {
        $citiesWeather = WeatherModel::getWeatherData();
        return $this->render('main/mountain.html.twig', [
            'citiesWeather' => $citiesWeather, 'cityweather'=> [],
        ]);
    }
    /**
     * @Route("/beaches", name="beaches")
     */
    public function beaches(): Response
    {
        $citiesWeather = WeatherModel::getWeatherData();
        return $this->render('main/beaches.html.twig', [
            'citiesWeather' => $citiesWeather, 'cityweather'=> [],
        ]);
    }



    // =================================================
    // ====================================================

    /**
     * @Route("/city_weather/{id}", name="city_weather")
     */
    public function show($id)
    {

    $cityWeather = WeatherModel::getWeatherByCityIndex($id);
       
        return $this->render('main/city_weather.html.twig', [
            'cityweather' => $cityWeather
        ]);
    }

}