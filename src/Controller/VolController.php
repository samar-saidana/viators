<?php

namespace App\Controller;

use App\Repository\DestinationRepository;
use App\Repository\VolllRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Volll;
use App\Form\FormulaireType;
use Symfony\Component\HttpFoundation\Request;





class VolController extends AbstractController
{
    /**
     * @Route("/Vol", name="Vol")
     */
    public function index(): Response
    {
        return $this->render('Vol/aff.html.twig', [
            'controller_name' => 'VolController',
        ]);
    }


    /**
     *@Route("addv", name="addv")
     */
    public function add(Request $request)
    {$c=new Volll();
        $form=$this->createForm(FormulaireType::class,$c);
        $form->add('Ajouter',SubmitType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();

            $em->persist($c);
            $em->flush();

            return $this->redirectToRoute('list');
        }
        return $this->render("Vol/index.html.twig",["form"=>$form->createView()]);
    }
    /**
     *@Route("list", name="list")
     */
    public function list():Response
    {
        $vol = $this->getDoctrine()
            ->getRepository(Volll::class)
            ->findAll();
        return $this->render('Vol/list.html.twig', ["vol" => $vol]);

    }


    /**
     *@Route("lis", name="lis")
     */
    public function lis():Response
    {
        $vol = $this->getDoctrine()
            ->getRepository(Volll::class)
            ->findAll();
        return $this->render('Vol/aff.html.twig', ["vol" => $vol]);

    }
    /**
     *@Route("wishlist", name="wishlist")
     */
    public function wishlist():Response
    {
        $vol = $this->getDoctrine()
            ->getRepository(Volll::class)
            ->findAll();
        return $this->render('Vol/aff.html.twig', ["vol" => $vol]);

    }
    /**
     * @Route("recherche",name="recherche")
     */
    public function Recherche(VolllRepository $repository, Request  $request){
        $data=$request->get('search');
        $k=$repository->findBy(['prixvolll'=>$data]);
        return $this->render('Vol/aff.html.twig',['k'=>$k]);

    }

    /**
     * @param $id
     * @return Response
     * @Route("/deletec/{id}", name="delete")
     */
    public function delete($id):Response
    {
        $c=$this->getDoctrine()->getRepository(Volll::class)
            ->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($c);
        $em->flush();
        return $this->redirectToRoute("list");
    }

    /**
     * @Route("update/{id}", name="update")
     */
    public function update(Request $request,$id)
    {
        $c=$this->getDoctrine()->getRepository(Volll::class)
            ->find($id);
        $form=$this->createForm(FormulaireType::class,$c);
        $form->add("Modifier",SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($c);
            $em->flush();

            return $this->redirectToRoute('list');
        }
        return $this->render("Vol/update.html.twig",["form"=>$form->createView()]);

    }


}
