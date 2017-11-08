<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\Pagina;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Pagina controller.
 *
 * @Route("/admin/pagina")
 */
class PaginaController extends Controller
{
    /**
     * Lists all pagina entities.
     *
     * @Route("/", name="pagina_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $paginas = $em->getRepository('AdminBundle:Pagina')->findAll();

        return $this->render('pagina/index.html.twig', array(
            'paginas' => $paginas,
        ));
    }

    /**
     * Creates a new pagina entity.
     *
     * @Route("/new", name="pagina_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $pagina = new Pagina();
        $form = $this->createForm('AdminBundle\Form\PaginaType', $pagina);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pagina);
            $em->flush();

            return $this->redirectToRoute('pagina_show', array('id' => $pagina->getId()));
        }

        return $this->render('pagina/new.html.twig', array(
            'pagina' => $pagina,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a pagina entity.
     *
     * @Route("/{id}", name="pagina_show")
     * @Method("GET")
     */
    public function showAction(Pagina $pagina)
    {
        $deleteForm = $this->createDeleteForm($pagina);

        return $this->render('pagina/show.html.twig', array(
            'pagina' => $pagina,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing pagina entity.
     *
     * @Route("/{id}/edit", name="pagina_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Pagina $pagina)
    {
        $deleteForm = $this->createDeleteForm($pagina);
        $editForm = $this->createForm('AdminBundle\Form\PaginaType', $pagina);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pagina_edit', array('id' => $pagina->getId()));
        }

        return $this->render('pagina/edit.html.twig', array(
            'pagina' => $pagina,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a pagina entity.
     *
     * @Route("/{id}", name="pagina_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Pagina $pagina)
    {
        $form = $this->createDeleteForm($pagina);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pagina);
            $em->flush();
        }

        return $this->redirectToRoute('pagina_index');
    }

    /**
     * Creates a form to delete a pagina entity.
     *
     * @param Pagina $pagina The pagina entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Pagina $pagina)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pagina_delete', array('id' => $pagina->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
