<?php

namespace App\Controller\Screen\Markup\Temperature;

use App\Service\GardenaService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * IndoorController
 * @Route(path="/screen/markup/temperature", name="markup-temperature-")
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
     * @Route(path="/outdoor", name="outdoor", methods={"GET"})
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request): Response
    {
        $data = $this->gardenaService->getDevicesData();

        return $this->render(
            'temperature/outdoor/index.html.twig',
            [
                'soil' => $data['devices'][1]['abilities'][4]['properties'][0]['value'],
                'lawn' => $data['devices'][1]['abilities'][3]['properties'][0]['value'],
                'air'  => $data['devices'][2]['abilities'][4]['properties'][0]['value'],
            ]
        );
    }
}
