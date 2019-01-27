<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CvController extends AbstractController
{
    /** @Route("/cv", name="cv") */
    public function cv()
    {
        return $this->render('cv/cv.html.twig', array());
    }
}