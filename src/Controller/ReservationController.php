<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\Volll;
use App\Form\FormulaireType;
use App\Form\ReservationType;
use App\Repository\ReservationRepository;
use Dompdf\Dompdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\DestinationRepository;
use App\Repository\VolllRepository;
use Symfony\Flex\Options;


class ReservationController extends AbstractController
{
    /**
     * @Route("/reservation", name="reservation")
     */
    public function index(): Response
    {
        return $this->render('reservation/index.html.twig', [
            'controller_name' => 'ReservationController',
        ]);
    }
    /**
     *@Route("reserver", name="reserver")
     */
    public function reserver(Request $request)
    {
        $c=new Reservation();
        $form=$this->createForm(ReservationType::class,$c);
        $form->add('Ajouter',SubmitType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();

            $em->persist($c);
            $em->flush();

            return $this->redirectToRoute('listes');
        }
        return $this->render("Vol/reserver.html.twig",["form"=>$form->createView()]);
    }

    /**
     *@Route("listes", name="listes")
     */
    public function listes():Response
    {
        $vol = $this->getDoctrine()
            ->getRepository(Reservation::class)
            ->findAll();
        return $this->render('reservation/listes.html.twig', ["vol" => $vol]);

    }
    /**
     *@Route("pdf/{id}", name="pdf",methods={"GET"})
     */
    public function pdf($id,ReservationRepository $repository)
    {
        $pdf = $repository->findAll();
        $pdfOptions=new Options();
        $pdfOptions->get('defaultFont','Arial');
        $dompdf=new Dompdf($pdfOptions);
        $html=$this->render('reservation/pdf.html.twig', ['pdf' => $pdf]);
        $dompdf->loadHtml($html);
    }



}
