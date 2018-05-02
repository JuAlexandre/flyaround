<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Review;
use AppBundle\Form\ReviewType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Review Controller
 * @Route("review")
 */
class ReviewController extends Controller
{
    /**
     * List reviews
     *
     * @Route("/", name="review_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $reviews = $em->getRepository('AppBundle:Review')->findAll();

        return $this->render('review/index.html.twig', array(
            'reviews' => $reviews,
        ));
    }

    /**
     * Creates a new review entity.
     *
     * @Route("/new", name="review_new")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $review = new Review();
        $form = $this->createForm(ReviewType::class, $review);

        $form->$this->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($review);
            $em->flush();
            return $this->redirectToRoute('review_show', array('id' => $review->getId()));
        }

        return $this->render('review/new.html.twig', array(
            'review' => $review,
            'form' => $form->createView(),
        ));
    }
}
