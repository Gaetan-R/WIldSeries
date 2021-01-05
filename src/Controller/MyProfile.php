<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Program;
use App\Entity\User;

class MyProfile extends AbstractController
{

    /**
     * @Route("/My-account", name="my_account")
     */

    public function index(): Response
    {
        $userSeries = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findBy(['owner' =>$this->getUser()]);

        return $this->render('security/My_account.html.twig', [
            'userSeries' => $userSeries
        ]
        );
    }
}
