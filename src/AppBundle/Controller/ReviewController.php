<?php

namespace AppBundle\Controller;

use http\Env\Request;
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
        return $this->render('review/index.html.twig');
    }

    /**
     * Creates a new review entity.
     *
     * @Route("/new", name="review_new")
     * @Method({"GET", "POST"})
     */
    public function newAction()
    {
        return $this->render('review/new.html.twig');
    }
}
