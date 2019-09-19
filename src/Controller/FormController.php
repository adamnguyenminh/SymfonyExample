<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormTypeInterface;

class FormController extends AbstractController
{
    /**
     * @Route("/form", name="form")
     */
    public function index(Request $request)
    {
        $post = new Post();
        $form = $this->createForm(PostType::class , $post, [
            'action' => $this->generateUrl('form')
        ]);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            var_dump($post); die;
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
        }
        return $this->render('form/index.html.twig', [
            'form_post' => $form->createView()
        ]);
    }
}
