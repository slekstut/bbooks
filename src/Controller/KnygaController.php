<?php

namespace App\Controller;

use App\Entity\Knyga;
use App\Form\KnygaType;
use App\Repository\KnygaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/knyga')]
final class KnygaController extends AbstractController
{
    #[Route(name: 'app_knyga_index', methods: ['GET'])]
    public function index(KnygaRepository $knygaRepository): Response
    {
        return $this->render('knyga/index.html.twig', [
            'knygos' => $knygaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_knyga_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $knyga = new Knyga();
        $form = $this->createForm(KnygaType::class, $knyga);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($knyga);
            $entityManager->flush();

            return $this->redirectToRoute('app_knyga_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('knyga/new.html.twig', [
            'knyga' => $knyga,
            'form' => $form->createView(),
            'action' => 'Create',
        ]);
    }

    #[Route('/{id}', name: 'app_knyga_show', methods: ['GET'])]
    public function show(Knyga $knyga): Response
    {
        return $this->render('knyga/show.html.twig', [
            'knyga' => $knyga,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_knyga_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Knyga $knyga, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(KnygaType::class, $knyga);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_knyga_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('knyga/edit.html.twig', [
            'knyga' => $knyga,
            'form' => $form->createView(),
            'action' => 'Edit',
        ]);
    }

    #[Route('/{id}', name: 'app_knyga_delete', methods: ['POST'])]
    public function delete(Request $request, Knyga $knyga, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $knyga->getId(), $request->request->get('_token'))) {
            $entityManager->remove($knyga);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_knyga_index', [], Response::HTTP_SEE_OTHER);
    }
}
