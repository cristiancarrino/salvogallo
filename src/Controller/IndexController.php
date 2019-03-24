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
        return $this->render('index/index.html.twig');
    }
    /** @Route("/association", name="association") */
    public function association()
    {
        return $this->render('index/association.html.twig');
    }

    /** @Route("/cosa-facciamo", name="what") */
    public function what()
    {
        return $this->render('index/what.html.twig');
    }

    /** @Route("/progetti-eventi", name="projects") */
    public function projects()
    {
        return $this->render('index/projects.html.twig');
    }

    /** @Route("/extra-italiani", name="extra") */
    public function extra()
    {
        return $this->render('index/extra.html.twig');
    }

    /** @Route("/contatti", name="contacts")
     *  @throws \Exception
     */
    public function contacts(Request $request, \Swift_Mailer $mailer)
    {
        $form = $this->createForm(ContactUsType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();

            $message = (new \Swift_Message('Nuovo messaggio da un utente'))
                ->setFrom($data['email'])
                ->setTo('info@articolo2.com')
                ->setBody(
                    $this->renderView(
                    // templates/emails/registration.html.twig
                        'emails/contact_us.html.twig', [
                            'firstname' => $data['firstname'],
                            'lastname' => $data['lastname'],
                            'email' => $data['email'],
                            'message' => $data['message']
                        ]
                    ),
                    'text/html'
                )
                /*
                 * If you also want to include a plaintext version of the message
                ->addPart(
                    $this->renderView(
                        'emails/registration.txt.twig',
                        ['name' => $name]
                    ),
                    'text/plain'
                )
                */
            ;

            $mailer->send($message);

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
