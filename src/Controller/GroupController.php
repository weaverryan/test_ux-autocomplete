<?php

namespace App\Controller;

use App\Entity\Group;
use App\Entity\Person;
use App\Form\UnmappedWithoutAjaxWithEventType;
use App\Form\UnmappedWithoutAjaxWithoutEventType;
use App\Form\WithAjaxWithEventType;
use App\Form\WithAjaxWithoutEventType;
use App\Form\WithoutAjaxWithEventType;
use App\Form\WithoutAjaxWithoutEventType;
use App\Repository\GroupRepository;
use App\Repository\PersonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GroupController extends AbstractController
{


    #[Route('/')]
    public function index(Request $request,GroupRepository $groupRepository): Response
    {

        $person = new Person();
        $form = $this->createForm(WithAjaxWithEventType::class, $person,[
            'group' => $groupRepository->findOneBy([]) // If the group null it's works fine, but if we set data the bug will rendered
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dd($form,$person);
        }

        return $this->renderForm('index.html.twig', [
            'person' => $person,
            'form' => $form,
        ]);
    }

    #[Route('/fixtures')]
    public function fixtures(GroupRepository $groupRepository): Response
    {
        $g1 = new Group();
        $g1->setName('g1');
        $groupRepository->save($g1);

        $g2 = new Group();
        $g2->setName('g2');
        $groupRepository->save($g2);

        $g3 = new Group();
        $g3->setName('g3');
        $groupRepository->save($g3,true);

        return new Response('ok');
    }
}
