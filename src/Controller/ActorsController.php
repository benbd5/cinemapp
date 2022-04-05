<?php

namespace App\Controller;

use App\Entity\Actors;
use App\Form\ActorsType;
use App\Repository\ActorsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/actors")
 */
class ActorsController extends AbstractController
{
    /**
     * @Route("/", name="app_actors_index", methods={"GET"})
     */
    public function index(ActorsRepository $actorsRepository): Response
    {
        return $this->render('actors/index.html.twig', [
            'actors' => $actorsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_actors_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $actor = new Actors();
        $form = $this->createForm(ActorsType::class, $actor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($actor);
            $entityManager->flush();

            return $this->redirectToRoute('app_actors_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('actors/new.html.twig', [
            'actor' => $actor,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_actors_show", methods={"GET"})
     */
    public function show(Actors $actor): Response
    {
        return $this->render('actors/show.html.twig', [
            'actor' => $actor,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_actors_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Actors $actor, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ActorsType::class, $actor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_actors_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('actors/edit.html.twig', [
            'actor' => $actor,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_actors_delete", methods={"POST"})
     */
    public function delete(Request $request, Actors $actor, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$actor->getId(), $request->request->get('_token'))) {
            $entityManager->remove($actor);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_actors_index', [], Response::HTTP_SEE_OTHER);
    }
}
