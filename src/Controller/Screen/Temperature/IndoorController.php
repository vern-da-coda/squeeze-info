<?php

namespace App\Controller\Screen\Temperature;

use App\Service\HueService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * IndoorController
 * @Route(path="/screen/temperature")
 */
class IndoorController extends AbstractController
{
    /**
     * @var HueService
     */
    private $hueService;


    /**
     * @param HueService $hueService
     */
    public function __construct(HueService $hueService)
    {

        $this->hueService = $hueService;
    }

    /**
     * @Route(path="/indoor", name="temperature-indoor", methods={"GET"})
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request): Response
    {
        return $this->render(
            'temperature/indoor/index.html.twig',
            [
                'first' => $this->hueService->getTemperatureOf1stFloor()/100,
                'second' => $this->hueService->getTemperatureOf2ndFloor()/100
            ]
        );
    }
}
