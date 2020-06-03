<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\SettingsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Form\SettingsFormType;
use App\Entity\Settings;

class SettingsController extends AbstractController
{
    /**
     * @Route("/admin/settings", name="backend_settings", methods={"GET","POST"})
     */

    
    //the first row creation code the rest is handled at update
    public function get_settings(SettingsRepository $settingsRepository, Request $request): Response
    {	
    	$setting = new Settings();
        $settingsForm = $this->createForm(SettingsFormType::class, $setting);
        $settingsForm->handleRequest($request);

        if ($settingsForm->isSubmitted()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($setting);
            $entityManager->flush();
            return $this->redirectToRoute('backend_settings');
        }

        return $this->render('backend/settings.html.twig', [
            'settings_list'=> $settingsRepository->findAll(),
            'setting' => $setting,
            'settings_form' => $settingsForm->createView(),
        ]);
    }

    /**
     * @Route("/admin/settings/{id}", name="backend_settings_update")
     */
    public function post_settings(Settings $setting, SettingsRepository $settingsRepository, Request $request): Response
    {   
        $settingsForm = $this->createForm(SettingsFormType::class, $setting);
        $settingsForm->handleRequest($request);
        $token= $request->request->get('update_token');

        if($this->isCsrfTokenValid('update_settings',$token)) {
            $entityManager = $this->getDoctrine()->getManager();
            //$entityManager->persist($setting);
            $entityManager->flush();
            return $this->redirectToRoute('backend_settings');
        }
        
        return $this->render('backend/settings.html.twig', [
            'settings_list'=> $settingsRepository->findAll(),
            'setting' => $setting,
            'settings_form' => $settingsForm->createView(),
        ]);
    }
}
