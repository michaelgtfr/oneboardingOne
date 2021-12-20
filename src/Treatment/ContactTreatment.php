<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 19/12/2021
 * Time: 09:05
 */

namespace App\Treatment;


use App\Mailer\ContactMailer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class ContactTreatment
 * @package App\Treatment
 */
class ContactTreatment
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
     * Save the data of the contact form page and send this data in the personal service email.
     * @param $contact
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
                    $this->flashBagSuccess();
                    return;
                }
            }
            $this->flashBagError();

        } catch (\Exception $e) {
            $this->flashBagError();
        }
    }

    /**
     * display the message if the treatment is a success
     * @return mixed
     */
    public function flashBagSuccess()
    {
        return $this->session->getFlashBag()->add(
            'success',
            'Votre email à été envoyé.'
        );
    }

    /**
     * display the message if the treatment is a failure.
     * @return mixed
     */
    public function flashBagError()
    {
        return $this->session->getFlashBag()->add(
            'error',
            "Désoler, mais votre message n'a pas été traité. Veuillez réessayer ultérieurement."
        );
    }
}
