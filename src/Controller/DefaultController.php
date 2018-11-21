<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Phpsed\Cache\Annotation\Cache;
use Vairogs\Utils\Core\Util\StreamResponse;
use Vairogs\Utils\Guzzle\GuzzleHttp\Client as Guzzle;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     * @Cache()
     */
    public function index(Guzzle $guzzle)
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController'
        ]);
    }
}
