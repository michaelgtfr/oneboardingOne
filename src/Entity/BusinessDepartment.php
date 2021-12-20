<?php

namespace App\Entity;

use App\Repository\BusinessDepartmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=BusinessDepartmentRepository::class)
 */
class BusinessDepartment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60).
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\Type("string")
     * @Assert\Length(max=50)
     */
    private $nameDepartment;

    /**
     * @ORM\OneToMany(targetEntity=Contact::class, mappedBy="businessDepartment")
     * @Assert\Type("object")
     */
    private $contacts;

    public function __construct()
    {
        $this->contacts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getNameDepartment(): ?string
    {
        return $this->nameDepartment;
    }

    public function setNameDepartment(string $nameDepartment): self
    {
        $this->nameDepartment = $nameDepartment;

        return $this;
    }

    /**
     * @return Collection|Contact[]
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function addContact(Contact $contact): self
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts[] = $contact;
            $contact->setBusinessDepartment($this);
        }

        return $this;
    }

    public function removeContact(Contact $contact): self
    {
        if ($this->contacts->removeElement($contact)) {
            // set the owning side to null (unless already changed)
            if ($contact->getBusinessDepartment() === $this) {
                $contact->setBusinessDepartment(null);
            }
        }

        return $this;
    }
}
