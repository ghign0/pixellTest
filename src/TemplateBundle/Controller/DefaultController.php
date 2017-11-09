<?php

namespace TemplateBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('TemplateBundle:Default:index.html.twig');
    }


    /**
     *
     * @Route(/{slug} , name="view_page")
     */
    public function viewPage( $slug )
    {
        $pagina = new Pagina();
        $em = $this->getDoctrine()->getManager();
    }
}
