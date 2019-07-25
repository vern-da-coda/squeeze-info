<?php

namespace App\Controller\Screen\Temperature;

use App\Service\GardenaService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * IndoorController
 * @Route(path="/screen/temperature")
 */
class OutdoorController extends AbstractController
{
    /**
     * @var GardenaService
     */
    private $gardenaService;


    /**
     * @param GardenaService $gardenaService
     */
    public function __construct(GardenaService $gardenaService)
    {

        $this->gardenaService = $gardenaService;
    }

    /**
     * @Route(path="/outdoor", name="temperature-outdoor", methods={"GET"})
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request): Response
    {
        $this->gardenaService->getDeviceData();

        return $this->render(
            'temperature/outdoor/index.html.twig',
            [
                'soil' => 1,
                'lawn' => 2,
                'air'  => 3
            ]
        );
    }
}
