<?php

namespace App\Controller;
use App\Model\WeatherModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(): Response
    {
        $citiesWeather = WeatherModel::getWeatherData();
        return $this->render('main/home.html.twig', [
            'citiesWeather' => $citiesWeather
        ]);
    }

 /**
     * @Route("/mountain", name="mountain")
     */
    public function mountain(): Response
    {
        $citiesWeather = WeatherModel::getWeatherData();
        return $this->render('main/mountain.html.twig', [
            'citiesWeather' => $citiesWeather
        ]);
    }
    /**
     * @Route("/beaches", name="beaches")
     */
    public function beaches(): Response
    {
        $citiesWeather = WeatherModel::getWeatherData();
        return $this->render('main/beaches.html.twig', [
            'citiesWeather' => $citiesWeather
        ]);
    }







}
