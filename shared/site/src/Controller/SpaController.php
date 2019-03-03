<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SpaController extends AbstractController
{
    /**
     * @Route("/api/spa", name="home", methods={"GET"})
     * @param Request         $request
     */
    public function indexAction(Request $request)
    {
        return new JsonResponse(
            [
                'status' => 'success!!!',
            ],
            JsonResponse::HTTP_OK
        );
    }

    /**
     * @Route("/spa", name="spa", methods={"GET"})
     * @param Request         $request
     */
    public function spaAction(Request $request)
    {
//        $u = new User();
//        $u->setName("mad");
//        $u->setUuid("madbad");
//        $em = $this->getDoctrine()->getManager();
//        $em->persist($u);
//        $em->flush();

        return new JsonResponse(
            [
                'status' => 'success!!!',
            ],
            JsonResponse::HTTP_OK
        );
    }

}
