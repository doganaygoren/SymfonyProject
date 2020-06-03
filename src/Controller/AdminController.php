<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Form\MessageFormType;
use App\Entity\Message;
use App\Repository\MessageRepository;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="backend_index")
     */
    public function get_index()
    {
        return $this->render('backend/index.html.twig');
    }

    /**
     * @Route("/admin/messages", name="backend_message")
     */
    public function get_messages(Request $request, MessageRepository $messageRepository):Response
    {
        return $this->render('backend/messages.html.twig', [

        	'messages'=>$messageRepository->findBy([],['id'=>'DESC']),
        ]);
    }

    /**
     * @Route("/admin/messages/detail/{id}", name="backend_message_detail")
     */
    public function get_message_detail($id,MessageRepository $messageRepository):Response
    {
        return $this->render('backend/message_detail.html.twig',[

        	'message_detail'=>$messageRepository->findBy(['id'=>$id]),
        ]);
    }

    /**
     * @Route("/admin/message/delete/{id}", name="backend_message_delete")
     */
    public function post_message_delete(Request $request, Message $message): Response
    {   
        $token= $request->request->get('delete_token');

        if($this->isCsrfTokenValid('delete_message',$token)) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($message);
            $entityManager->flush();
        }

        return $this->redirectToRoute('backend_message');
    }

    /**
     * @Route("/admin/message/edit/{id}", name="backend_message_edit")
     */
    public function post_message_edit(Request $request, Message $message, MessageRepository $messageRepository): Response
    {   

        $message_edit_form = $this->createForm(MessageFormType::class, $message);
        $message_edit_form->handleRequest($request);
        if($message_edit_form->isSubmitted()){

            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('backend_message');
        }

        return $this->render('backend/message_edit.html.twig', [
        	
        	'message_info'=> $messageRepository->findById($message),    
            'message_edit_form' => $message_edit_form->createView(),
        ]);
    }
}
