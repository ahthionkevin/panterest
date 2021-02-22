<?php

namespace App\Controller;

use App\Repository\PinRepository;
use App\Entity\Pin;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PinsController extends AbstractController
{
    /**
     * @Route("/", name="app_home",methods={"GET"})
     */
    public function index(PinRepository $pinRepository): Response
    {
        $pins=$pinRepository->findBy([],['createdAt'=>'DESC']);
        return $this->render('pins/index.html.twig', [
            'pins' => $pins,
        ]);
    }

    /**
     * @Route("/pins/{id<[0-9]+>}", name="app_pin_show",methods={"GET"})
     */
    public function show(Pin $pin): Response
    {
        $pin;
        return $this->render('pins/show.html.twig', [
            'pin' => $pin,
        ]);
    }

    /**
     * @Route("/pins/create", name="app_create_pin",methods={"GET","POST"})
     */
    public function create(Request $request,EntityManagerInterface $em): Response
    {
        $pin=new Pin;

        $form=$this->createFormBuilder($pin)
            ->add('Title',TextType::class)
            ->add('Description',TextareaType::class)
            ->getForm();

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) 
        { 
            $em->persist($pin);
            $em->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('pins/create.html.twig',['formulaire'=>$form->createView()]);
    }
}

    /**
     * @Route("/pins/{id<[0-9]+>}/edit", name="app_pin_edit",methods={"GET","POST"})
     */
    public function edit(int $id,Request $request,EntityManagerInterface $em): Response
    {
        $pin=new Pin;

        $form=$this->createFormBuilder($pin)
            ->add('Title',TextType::class)
            ->add('Description',TextareaType::class)
            ->getForm();

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) 
        { 
            $em->persist($pin);
            $em->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('pins/create.html.twig',['formulaire'=>$form->createView()]);
    }
}
