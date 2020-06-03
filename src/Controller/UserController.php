<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Form\UserFormType;
use App\Entity\User;
use App\Security\AppCustomAuthenticator;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class UserController extends AbstractController
{
    /**
     * @Route("/register", name="register")
     */
    public function post_user(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, AppCustomAuthenticator $authenticator, AuthenticationUtils $authenticationUtils):Response
    {	
    	$user = new User();
        $user_form = $this->createForm(UserFormType::class, $user);
        $user_form->handleRequest($request);

        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        if($user_form->isSubmitted()) {

        		$user->setPassword($passwordEncoder->encodePassword($user,$user_form->get('password')->getData()));

                /** @var File $file */
                $file=$user_form['image']->getData();
                if($file){
                $fileName=$this->generateUniqueFileName().".". $file->guessExtension();
                try{

                    $file->move($this->getParameter('images_directory'),$fileName);
                } catch( FileException $e){
                    //
                }
                $user->setImage($fileName);
            }


                
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();

                return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
                return $this->redirectToRoute('frontend_index');
        }

        return $this->render('frontend/login.html.twig', [

        	'user_form'=> $user_form->createView(),
        	'last_username' => $lastUsername,
      		'error' => $error]);
    }



     /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            $user=$this->getUser();
            if($user->getRoles()[0]=="ROLE_ADMIN")
                return $this->redirectToRoute('backend_index');
            else
                return $this->redirectToRoute('frontend_index');}

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('frontend/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
    }

    /**
     * @Route("/admin/users", name="backend_user")
     */
    public function get_user(UserRepository $userRepository):Response
    {

        return $this->render('backend/user.html.twig',[

            'users'=>$userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin/user/delete/{id}", name="backend_user_delete")
     */
    public function post_user_delete(Request $request, User $user): Response
    {   
        $token= $request->request->get('delete_token');

        if($this->isCsrfTokenValid('delete_user',$token)) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('backend_user');
    }

    /**
     * @Route("/admin/user/edit/{id}", name="backend_user_edit")
     */
    public function post_user_edit(Request $request, User $user, UserRepository $userRepository): Response
    {   

        $user_edit_form = $this->createForm(UserFormType::class, $user);
        $user_edit_form->handleRequest($request);
        if($user_edit_form->isSubmitted()){

            /** @var File $file */
            $file=$user_edit_form['image']->getData();
            if($file){

                $fileName=$this->generateUniqueFileName().'.'. $file->guessExtension();
                try{

                    $file->move($this->getParameter('images_directory'),$fileName);
                } catch( FileException $e){
                    //
                }
                $user->setImage($fileName);
            }


            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('backend_user');
        }

        return $this->render('backend/user_edit.html.twig', [
            
            'user_info'=> $userRepository->findById($user),    
            'user_edit_form' => $user_edit_form->createView(),
        ]);
    }

    /**
     * @Route("/admin/user/add", name="backend_user_add", methods={"GET","POST"})
     */
    public function post_new_user(Request $request, UserRepository $userRepository, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new User();
        $user_add_form = $this->createForm(UserFormType::class, $user);
        $user_add_form->handleRequest($request);

        if($user_add_form->isSubmitted()) {


                $user->setPassword($passwordEncoder->encodePassword($user,$user_add_form->get('password')->getData()));
                /** @var File $file */
                $file=$user_add_form['image']->getData();
                if($file){
                $fileName=$this->generateUniqueFileName().".". $file->guessExtension();
                try{

                    $file->move($this->getParameter('images_directory'),$fileName);
                } catch( FileException $e){
                    //
                }
                $user->setImage($fileName);
            }


                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();
                return $this->redirectToRoute('backend_user');
        }

        return $this->render('backend/user_add.html.twig', [
            
            'user_add_form' => $user_add_form->createView()
        ]);
    }

    /**
     * @Route("/profile", name="frontend_profile")
     */
    public function get_profile():Response
    {

        return $this->render('frontend/profile.html.twig');
    }

    /**
     * @Route("/profile/edit/{id}", name="frontend_profile_edit")
     */
    public function post_profile(Request $request,$id, User $user, UserPasswordEncoderInterface $passwordEncoder):Response
    {

        $user=$this->getUser();
        if($user->getId()!=$id){
            
            return $this->redirectToRoute('frontend_profile');
        }

        $profileForm = $this->createForm(UserFormType::class, $user);
        $profileForm->handleRequest($request);
        $token= $request->request->get('update_token');

        if($profileForm->isSubmitted()){

            $user->setPassword($passwordEncoder->encodePassword($user,$profileForm->get('password')->getData()));

            /** @var File $file */
            $file=$profileForm['image']->getData();
            if($file){

                $fileName=$this->generateUniqueFileName().'.'. $file->guessExtension();
                try{

                    $file->move($this->getParameter('images_directory'),$fileName);
                } catch( FileException $e){
                    //
                }
                $user->setImage($fileName);
            }


            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('frontend_profile');
        }
        
        return $this->render('frontend/profile_edit.html.twig', [
            'profileform' => $profileForm->createView(),
        ]);
    }

    /**
     * @Route("/login/admin", name="admin_login")
     */
    public function admin_login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {

            return $this->redirectToRoute('backend_index');}

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('frontend/admin_login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }


    /**
    *@return string
    */
    private function generateUniqueFileName(){

        return md5(uniqid());
    }


}
