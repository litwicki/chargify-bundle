<?php

namespace Litwicki\Bundle\ChargifyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Litwicki\Bundle\ChargifyBundle\ModelCustomer;

class DefaultController extends Controller
{
    /**
     * Dashboard landing page and docs.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function indexAction(Request $request)
    {
        $handler = $this->container->get('chargify.handler.customer');

        $page = array(
            'api' => array(
                'test_mode' => $this->container->getParameter('chargify.test_mode'),
                'domain' => $this->container->getParameter('chargify.domain'),
                'api_id' => $this->container->getParameter('chargify.api_id'),
                'api_key' => $this->container->getParameter('chargify.api_key'),
                'shared_key' => $this->container->getParameter('chargify.shared_key'),
                'api_secret' => $this->container->getParameter('chargify.api_secret'),
                'api_password' => $this->container->getParameter('chargify.api_password'),
                'data_format' => $this->container->getParameter('chargify.data_format'),
            ),
            'stats' => $handler->getStats(),
        );

        return $this->render('ChargifyBundle:Default:index.html.twig', $page);

    }
}