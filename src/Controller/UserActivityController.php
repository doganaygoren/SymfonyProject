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
use App\Form\ImageFormType;
use App\Entity\Image;
use App\Repository\ImageRepository;
use App\Repository\CommentRepository;

class UserActivityController extends AbstractController
{
    /**
     * @Route("/profile", name="frontend_activity")
     */
    public function get_user_activity(ActivityRepository $activityRepository,CommentRepository $commentRepository)
    {	

        $user=$this->getUser();
        $id=$user->getId();

        return $this->render('frontend/profile.html.twig',[

        	'activities' => $activityRepository->findBy(['userid'=>$id]),
            'comment_list'=>$commentRepository->findBy(['userid'=>$id]),
        ]);
    }

    /**
     * @Route("/profile/activity/add", name="frontend_activity_add", methods={"GET","POST"})
     */
    public function post_user_activity(Request $request, ActivityRepository $activityRepository, CategoryRepository $categoryRepository): Response
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
                $activity->setStatus("Inactive");

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($activity);
                $entityManager->flush();
                return $this->redirectToRoute('frontend_profile');
        }

        return $this->render('frontend/activity_add.html.twig', [
            
        	'category_list'=> $categoryRepository->findAll(),
            'activity_add_form' => $activity_add_form->createView()
        ]);
    }

    /**
     * @Route("/profile/activity/delete/{id}", name="frontend_activity_delete")
     */
    public function post_user_activity_delete(Request $request, Activity $activity): Response
    {   

        $token= $request->request->get('delete_token');

        if($this->isCsrfTokenValid('delete_activity',$token)) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($activity);
            $entityManager->flush();
        }

        return $this->redirectToRoute('frontend_activity');
    }


    /**
     * @Route("/profile/activity/edit/{id}", name="frontend_activity_edit")
     */
    public function post_user_activity_edit(Request $request, Activity $activity, CategoryRepository $categoryRepository, ActivityRepository $activityRepository): Response
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
            $user=$this->getUser();
            $activity->setUserId($user->getId());


            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('frontend_profile');
        }

        return $this->render('frontend/activity_edit.html.twig', [
        	
        	'activity_info'=> $activityRepository->findById($activity),    
        	'category_list'=> $categoryRepository->findAll(),
            'activity_edit_form' => $activity_edit_form->createView(),
        ]);
    }


    /**
     * @Route("/profile/image/{id}", name="frontend_image_add")
     */
    public function post_user_image(Request $request, ImageRepository $imageRepository, $id): Response
    {

    	$image=new Image();
    	$image_add_form=$this->createForm(ImageFormType::class, $image);
    	$image_add_form->handleRequest($request);

    	if($image_add_form->isSubmitted()){

    		/** @var File $file */
            $file=$image_add_form['image']->getData();
            if($file){
                
            	$fileName=$this->generateUniqueFileName().".". $file->guessExtension();

                try{

                    $file->move($this->getParameter('images_directory'),$fileName);
                } catch( FileException $e){
                    //
                }

                $image->setImage($fileName);
            }

    		$entityManager=$this->getDoctrine()->getManager();
    		$entityManager->persist($image);
    		$entityManager->flush();
            

    		return $this->redirectToRoute('frontend_image_add', ['id'=>$id]);
    	}

    	$image_list=$imageRepository->findBy(['activity'=>$id]);

    	return $this->render('frontend/image_gallery.html.twig',[

    		'image'=>$image,
    		'image_list'=>$image_list,
    		'id'=>$id,
    		'image_add_form'=>$image_add_form->createView(),
    	]);
    }

    /**
     * @Route("/profile/image/{id}/{delId}", name="frontend_image_delete")
     */
    public function post_user_image_delete(Request $request,Image $image,$delId): Response
    {   

        $token= $request->request->get('delete_token');
        
        if($this->isCsrfTokenValid('delete_image'.$image->getId(),$token)) {
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($image);
            $entityManager->flush();
        }

        return $this->redirectToRoute('frontend_image_add', ['id'=>$delId]);
    }

    /**
     * @Route("/profile/activity/detail/{id}", name="frontend_activity_detail")
     */
    public function get_user_activity_detail(ActivityRepository $activityRepository,$id)
    {   

        return $this->render('frontend/activity_detail.html.twig',[

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
