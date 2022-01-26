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
use App\Mailer\ContactMailer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ContactController extends AbstractController
{
    protected $em;
    protected $session;
    protected $contactMailer;
    protected $validator;

    public function __construct(EntityManagerInterface $em,  SessionInterface $session, ContactMailer $contactMailer,
                                ValidatorInterface $validator)
    {
        $this->em = $em;
        $this->session = $session;
        $this->contactMailer = $contactMailer;
        $this->validator = $validator;
    }

    /**
     * Page allows of display the contact forms and the treatment the data
     *
     * @Route("/", "app_contact")
     * @param Request $request
     * @param FormFactoryInterface $formFactory
     * @return Response
     */
    public function contactController(Request $request, FormFactoryInterface $formFactory)
    {
        $contact = new Contact();

        $contactForm = $formFactory->create(ContactForm::class, $contact);

        $contactForm->handleRequest($request);
        if ($contactForm->isSubmitted() && $contactForm->isValid()) {
            $this->treatment($contactForm->getData());
        }

        return $this->render('contact.html.twig', [
            'contactForm' => $contactForm->createView(),
        ]);
    }

    /**
     * Save the data of the contact form page and send this data in the personal service email.
     *
     * @param $contact
     * @return
     */
    public function treatment($contact)
    {
        try {
            $errors = $this->validator->validate($contact);

            if (count($errors) == 0) {
                $this->em->persist($contact);
                $this->em->flush();

                $mailerSend = $this->contactMailer->contactMailer($contact);

                if ($mailerSend) {
                    return $this->session->getFlashBag()->add(
                        'success',
                        'Votre email à été envoyé.'
                    );
                }
            }
            return $this->session->getFlashBag()->add(
                'error',
                "Désoler, mais votre message n'a pas été traité. Veuillez réessayer ultérieurement."
            );

        } catch (\Exception $e) {
            return $this->session->getFlashBag()->add(
                'error',
                "Désoler, mais votre message n'a pas été traité. Veuillez réessayer ultérieurement."
            );
        }
    }
}
