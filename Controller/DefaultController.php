<?php

namespace Litwicki\Bundle\ChargifyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Litwicki\Bundle\ChargifyBundle\ModelCustomer;

class DefaultController extends Controller
{

    public function indexAction(Request $request)
    {
        $handler = $this->get('chargify.handler.customer');

        $page = array(
            'api' => array(
                'test_mode' => $this->getParameter('chargify.test_mode'),
                'domain' => $this->getParameter('chargify.domain'),
                'api_id' => $this->getParameter('chargify.api_id'),
                'api_key' => $this->getParameter('chargify.api_key'),
                'shared_key' => $this->getParameter('chargify.shared_key'),
                'api_secret' => $this->getParameter('chargify.api_secret'),
                'api_password' => $this->getParameter('chargify.api_password'),
                'data_format' => $this->getParameter('chargify.data_format'),
            ),
            'stats' => $handler->getStats(),
        );

        return $this->render('ChargifyBundle:Default:index.html.twig', $page);

    }

}