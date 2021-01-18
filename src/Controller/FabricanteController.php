<?php

namespace App\Controller;

use App\Entity\Fabricante;
use App\Form\FabricanteType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class FabricanteController
 * @package App\Controller
 *
 * @Route("/fabricante")
 */
class FabricanteController extends AbstractController
{
    /**
     * @Route("/list", name="fabricante_list")
     */
    public function index(EntityManagerInterface $entityManager): Response
    {

        $fabricanteRepository = $entityManager->getRepository('App\Entity\Fabricante');

        $fabricantes = $fabricanteRepository->findAll();

        return $this->render('fabricante/index.html.twig', ['fabricantes' => $fabricantes]);
    }

    /**
     * @return Response
     * @Route("{id}/show", name="fabricante_show")
     */
    public function show(Fabricante $fabricante): Response
    {
        return $this->render('fabricante/show.html.twig', [
            'fabricante' => $fabricante
        ]);
    }

    /**
     * @return Response
     * @Route("/{id}/edit", name="fabricante_edit")
     */
    public function edit(Request $request, $id/** Fabricante $fabricante */): Response
    {
        $em = $this->getDoctrine()->getManager();
        $fabricanteRepository = $em->getRepository(Fabricante::class);
        $fabricante = $fabricanteRepository->find($id);
        if (!$fabricante) {
            throw $this->createNotFoundException(
                'não há fabricante '.$id
            );
        }

        $form = $this->createForm(FabricanteType::class, $fabricante);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            return $this->redirectToRoute('fabricante_list');
        }

        return $this->render('fabricante/edit.html.twig', ['form' => $form->createView(), 'fabricante' => $fabricante]);
    }

    /**
     * @return Response
     * @Route("/create", name="fabricante_create")
     */
    public function create(Request $request): Response
    {

        $fabricante = new Fabricante();

        $form = $this->createForm(FabricanteType::class, $fabricante);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($fabricante);
            $entityManager->flush();

            return $this->redirectToRoute('fabricante_list');
        }

        return $this->render('fabricante/new.html.twig', ['form' => $form->createView(), 'fabricante' => $fabricante]);

    }

    /**
     * @return Response
     * @Route("/delete", name="fabricante_delete")
     */
    public function delete(): Response
    {

    }
}
