<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /** @Route("/", name="index") */
    public function index()
    {
        return $this->render('index/index.html.twig', array());
    }

    /** @Route("/locale/{_locale}", name="locale", requirements={"_locale": "%locales%"}) */
    public function setlanguage(SessionInterface $session, Request $request, $_locale)
    {
        $session->set('_locale', $_locale);

        $referer = $request->headers->get('referer');
        return new RedirectResponse($referer);
    }
}