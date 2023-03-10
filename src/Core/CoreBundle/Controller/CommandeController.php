<?php

namespace Core\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use Core\CoreBundle\Entity\PayCards;
use Core\CoreBundle\Form\PayCardsType;
use Core\CoreBundle\Entity\OrderClient;
use Core\CoreBundle\Entity\OrderLine;
use Symfony\Component\Validator\Constraints\DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class CommandeController extends Controller
{
     
    /**
     * @Security("has_role('ROLE_USER')")
     */
     public function commandeAction(Request $request)
    {
    if($this->getUser()->getRelais() == null )
        {
          return $this->redirectToRoute('relaispage');
        }
        $session = $request->getSession();
        $listOrderLine=$session->get('panier');
        if(is_null($listOrderLine))
            return $this->redirectToRoute('homepage');
        $valideCommande = false;
        $ptsFideleCommande = 0;
        $currentuser= $this->getUser();
        $orderclient = new OrderClient();
    	$em = $this->getDoctrine()->getManager();
        $listeRelais=$em->getRepository('CoreCoreBundle:Relais')->findAll();
	    $total=$this->container->get('panier')->total($listOrderLine);
        $afterCompte=round($currentuser->getCashBalance() - $total,2);
        $payCards= new PayCards();
        $form = $this->createForm(PayCardsType::class,$payCards);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $orderclient->setUsers($currentuser);
            $orderclient ->setDatePurchase(new \DateTime('NOW'));
            $orderclient->setTotal($total);
            $orderclient->setRelais($currentuser->getRelais());
            $payement=$em->getRepository('CoreCoreBundle:Payement')->findOneByType("carte bleu");
            $orderclient->setPayement($payement);
            $ptsFideleCommande=round($total/10, 2);
            $valideCommande=true;
            $currentuser->setRewardPoints($currentuser->getRewardPoints()+$ptsFideleCommande);
            $em->persist($currentuser);
            $em->persist($orderclient);
            foreach ($listOrderLine as $key=>$orderLine) {
                $orderLine->setOrderClient($orderclient);
                $em->merge($orderLine);
            }
            $em->flush();
            //suppresion du panier
            $this->container->get('session')->set('panier',null);

            //email
            $message = \Swift_Message::newInstance()
            ->setSubject('R??capitulatif de commande Meal & Box')
            ->setFrom($this->container->getParameter('mailer_user'))
            ->setTo($currentuser->getEmail())
            ->setBody(
              $this->renderView(
                ':Email:confirmcommande.html.twig',
                array('order' => $orderclient)
                ),
            'text/html'
            );  
            $this->get('mailer')->send($message);
             return $this->render('CoreCoreBundle:Commande:commandelayout.html.twig',array('listOrderLine'=>$listOrderLine,'form'=>$form->createView(),'valideCommande'=>$valideCommande ,'ptsFideleCommande'=>$ptsFideleCommande,'orderclient'=>$orderclient,'total'=>$total,'listeRelais'=>$listeRelais));
        }
        return $this->render('CoreCoreBundle:Commande:commandelayout.html.twig',array('listOrderLine'=>$listOrderLine,'form'=>$form->createView(),'valideCommande'=>$valideCommande ,'ptsFideleCommande'=>$ptsFideleCommande,'orderclient'=>$orderclient,'total'=>$total,'listeRelais'=>$listeRelais,'afterCompte'=>$afterCompte));
    }
    /**
     * @Security("has_role('ROLE_USER')")
     */
    public function commandeCompteAction(Request $request){
        if($this->getUser()->getRelais() == null )
        {
          return $this->redirectToRoute('relaispage');
        }
        $valideCommande=true;
        $em = $this->getDoctrine()->getManager();
        $listeRelais=$em->getRepository('CoreCoreBundle:Relais')->findAll();
        $currentuser= $this->getUser();
        $session = $request->getSession();
        $listOrderLine=$session->get('panier');
        if(is_null($listOrderLine))
            return $this->redirectToRoute('homepage');
        $total=$this->container->get('panier')->total($listOrderLine);
        $ptsFideleCommande=round($total/10, 2);
        $afterCompte=round($currentuser->getCashBalance() - $total,2);
        $currentuser->setRewardPoints($currentuser->getRewardPoints()+$ptsFideleCommande);
        $currentuser->setCashBalance($afterCompte);
        $orderclient = new OrderClient();
        $orderclient->setUsers($currentuser);
        $orderclient ->setDatePurchase(new \DateTime('NOW'));
        $orderclient->setTotal($total);
        $orderclient->setRelais($currentuser->getRelais());
        $payement=$em->getRepository('CoreCoreBundle:Payement')->findOneByType("mon compte");
        $orderclient->setPayement($payement);
        $em->persist($currentuser);
        $em->persist($orderclient);
        foreach($listOrderLine as $key=>$orderLine) {
            $orderLine->setOrderClient($orderclient);
            $em->merge($orderLine);
        }
        $em->flush();
        $this->container->get('session')->set('panier',null);
        $total=$this->container->get('panier')->total($listOrderLine);
        return $this->render('CoreCoreBundle:Commande:commandelayout.html.twig',array('listOrderLine'=>$listOrderLine,'valideCommande'=>$valideCommande ,'ptsFideleCommande'=>$ptsFideleCommande,'orderclient'=>$orderclient,'total'=>$total,'listeRelais'=>$listeRelais));
    }
    /**
     * @Security("has_role('ROLE_USER')")
     */
    public function downloadResumeOrderAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $order= $em->getRepository('CoreCoreBundle:OrderClient')->findOneById($id);
        $html = $this->renderView(':pdf:invoice.html.twig',array('order'=>$order,'users'=>$this->getUser()));
        $date=$order->getDatePurchase();
        $filename = sprintf('Commande-%s.pdf',$date->format('Y-m-d'));

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            [
                'Content-Type'        => 'application/pdf',
                'Content-Disposition' => sprintf('attachment; filename="%s"', $filename),
            ]
        );
    }
    /**
     * @Security("has_role('ROLE_USER')")
     */
    public function historyAction($id){

        $em = $this->getDoctrine()->getManager();
        $order=$em->getRepository('CoreCoreBundle:OrderClient')->findOneById($id);

        return $this->render('CoreCoreBundle:Commande:commandehistorylayout.html.twig',array('order'=>$order));

    }

}
