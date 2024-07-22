<?php

namespace App\Entity;

use App\Repository\ProfileRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProfileRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Profile extends AbstractBaseEntity
{
    #[ORM\Column(length: 16)]
    private ?string $phoneNumber = null;

    #[ORM\Column(length: 32, nullable: true)]
    private ?string $idNumber = null;

    #[ORM\Column(length: 32, nullable: true)]
    private ?string $passportNumber = null;

    #[ORM\Column(length: 1)]
    private ?string $gender = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dob = null;

    #[ORM\Column(length: 64)]
    private ?string $firstName = null;

    #[ORM\Column(length: 64)]
    private ?string $lastName = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Address $permanentAddress = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Address $temporaryAddress = null;

    #[ORM\OneToOne(mappedBy: 'profile', cascade: ['persist', 'remove'])]
    private ?SystemUser $systemUser = null;

    #[ORM\OneToOne(mappedBy: 'profile', cascade: ['persist', 'remove'])]
    private ?Borrower $borrower = null;

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): static
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getIdNumber(): ?string
    {
        return $this->idNumber;
    }

    public function setIdNumber(?string $idNumber): static
    {
        $this->idNumber = $idNumber;

        return $this;
    }

    public function getPassportNumber(): ?string
    {
        return $this->passportNumber;
    }

    public function setPassportNumber(?string $passportNumber): static
    {
        $this->passportNumber = $passportNumber;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): static
    {
        $this->gender = $gender;

        return $this;
    }

    public function getDob(): ?\DateTimeInterface
    {
        return $this->dob;
    }

    public function setDob(?\DateTimeInterface $dob): static
    {
        $this->dob = $dob;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getPermanentAddress(): ?Address
    {
        return $this->permanentAddress;
    }

    public function setPermanentAddress(?Address $permanentAddress): static
    {
        $this->permanentAddress = $permanentAddress;

        return $this;
    }

    public function getTemporaryAddress(): ?Address
    {
        return $this->temporaryAddress;
    }

    public function setTemporaryAddress(?Address $temporaryAddress): static
    {
        $this->temporaryAddress = $temporaryAddress;

        return $this;
    }

    public function getSystemUser(): ?SystemUser
    {
        return $this->systemUser;
    }

    public function setSystemUser(SystemUser $systemUser): static
    {
        // set the owning side of the relation if necessary
        if ($systemUser->getProfile() !== $this) {
            $systemUser->setProfile($this);
        }

        $this->systemUser = $systemUser;

        return $this;
    }

    public function getBorrower(): ?Borrower
    {
        return $this->borrower;
    }

    public function setBorrower(Borrower $borrower): static
    {
        // set the owning side of the relation if necessary
        if ($borrower->getProfile() !== $this) {
            $borrower->setProfile($this);
        }

        $this->borrower = $borrower;

        return $this;
    }
}
