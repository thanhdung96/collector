<?php

namespace App\Entity;

use App\Repository\BorrowerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BorrowerRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Borrower extends AbstractBaseEntity
{
    #[ORM\Column(length: 16)]
    private ?string $status = null;

    #[ORM\ManyToOne(inversedBy: 'borrowers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SystemUser $systemUser = null;

    #[ORM\OneToOne(inversedBy: 'borrower', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Profile $profile = null;

    /**
     * @var Collection<int, Loan>
     */
    #[ORM\OneToMany(targetEntity: Loan::class, mappedBy: 'borrower')]
    private Collection $loans;

    public function __construct()
    {
        parent::__construct();
        $this->loans = new ArrayCollection();
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

    public function getSystemUser(): ?SystemUser
    {
        return $this->systemUser;
    }

    public function setSystemUser(?SystemUser $systemUser): static
    {
        $this->systemUser = $systemUser;

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
            $loan->setBorrower($this);
        }

        return $this;
    }

    public function removeLoan(Loan $loan): static
    {
        if ($this->loans->removeElement($loan)) {
            // set the owning side to null (unless already changed)
            if ($loan->getBorrower() === $this) {
                $loan->setBorrower(null);
            }
        }

        return $this;
    }
}
