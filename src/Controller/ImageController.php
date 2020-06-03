<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ActivityRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Form\ImageFormType;
use App\Entity\Activity;
use App\Entity\Image;
use App\Repository\ImageRepository;

class ImageController extends AbstractController
{

    /**
     * @Route("/admin/image/{id}", name="backend_image_add")
     */
    public function post_image(Request $request, ImageRepository $imageRepository, $id): Response
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
            

    		return $this->redirectToRoute('backend_image_add', ['id'=>$id]);
    	}

    	$image_list=$imageRepository->findBy(['activity'=>$id]);

    	return $this->render('backend/image_gallery.html.twig',[

    		'image'=>$image,
    		'image_list'=>$image_list,
    		'id'=>$id,
    		'image_add_form'=>$image_add_form->createView(),
    	]);

    }

    /**
     * @Route("/admin/image/{id}/{delId}", name="backend_image_delete")
     */
    public function post_activity_delete(Request $request,Image $image,$delId): Response
    {   

        $token= $request->request->get('delete_token');
        
        if($this->isCsrfTokenValid('delete_image'.$image->getId(),$token)) {
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($image);
            $entityManager->flush();
        }

        return $this->redirectToRoute('backend_image_add', ['id'=>$delId]);
    }

    /**
    * @return string
    */
    private function generateUniqueFileName(){

    	return md5(uniqid());
    }

}
