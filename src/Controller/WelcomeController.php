<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/Home", name="home")
 */
class WelcomeController extends AbstractController
{
    /**
     * @Route("/welcome", name="welcome")
     */
    public function index()
    {
        return $this->render('welcome/index.html.twig', [
            'controller_name' => 'WelcomeController',
        ]);
    }

    /**
     * @Route("/HelloUser/{name}", name="hello_user")
     */
    public function HelloUser(Request $request , $name){
//        $name =$request -> get("name");
        $person =[
            'name' => $name,
            'lastname' => 'NguyenMinh',
            'age'=> 21
        ];

        $post =new Post();

        $post->setName('Thong');

        $post->setAuthor('Author is Adam');

        $em = $this->getDoctrine()->getManager();

        $ReceivePost = $em ->getRepository(Post::class)->findOneBy([
            'id' => 1
        ]);

//        var_dump($ReceivePost);
//        $em->remove($ReceivePost);

        $em->persist($post);

        $em->flush();

        $form = $this->createFormBuilder()
            ->add('fullname')
            ->getForm();
        return $this->render('welcome/Hello_User.html.twig',[
            'person' => $person,
            'post' => $ReceivePost,
            'user_form' => $form ->createView()
        ]);
    }
}
