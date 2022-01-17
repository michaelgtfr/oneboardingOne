<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\BusinessDepartmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=BusinessDepartmentRepository::class)
 * @ApiResource(
 * collectionOperations={"get"},
 * itemOperations={"get"},
 * shortName="business_department_list",
 * normalizationContext={"groups"={"business_department_listing:read"}}
 * )
 */
class BusinessDepartment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"business_department_listing:read", "contact:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60).
     * @Assert\Email()
     *  @Groups({"contact:read"})
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\Type("string")
     * @Assert\Length(max=50)
     * @Groups({"business_department_listing:read", "contact:read"})
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
