<?php

namespace App\Controller;

use Nesk\Puphpeteer\Puppeteer;
use Spatie\Browsershot\Browsershot;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * TestController
 */
class TestController extends AbstractController
{
    /**
     * @Route(path="/test", name="test", methods={"GET"})
     *
     * @param Request $request
     *
     * @return Response
     */
    public function test(Request $request): Response
    {

        Browsershot::url('https://symfonycasts.com/tracks/symfony')->save('example.png');

        return $this->json(
            [
                'done'
            ]
        );
    }
}
