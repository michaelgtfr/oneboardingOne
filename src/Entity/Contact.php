<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ContactRepository::class)
 */
class Contact
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\Type("string")
     * @Assert\Length(max=50)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\Type("string")
     * @Assert\Length(max=50)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Type("string")
     * @Assert\Length(max=255)
     */
    private $message;

    /**
     * @ORM\ManyToOne(targetEntity=BusinessDepartment::class, inversedBy="contacts")
     * @Assert\Type("object")
     */
    private $businessDepartment;

    /**
     * @ORM\Column(type="string", length=60)
     * @Assert\Length(max=60)
     * @Assert\Email()
     */
    private $email;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        //Protection against the faults XSS
        $this->name = filter_var($name, FILTER_SANITIZE_STRING);

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = filter_var($firstName, FILTER_SANITIZE_STRING);

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = filter_var($message, FILTER_SANITIZE_STRING);

        return $this;
    }

    public function getBusinessDepartment(): ?BusinessDepartment
    {
        return $this->businessDepartment;
    }

    public function setBusinessDepartment(?BusinessDepartment $businessDepartment): self
    {
        $this->businessDepartment = $businessDepartment;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = filter_var($email, FILTER_SANITIZE_STRING);

        return $this;
    }
}
