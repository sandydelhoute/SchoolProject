<?php

namespace Core\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use Core\CoreBundle\Entity\PayCards;
use Core\CoreBundle\Form\PayCardsType;
use Core\CoreBundle\Entity\OrderClient;
use Symfony\Component\Validator\Constraints\DateTime;
class CommandeController extends Controller
{
     public function commandeAction(Request $request)
    {
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
            foreach ($listOrderLine as $orderline) {
                $orderclient->addOrderLine($orderline);
                $orderline->setOrderClient($orderclient);
            }

        $currentuser->addOrder($orderclient);
        $em->persist($currentuser);
        $em->flush();
        }
        return $this->render('CoreCoreBundle:Commande:commandelayout.html.twig',array('listOrderLine'=>$listOrderLine,'form'=>$form->createView()));
    }

     public function downloadResumeOrderAction($id)
    {
        $html = $this->renderView(':pdf:invoice.html.twig');

        $filename = sprintf('test-%s.pdf', date('Y-m-d'));

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
