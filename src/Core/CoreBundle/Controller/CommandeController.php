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
        $session = $request->getSession();
        $listOrderLine=$session->get('panier');

        $valideCommande=false;
        $ptsFideleCommande=0;
        $currentuser= $this->getUser();
        $orderclient = new OrderClient();
    	$em = $this->getDoctrine()->getManager();
	    $total=$this->container->get('panier')->total($listOrderLine);
        $payCards= new PayCards();
        $form = $this->createForm(PayCardsType::class,$payCards);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $orderclient->setUsers($currentuser);
            $orderclient ->setDatePurchase(new \DateTime('NOW'));
            $orderclient->setTotal($total);
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
            //email
            $message = \Swift_Message::newInstance()
            ->setSubject('Récapitulatif de commande Meal & Box')
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
            return $this->redirectToRoute('historyCommande',array('id'=>$orderclient->getId()));
        }
        return $this->render('CoreCoreBundle:Commande:commandelayout.html.twig',array('listOrderLine'=>$listOrderLine,'form'=>$form->createView(),'valideCommande'=>$valideCommande ,'totalCommande'=>$total,'ptsFideleCommande'=>$ptsFideleCommande,'orderclient'=>$orderclient,'total'=>$total));
    }

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
    public function historyAction($id){

        $em = $this->getDoctrine()->getManager();
        $order=$em->getRepository('CoreCoreBundle:OrderClient')->findOneById($id);

        return $this->render('CoreCoreBundle:Commande:commandehistorylayout.html.twig',array('order'=>$order));

    }

}
