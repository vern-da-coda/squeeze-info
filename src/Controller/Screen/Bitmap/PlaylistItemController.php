<?php

namespace App\Controller\Screen\Bitmap;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;

/**
 * PlaylistItemController
 * @Route(path="/screen/bitmap")
 */
class PlaylistItemController
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @param RouterInterface $router
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * @Route(path="/", name="playlist-item", methods={"GET"})
     *
     */
    public function indexAction()
    {
        $routeCollection = $this->router->getRouteCollection();

        foreach ($routeCollection->all() as $key => $value)
        {
            $data = $value->getDefaults();
        }

        dd($routeCollection->all());
    }
}
