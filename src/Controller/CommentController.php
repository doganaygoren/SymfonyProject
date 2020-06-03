<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\CommentRepository;
use App\Entity\Comment;
use App\Form\CommentFormType;
use App\Repository\ActivityRepository;

class CommentController extends AbstractController
{
    /**
     * @Route("/admin/comment", name="backend_comment")
     */
    public function get_comment(CommentRepository $commentRepository):Response
    {
        return $this->render('backend/comment.html.twig', [
            'comment_list'=>$commentRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin/comment/detail/{id}", name="backend_comment_detail")
     */
    public function get_comment_detail(CommentRepository $commentRepository,$id):Response
    {
        return $this->render('backend/comment_detail.html.twig', [
            //'comment_detail'=>$commentRepository->findBy(['id'=>$id]),
            'comment_detail'=>$commentRepository->getAllComments2($id),
        ]);
    }

    /**
     * @Route("/admin/comment/delete/{id}", name="backend_comment_delete")
     */
    public function post_category_delete(Request $request, Comment $comment): Response
    {   
        $token= $request->request->get('delete_token');

        if($this->isCsrfTokenValid('delete_comment',$token)) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($comment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('backend_comment');
    }


    /**
     * @Route("/admin/comment/edit/{id}", name="backend_comment_edit")
     */
    public function post_comment_edit(Request $request, Comment $comment, CommentRepository $commentRepository): Response
    {   

        
        $comment_edit_form = $this->createForm(CommentFormType::class, $comment);
        $comment_edit_form->handleRequest($request);
        if($comment_edit_form->isSubmitted()){

            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('backend_comment');
        }

        return $this->render('backend/comment_edit.html.twig', [
        	
        	'comment_info'=> $commentRepository->findById($comment),    
        	'comment_edit_form' => $comment_edit_form->createView(),
        ]);
    }


	/**
     * @Route("/profile", name="frontend_comment")
     */
    public function get_profile_comment(CommentRepository $commentRepository, ActivityRepository $activityRepository):Response
    {	
    	$user=$this->getUser();
        $id=$user->getId();

        return $this->render('frontend/profile.html.twig', [
            'comment_list'=>$commentRepository->findBy(['userid'=>$id]),
            'activities' => $activityRepository->findBy(['userid'=>$id]),
        ]);
    }

	/**
     * @Route("/profile/comment/delete/{id}", name="frontend_comment_delete")
     */
    public function post_user_comment_delete(Request $request, Comment $comment): Response
    {   

        $token= $request->request->get('delete_token');

        if($this->isCsrfTokenValid('delete_comment',$token)) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($comment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('frontend_profile');
    }

    /**
     * @Route("/profile/comment/edit/{id}", name="frontend_comment_edit")
     */
    public function post_user_comment_edit($id,Request $request, Comment $comment, CommentRepository $commentRepository): Response
    {   
        
        $comment_edit_form = $this->createForm(CommentFormType::class, $comment);
        $comment_edit_form->handleRequest($request);
        if($comment_edit_form->isSubmitted()){

            $user=$this->getUser();
            $comment->setUserId($user->getId());

            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('frontend_profile');
        }

        return $this->render('frontend/user_comment_edit.html.twig', [
        	
        	'comment_info'=> $commentRepository->findById($comment),    
            'comment_edit_form' => $comment_edit_form->createView(),
        ]);
    }

    /**
     * @Route("/profile/comment/detail/{id}", name="frontend_comment_detail")
     */
    public function get_user_comment_detail(CommentRepository $commentRepository,$id)
    {   

        return $this->render('frontend/user_comment_detail.html.twig',[

            'comment_detail' => $commentRepository->findBy(['id'=>$id]),
        ]);
    }



}
