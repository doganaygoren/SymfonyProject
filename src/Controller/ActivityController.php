<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ActivityRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Form\ActivityFormType;
use App\Entity\Activity;

class ActivityController extends AbstractController
{
    /**
     * @Route("/admin/activity", name="backend_activity")
     */
    public function get_activity(ActivityRepository $activityRepository)
    {	

        return $this->render('backend/activity.html.twig',[

        	'activities' => $activityRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin/activity/add", name="backend_activity_add", methods={"GET","POST"})
     */
    public function post_activity(Request $request, ActivityRepository $activityRepository, CategoryRepository $categoryRepository): Response
    {
        $activity = new Activity();
        $activity_add_form = $this->createForm(ActivityFormType::class, $activity);
        $activity_add_form->handleRequest($request);

        if($activity_add_form->isSubmitted()) {

                /** @var File $file */
                $file=$activity_add_form['image']->getData();
                if($file){
                $fileName=$this->generateUniqueFileName().".". $file->guessExtension();
                try{

                    $file->move($this->getParameter('images_directory'),$fileName);
                } catch( FileException $e){
                    //
                }
                $activity->setImage($fileName);
            }

            $user=$this->getUser();
            $activity->setUserId($user->getId());


                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($activity);
                $entityManager->flush();
                return $this->redirectToRoute('backend_activity');
        }

        return $this->render('backend/activity_add.html.twig', [
            
        	'category_list'=> $categoryRepository->findAll(),
            'activity_add_form' => $activity_add_form->createView()
        ]);
    }

    /**
     * @Route("/admin/activity/delete/{id}", name="backend_activity_delete")
     */
    public function post_activity_delete(Request $request, Activity $activity): Response
    {   
        $token= $request->request->get('delete_token');

        if($this->isCsrfTokenValid('delete_activity',$token)) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($activity);
            $entityManager->flush();
        }

        return $this->redirectToRoute('backend_activity');
    }


    /**
     * @Route("/admin/activity/edit/{id}", name="backend_activity_edit")
     */
    public function post_category_edit(Request $request, Activity $activity, CategoryRepository $categoryRepository, ActivityRepository $activityRepository): Response
    {   

        $activity_edit_form = $this->createForm(ActivityFormType::class, $activity);
        $activity_edit_form->handleRequest($request);
        if($activity_edit_form->isSubmitted()){

            /** @var File $file */
            $file=$activity_edit_form['image']->getData();
            if($file){

                $fileName=$this->generateUniqueFileName().'.'. $file->guessExtension();
                try{

                    $file->move($this->getParameter('images_directory'),$fileName);
                } catch( FileException $e){
                    //
                }
                $activity->setImage($fileName);
            }


            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('backend_activity');
        }

        return $this->render('backend/activity_edit.html.twig', [
        	
        	'activity_info'=> $activityRepository->findById($activity),    
        	'category_list'=> $categoryRepository->findAll(),
            'activity_edit_form' => $activity_edit_form->createView(),
        ]);
    }

    /**
     * @Route("/admin/activity/detail/{id}", name="backend_activity_detail")
     */
    public function get_activity_detail(ActivityRepository $activityRepository,$id):Response
    {   

        return $this->render('backend/activity_detail.html.twig',[

            'activities' => $activityRepository->findBy(['id'=>$id]),
        ]);
    }


    /**
    *@return string
    */
    private function generateUniqueFileName(){

        return md5(uniqid());
    }
}
