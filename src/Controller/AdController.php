<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Form\AdFormType;
use App\Repository\AdRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdController extends AbstractController
{
    /**
     * @Route("/ads", name="ad_index")
     */
    public function index(AdRepository $repo)
    {
        $ads= $repo->findAll();
        return $this->render('ad/index.html.twig', [
            'ads' => $ads,
        ]);
    }

    /**
     * Permet de créer une annonce
     * @Route("/ads/new", name="create_ads")
     *@return Response;
     */
    public function create(Request $request, ManagerRegistry $managerRegistry)
    {
        $ad = new Ad();
        $form=$this->createForm(AdFormType::class, $ad);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
            {
                $manage = $managerRegistry->getManager();
                $manage->persist($ad);
                $manage->flush();
                $this->redirectToRoute('single_ad',[
                'slug' => $ad->getSlug(),
            ]);
            }
         return $this->render('ad/new.html.twig',[
            'form'=> $form->createView()
        ]);
    }

    /**
     * Permet d'afficher une seule annonce
     * @Route("/ads/{slug}", name="single_ad")
     *@return Response;
     */

    public function show(Ad $singleAd)
    {
        return $this->render('ad/show.html.twig',[
            'singleAd'=> $singleAd,
        ]);
    }
}
