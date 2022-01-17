<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 12/01/2022
 * Time: 15:24
 */

namespace App\DataPersister;


use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\Contact;
use App\Mailer\ContactMailer;

class ContactDataPersister implements DataPersisterInterface
{
    private $decorated;
    private $contactMailer;

    public function __construct(DataPersisterInterface $decorated, ContactMailer $contactMailer)
    {
        $this->decorated = $decorated;
        $this->contactMailer = $contactMailer;
    }

    public function supports($data): bool
    {
        return $data instanceof Contact;
    }

    public function persist($data)
    {
        $result = $this->decorated->persist($data);

        $this->contactMailer->contactMailer($data);

        return $result;
    }

    public function remove($data)
    {
        return $this->decorated->remove($data);
    }
}