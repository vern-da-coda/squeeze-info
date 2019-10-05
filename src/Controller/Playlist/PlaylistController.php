<?php

namespace App\Controller\Playlist;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\MimeType\FileinfoMimeTypeGuesser;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;

/**
 * PlaylistController
 */
class PlaylistController extends AbstractController
{
    /**
     * @Route(path="/", name="playlist", methods={"GET"})
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request): Response
    {
        // You only need to provide the path to your static file
        // $filepath = 'path/to/TextFile.txt';

        // i.e Sending a file from the resources folder in /web
        // in this example, the TextFile.txt needs to exist in the server
        $publicResourcesFolderPath = $this->get('kernel')->getProjectDir() . '/../web/public-resources/';
        $filename = "TextFile.txt";

        // This should return the file to the browser as response
        $response = new BinaryFileResponse($publicResourcesFolderPath . $filename);

        // To generate a file download, you need the mimetype of the file
        $mimeTypeGuesser = new FileinfoMimeTypeGuesser();

        // Set the mimetype with the guesser or manually
        if ($mimeTypeGuesser->isSupported())
        {
            // Guess the mimetype of the file according to the extension of the file
            $response->headers->set(
                'Content-Type',
                $mimeTypeGuesser->guess($publicResourcesFolderPath . $filename)
            );
        }
        else
        {
            // Set the mimetype of the file manually, in this case for a text file is text/plain
            $response->headers->set(
                'Content-Type',
                'text/plain'
            );
        }

        // Set content disposition inline of the file
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_INLINE,
            $filename
        );

        return $response;
    }
}
