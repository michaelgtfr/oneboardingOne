<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 19/12/2021
 * Time: 09:05
 */

namespace App\Treatment;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class ContactTreament
{
    protected $em;
    protected $session;

    public function __construct(EntityManagerInterface $em,  Session $session)
    {
        $this->em = $em;
        $this->session = $session;
    }

    /**
     * save the data of the contact form page.
     * @param $contact
     */
    public function treatment($contact)
    {
        try {
            $this->em->persist($contact);
            $this->em->flush();

            $this->session->getFlashBag()->add(
                'success',
                'Votre email à été envoyé.'
            );
        } catch (\Exception $e) {
            $this->session->getFlashBag()->add(
                'error',
                "Désoler, mais votre message n'a pas été traité. Veuillez réessayer ultérieurement."
            );
        }

    }

}