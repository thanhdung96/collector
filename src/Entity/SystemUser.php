<?php

namespace App\Entity;

use App\Repository\SystemUserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SystemUserRepository::class)]
#[ORM\HasLifecycleCallbacks]
class SystemUser extends AbstractBaseEntity
{
    #[ORM\Column(length: 128)]
    private ?string $email = null;

    #[ORM\Column(length: 128)]
    private ?string $password = null;

    #[ORM\Column(length: 16)]
    private ?string $status = null;

    #[ORM\OneToOne(inversedBy: 'systemUser', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Profile $profile = null;

    /**
     * @var Collection<int, Borrower>
     */
    #[ORM\OneToMany(targetEntity: Borrower::class, mappedBy: 'systemUser')]
    private Collection $borrowers;

    /**
     * @var Collection<int, Loan>
     */
    #[ORM\OneToMany(targetEntity: Loan::class, mappedBy: 'loaner')]
    private Collection $loans;

    public function __construct()
    {
        parent::__construct();
        $this->borrowers = new ArrayCollection();
        $this->loans = new ArrayCollection();
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getProfile(): ?Profile
    {
        return $this->profile;
    }

    public function setProfile(Profile $profile): static
    {
        $this->profile = $profile;

        return $this;
    }

    /**
     * @return Collection<int, Borrower>
     */
    public function getBorrowers(): Collection
    {
        return $this->borrowers;
    }

    public function addBorrower(Borrower $borrower): static
    {
        if (!$this->borrowers->contains($borrower)) {
            $this->borrowers->add($borrower);
            $borrower->setSystemUser($this);
        }

        return $this;
    }

    public function removeBorrower(Borrower $borrower): static
    {
        if ($this->borrowers->removeElement($borrower)) {
            // set the owning side to null (unless already changed)
            if ($borrower->getSystemUser() === $this) {
                $borrower->setSystemUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Loan>
     */
    public function getLoans(): Collection
    {
        return $this->loans;
    }

    public function addLoan(Loan $loan): static
    {
        if (!$this->loans->contains($loan)) {
            $this->loans->add($loan);
            $loan->setLoaner($this);
        }

        return $this;
    }

    public function removeLoan(Loan $loan): static
    {
        if ($this->loans->removeElement($loan)) {
            // set the owning side to null (unless already changed)
            if ($loan->getLoaner() === $this) {
                $loan->setLoaner(null);
            }
        }

        return $this;
    }
}
