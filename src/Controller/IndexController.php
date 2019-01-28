<?php

namespace App\Controller;

use App\Form\ContactUsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use DateTime;

// Annotations
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /** @Route("/", name="index") */
    public function index()
    {
        return $this->render('index/index.html.twig', array('page' => 'index'));
    }

    /** @Route("/cosa-facciamo", name="what") */
    public function what()
    {
        return $this->render('index/what.html.twig', array('page' => 'what'));
    }

    /** @Route("/progetti-eventi", name="projects") */
    public function projects()
    {
        return $this->render('index/projects.html.twig', array('page' => 'projects'));
    }

    /** @Route("/extra-italiani", name="extra") */
    public function extra()
    {
        return $this->render('index/extra.html.twig', array('page' => 'extra'));
    }

    /** @Route("/contatti", name="contacts")
     *  @throws \Exception
     */
    public function contacts(Request $request)
    {
        $form = $this->createForm(ContactUsType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

//            $em = $this->getDoctrine()->getManager();
//            $message->setDate(new DateTime());
//            $em->persist($message);
//            $em->flush();

            $this->addFlash('success','message.sent.success');
            return $this->redirect($request->getUri());
        }

        return $this->render('index/contacts.html.twig', array(
            'page' => 'contacts',
            'form' => $form->createView()
        ));
    }

    /** @Route("/locale/{_locale}", name="locale", requirements={"_locale": "%locales%"}) */
    public function setlanguage(SessionInterface $session, Request $request, $_locale)
    {
        $session->set('_locale', $_locale);

        $referer = $request->headers->get('referer');
        return new RedirectResponse($referer);
    }
}
