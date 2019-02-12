<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class CorsListener
{
    private $cors;

    public function __construct(array $options)
    {
        $this->cors = $options;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        // Don't do anything if it's not the master request.
        if (!$event->isMasterRequest()) {
            return;
        }
        $request = $event->getRequest();
        if ($request->getRealMethod() === 'OPTIONS') {
//            $response = new Response();
//
//            $response->headers->set('Access-Control-Allow-Credentials', 'true');
//            $response->headers->set('Access-Control-Allow-Methods', 'POST, GET, PUT, DELETE, PATCH, OPTIONS');
//            $response->headers->set('Access-Control-Allow-Headers', 'Origin, Content-Type, Accept, Authorization, X-Device-Code');
//            $response->headers->set('Access-Control-Max-Age', 3600);
//
//            $response->setStatusCode(204);
//            $event->setResponse($response);
        }
    }


    public function onKernelResponse(FilterResponseEvent $event)
    {
        $request = $event->getRequest();
        $response = $event->getResponse();
        // Run CORS check in here to ensure domain is in the system
        if (in_array($request->headers->get('origin'), $this->cors)) {
            $response->headers->set('Access-Control-Allow-Credentials', 'true');
            $response->headers->set('Access-Control-Allow-Headers', 'Origin, Content-Type, Accept, Authorization, X-Device-Code');
            $response->headers->set('Access-Control-Allow-Methods', 'POST, GET, PUT, DELETE, PATCH, OPTIONS');
            $response->headers->set('Vary', 'Origin');
        }
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $event->setResponse($response);
        return;

    }
}
