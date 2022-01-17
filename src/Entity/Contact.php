<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ContactRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ContactRepository::class)
 * @ApiResource(
 *  collectionOperations={"get", "post"},
 *  itemOperations={"get"},
 *  shortName="contact",
 *  normalizationContext={"groups"={"contact:read"}},
 *  denormalizationContext={"groups"={"contact:write"}}
 * )
 */
class Contact
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"contact:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\Type("string")
     * @Assert\Length(max=50)
     * @Groups({"contact:read", "contact:write"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\Type("string")
     * @Assert\Length(max=50)
     * @Groups({"contact:read", "contact:write"})
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Type("string")
     * @Assert\Length(max=255)
     * @Groups({"contact:read", "contact:write"})
     */
    private $message;

    /**
     * @ORM\ManyToOne(targetEntity=BusinessDepartment::class, inversedBy="contacts")
     * @Assert\Type("object")
     * @Groups({"contact:read", "contact:write"})
     */
    private $businessDepartment;

    /**
     * @ORM\Column(type="string", length=60)
     * @Assert\Length(max=60)
     * @Assert\Email()
     * @Groups({"contact:read", "contact:write"})
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
