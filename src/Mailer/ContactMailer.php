<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 20/12/2021
 * Time: 10:21
 */

namespace App\Mailer;


use App\Entity\Contact;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;

/**
 * Contains the configuration for send a contact mailer
 *
 * Class ContactMailer
 * @package App\Mailer
 */
class ContactMailer
{
    protected $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function contactMailer(Contact $contact)
    {
        $email = (new TemplatedEmail())
            ->From($contact->getEmail())
            ->to($contact->getBusinessDepartment()->getEmail())
            ->subject('Nouveau message de '. $contact->getName())
            ->htmlTemplate('mailer/contactMailer.html.twig')
            ->context([
                'contact' => $contact,
            ])
        ;
        try {
            $this->mailer->send($email);
        } catch (TransportExceptionInterface $e) {
            return $e;
        }
        return true;
    }
}