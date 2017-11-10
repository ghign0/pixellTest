<?php

namespace TemplateBundle\Controller;

use AdminBundle\Entity\Pagina;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name ="homepage")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pagina = $em->getRepository('AdminBundle:Pagina')->findOneBy(['isHome' => true ]);

        return( $pagina != null) ?
            $this->render('@template/pagina.html.twig' ,['pagina' => $pagina]) :
            $this->render('@template/index.html.twig');
    }


    /**
     *
     * @Route("/{slug}" , name="view_page")
     */
    public function viewPage( $slug )
    {
        $pagina = new Pagina();
        $em = $this->getDoctrine()->getManager();

        $pagina = $em->getRepository('AdminBundle:Pagina')->findOneBy(['slug' => $slug ]);

        return ($pagina != null ) ?
            $this->render('@template/pagina.html.twig' ,['pagina' => $pagina]) :
            $this->render ('@template/404.html.twig');
    }


    public function renderMenuAction()
    {
        $menu = array();
        $em = $this->getDoctrine()->getManager();
        $lista  = $em->getRepository('AdminBundle:Pagina')->findBy(['inMenu' => true]);
        foreach($lista as $pagina) {
            # tolgo dal menu renderizzato il link alla home che sarà fisso nel template.
            if ($pagina->getIsHome() == false ){
                $menu[$pagina->getId()] = [
                    'title' => $pagina->getTitle(),
                    'slug' => $pagina->getSlug()
                ];
            }
        }
        return $this->render('@template/assets/menu.html.twig' , [
            'menu' => $menu
         ]);
    }
}
