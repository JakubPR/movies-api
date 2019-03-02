<?php

namespace App\Controller;

use App\Entity\Movie;
use FOS\RestBundle\Controller\ControllerTrait;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MoviesController extends AbstractController
{
    use ControllerTrait;

    /**
     * @Rest\View()
     */
    public function getMoviesAction()
    {
        $movies = $this->getDoctrine()->getRepository(Movie::class)->findAll();

        return $movies;
    }

    /**
     * @Rest\View(statusCode=201)
     * @ParamConverter("movie", converter="fos_rest.request_body")
     * @Rest\NoRoute()
     * @param Movie $movie
     */
    public function putMovieAction(Movie $movie)
    {
        $em = $this->getDoctrine()->getManager();
        $em->persist($movie);
        $em->flush();
    }
}