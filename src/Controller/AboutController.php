<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AboutRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Form\AboutFormType;
use App\Entity\About;

class AboutController extends AbstractController
{
    /**
     * @Route("/admin/about", name="backend_about")
     */
    

    //the first row creation code the rest is handled at update
    public function get_about(AboutRepository $aboutRepository, Request $request): Response
    {	
    	$about = new About();
        $aboutForm = $this->createForm(AboutFormType::class, $about);
        $aboutForm->handleRequest($request);

        if ($aboutForm->isSubmitted()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($about);
            $entityManager->flush();
            return $this->redirectToRoute('backend_about');
        }

        return $this->render('backend/about_us.html.twig', [
            'about_list'=> $aboutRepository->findAll(),
            'about' => $about,
            'about_form' => $aboutForm->createView(),
        ]);
    }

    /**
     * @Route("/admin/about/{id}", name="backend_about_update")
     */
    public function post_about(About $about, AboutRepository $aboutRepository, Request $request): Response
    {   
        $aboutForm = $this->createForm(AboutFormType::class, $about);
        $aboutForm->handleRequest($request);
        $token= $request->request->get('update_token');

        if($this->isCsrfTokenValid('update_about',$token)) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            return $this->redirectToRoute('backend_about');
        }
        
        return $this->render('backend/about_us.html.twig', [
            'about_list'=> $aboutRepository->findAll(),
            'about' => $about,
            'about_form' => $aboutForm->createView(),
        ]);
    }
}
