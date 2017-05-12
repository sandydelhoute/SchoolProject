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
class CommandeController extends Controller
{
     public function commandeAction(Request $request)
    {
        $valideCommande=false;
        $total=0;
        $ptsFideleCommande=0;
    	$session = $request->getSession();
    	$em = $this->getDoctrine()->getManager();
		$listOrderLine=$session->get('panier');
		if($listOrderLine != null)
		foreach ($listOrderLine as $orderline) {
					$product= $em->getRepository('CoreCoreBundle:Product')->findOneById($orderline->getProduct()->getId());
				$orderline->setProduct($product);
		}
        $payCards= new PayCards();
        $form = $this->createForm(PayCardsType::class,$payCards);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $currentuser= $this->getUser();
            $orderclient = new OrderClient();
            $orderclient->setUsers($currentuser);
            $orderclient ->setDatePurchase(new \DateTime('NOW'));
            foreach ($listOrderLine as $key => $orderline  ) {
                $orderclient->addOrderLine($orderline);
                $orderline->setOrderClient($orderclient);
                $total += $total + $orderline->getQuantity() * $orderline->getProduct()->getPrix();
            }
        $ptsFideleCommande=round($total/10, 2);
        $valideCommande=true;
        $listOrderLine=array();
        $currentuser->setRewardPoints($currentuser->getRewardPoints()+$ptsFideleCommande);
        $currentuser->addOrder($orderclient);
        $em->persist($currentuser);
        $em->flush();

        }
        return $this->render('CoreCoreBundle:Commande:commandelayout.html.twig',array('listOrderLine'=>$listOrderLine,'form'=>$form->createView(),'valideCommande'=>$valideCommande ,'totalCommande'=>$total,'ptsFideleCommande'=>$ptsFideleCommande));
    }

    public function downloadResumeOrderAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $order= $em->getRepository('CoreCoreBundle:OrderClient')->findOneById($id);
        $html = $this->renderView(':pdf:invoice.html.twig',array('order'=>$order));
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


}
