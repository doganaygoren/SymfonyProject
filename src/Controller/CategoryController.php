<?php

namespace App\Controller;

use App\Form\CategoryFormType;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="backend_category", methods={"GET"})
     */
    public function get_category(CategoryRepository $categoryRepository): Response
    {

        $categories= $categoryRepository->findAll();

        return $this->render('backend/category.html.twig', [

            'categories'=> $categories

        ]);
    }

    /**
     * @Route("/category/add", name="backend_category_add", methods={"GET","POST"})
     */
    public function post_category(Request $request, CategoryRepository $categoryRepository): Response
    {
        $category = new Category();
        $category_add_form = $this->createForm(CategoryFormType::class, $category);
        $category_add_form->handleRequest($request);

        $category_list=$categoryRepository->findBy(['upper_category'=>'0']);

        if($category_add_form->isSubmitted()) {

                /** @var File $file */
                $file=$category_add_form['image']->getData();
                if($file){
                $fileName=$this->generateUniqueFileName().".". $file->guessExtension();
                try{

                    $file->move($this->getParameter('images_directory'),$fileName);
                } catch( FileException $e){
                    //
                }
                $category->setImage($fileName);
            }


                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($category);
                $entityManager->flush();
                return $this->redirectToRoute('backend_category');
        }

        return $this->render('backend/category_add.html.twig', [
            'category_list'=>$category_list,
            'category_add_form' => $category_add_form->createView()
        ]);
    }

    /**
     * @Route("/category/delete/{id}", name="backend_category_delete")
     */
    public function post_category_delete(Request $request, Category $category): Response
    {   
        $token= $request->request->get('delete_token');

        if($this->isCsrfTokenValid('delete_category',$token)) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($category);
            $entityManager->flush();
        }

        return $this->redirectToRoute('backend_category');
    }

    /**
    *@return string
    */
    private function generateUniqueFileName(){

        return md5(uniqid());
    }

}