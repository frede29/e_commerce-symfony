<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Classe\Mail;
use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderSuccessController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager=$entityManager;
    }
    /**
     * @Route("/commande/merci/{stripeSessionId}", name="order_success")
     */
    public function index($stripeSessionId, Cart $cart)
    {
       $order=$this->entityManager->getRepository(Order::class)->findOneBystripeSessionId($stripeSessionId);
       if(!$order|| $order->getUser() != $this->getUser()){
           return $this->redirectToRoute('home');
       }

       if($order->getState()==0){

           $cart->remove();

           $order->setState(1);
           $this->entityManager->flush();

           $mail = new Mail();
           $content = "Bonjour".$order->getUser()->getFirstname()."<br/>Bienvenue sur Votre site E_commerce préféré";
           $mail->send($order->getUser()->getEmail(), $order->getUser()->getFirstname(), 'Votre commande a bien été validée', $content);
       }
       return $this->render('order_success/index.html.twig',[
           'order'=>$order
       ]);
    }
}
