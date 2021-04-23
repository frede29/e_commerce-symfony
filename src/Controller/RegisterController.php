<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/register", name="register")
     */



    public function index(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $notification=null;
        $user=new User();
        $form=$this->createForm(RegisterType::class,$user);

        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()){
            $user=$form->getData();

            $search_email = $this->entityManager->getRepository(User::class)->findOneByEmail($user->getEmail());


            $password=$encoder->encodePassword($user,$user->getPassword());
            $user->setPassword($password);


            if (!$search_email) {
                $password = $encoder->encodePassword($user, $user->getPassword());

                $user->setPassword($password);
                $this->entityManager->persist($user);
                $this->entityManager->flush();

                $mail = new Mail();
                $content = "Bonjour".$user->getFirstname()."<br/>Bienvenue sur Votre site E_commerce préféré";
                $mail->send($user->getEmail(), $user->getFirstname(), 'Bienvenue sur Votre site E_commerce', $content);

                $notification = "Votre inscription s'est correctement déroulée. Vous pouvez dès a présent vous connecter a votre compte." ;

            } else {

                $notification = "l'email que vous avez renseigné existe déjà.";
            }



       }

        return $this->render('register/index.html.twig', [
            'form' => $form->createView(),
            'notification' => $notification
        ]);
    }
}
