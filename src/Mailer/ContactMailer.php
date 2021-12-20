<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 20/12/2021
 * Time: 10:21
 */

namespace App\Mailer;


use App\Entity\Contact;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;

class AppMailer
{
    protected $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function contactMailer($form, $to, Contact $contact)
    {
        $email = (new TemplatedEmail())
            ->From($form)
            ->to($to)
            ->subject('Nouveau message de '. $contact->getUsername())
            ->htmlTemplate('mailer/contactMailer.html.twig')
            ->context([
                'contact' => $contact,
            ])
        ;
        try {
            $mailer->send($email);
        } catch (TransportExceptionInterface $e) {
            return $e;
        }
        return true;
    }
}