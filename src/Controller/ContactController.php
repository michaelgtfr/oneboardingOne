<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 18/12/2021
 * Time: 12:07
 */

namespace App\Controller;


use App\Entity\Contact;
use App\Form\ContactForm;
use App\Treatment\ContactTreatment;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class ContactController
{
    /**
     * Page allows of display the contact forms and the treatment the data
     *
     * @Route("/", "app_contact")
     * @param Request $request
     * @param Environment $twig
     * @param FormFactoryInterface $formFactory
     * @param ContactTreatment $contactTreatment
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function contactController(Request $request, Environment $twig, FormFactoryInterface $formFactory,
                                      ContactTreatment $contactTreatment)
    {
        $contact = new Contact();

        $contactForm = $formFactory->create(ContactForm::class, $contact);

        $contactForm->handleRequest($request);
        if ($contactForm->isSubmitted() && $contactForm->isValid()) {
            $contactTreatment->treatment($contactForm->getData());
        }
        $render = $twig->render('contact.html.twig', [
            'contactForm' => $contactForm->createView(),
        ]);

        return new Response($render);
    }
}