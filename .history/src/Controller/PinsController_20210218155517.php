<?php

namespace App\Controller;

use App\Repository\PinRepository;
use App\Entity\Pin;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PinsController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(PinRepository $pinRepository): Response
    {
        $pins=$pinRepository->findAll();
        return $this->render('pins/index.html.twig', [
            'pins' => $pins,
        ]);
    }

    /**
     * @Route("/pins/{id<[0-9]+>}", name="app_pin_show")
     */
    public function show(Pin $pin): Response
    {
        $pins=$pinRepository->find();
        return $this->render('pins/index.html.twig', [
            'pins' => $pins,
        ]);
    }
}
