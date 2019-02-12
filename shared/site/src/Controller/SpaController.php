<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SpaController extends AbstractController
{
    /**
     * @Route("/api/spa", name="home", methods={"GET"})
     * @param Request         $request
     *
     * @return JsonResponse
     * @throws BadRequestException
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
}
