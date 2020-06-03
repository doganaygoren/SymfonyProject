<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\SettingsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\ActivityRepository;
use App\Repository\ImageRepository;
use App\Repository\AboutRepository;
use App\Repository\CommentRepository;
use App\Form\MessageFormType;
use App\Form\CommentFormType;
use App\Entity\Message;
use App\Entity\Comment;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Bridge\Google\Smtp\GmailTransport;


class HomeController extends AbstractController
{
    /**
     * @Route({"/home", "/index", "/"}, name="frontend_index")
     */
    public function get_index(SettingsRepository $settingsRepository, ActivityRepository $activityRepository): Response
    {	
    	$settings=$settingsRepository->findBy(['id'=>'1']);
        $slider_list=$activityRepository->findBy([],[],5);
        $sub_list=$activityRepository->findBy([],['id'=>'DESC'],15);

        return $this->render('frontend/index.html.twig', [

        	'settings'=>$settings,
            'slider_list'=>$slider_list,
            'sub_list'=>$sub_list,

        ]);
    }


    /**
     * @Route("/activity/{id}", name="home_activity")
     */
    public function get_home_activity(ActivityRepository $activityRepository,$id, ImageRepository $imageRepository, CommentRepository $commentRepository, Request $request )
    {   
        $comment = new Comment();
        $comment_add_form = $this->createForm(CommentFormType::class, $comment);
        $comment_add_form->handleRequest($request);

        if($comment_add_form->isSubmitted()) {

                $user=$this->getUser();
                $comment->setUserId($user->getId());
                $comment->setStatus("New");
                $comment->setIp($_SERVER['REMOTE_ADDR']);
                $comment->setActivityid($id);

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($comment);
                $entityManager->flush();
                return $this->redirectToRoute('home_activity', ['id'=>$id]);
        }

        $image_list=$imageRepository->findBy(['activity'=>$id]);

        return $this->render('frontend/home_activity.html.twig',[
            'comments'=>$commentRepository->findBy(['activityid'=>$id, 'status'=>'Active']),
            'user_comment'=>$commentRepository->findAllComments(),
            'activities' => $activityRepository->findBy(['id'=>$id]),
            'activity' => $activityRepository->findBy(['id'=>$id]),
            'image_list'=>$image_list,
        
        ]);
    }

    /**
     * @Route("/activity/image/{id}", name="home_activity_image")
     */
    public function post_user_image(Request $request, ImageRepository $imageRepository, $id): Response
    {    

        $image_list=$imageRepository->findBy(['activity'=>$id]);

        return $this->render('frontend/home_image_gallery.html.twig',[

            'image_list'=>$image_list,
        ]);
    }

    /**
     * @Route("/about", name="home_about")
     */
    public function get_about(AboutRepository $aboutRepository):Response
    {   

        return $this->render('frontend/about_us.html.twig',[
            'about' => $aboutRepository->findAll(),
        ]);
    }

    /**
     * @Route("/contact", name="home_contact")
     */
    public function get_contact(SettingsRepository $settingsRepository, Request $request):Response
    {   
        $message = new Message();
        $new_form = $this->createForm(MessageFormType::class, $message);
        $new_form->handleRequest($request);
        $setting=$settingsRepository->findAll();
        if($new_form->isSubmitted()) {

                $message->setStatus("New");
                $message->setIp($_SERVER['REMOTE_ADDR']);
                $this->addFlash('success',"Your message has been sent.");
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($message);
                $entityManager->flush();
                /*
                $email=( new Email())
                    ->from($setting[0]->getSmtpHost())
                    ->to($new_form['email']->getData())
                    ->subject('Activity Best Contact Request')
                    ->html("Dear ".$new_form['name']->getData()."<br>
                        <p> Your request has been sent to us and will be looked at as soon as possible </p><br>
                        <br>
                        Address : ".$setting[0]->getAddress()."<br>
                        Phone : ".$setting[0]->getPhone()."<br>"
                    );
                $transport=new GmailTransport($setting[0]->getSmtpUser(),$setting[0]->getSmtpPassword());
                $mailer=new Mailer($transport);
                $mailer->send($email);
                */
                return $this->redirectToRoute('home_contact');
        }


        return $this->render('frontend/contact.html.twig',[
            'settings' => $settingsRepository->findAll(),
            'new_form' => $new_form->createView(),
        ]);
    }

    /**
     * @Route("/activity", name="home_activity_list")
     */
    public function get_activity_list(ActivityRepository $activityRepository):Response
    {   

        return $this->render('frontend/activity_list.html.twig',[
            'activities' => $activityRepository->findAll(),
        ]);
    }


    /**
     * @Route("/asd", name="asd")
     */
    public function get_list(ActivityRepository $activityRepository):Response
    {   
        
        return $this->render('frontend/detail.html.twig',[
            
            'activities' => $activityRepository->findAll(),
            
        ]);
    }


}
