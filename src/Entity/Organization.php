<?php

namespace App\Entity;

use App\Repository\OrganizationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=OrganizationRepository::class)
 * @UniqueEntity("name")
 */
class Organization
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\Length(max="255", maxMessage="this field can not exceed 255 characters")
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\Length(max="255", maxMessage="You enter too many characters. This field cannot exceed {{ limit }} characters")

     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max="255", maxMessage="You enter too many characters. This field cannot exceed {{ limit }} characters")

     */
    private $registrationNb;

    /**
     * @ORM\OneToOne(targetEntity=User::class, mappedBy="organization", cascade={"persist", "remove"})
     */
    private $user;

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
        $this->name = $name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getRegistrationNb(): ?string
    {
        return $this->registrationNb;
    }

    public function setRegistrationNb(?string $registrationNb): self
    {
        $this->registrationNb = $registrationNb;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setOrganization(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getOrganization() !== $this) {
            $user->setOrganization($this);
        }

        $this->user = $user;

        return $this;
    }

    public function __toString(){
        return $this->name;
    }
}
