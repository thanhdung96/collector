<?php

namespace App\Entity;

use App\Repository\LoanRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LoanRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Loan extends AbstractBaseEntity
{
    #[ORM\Column(length: 16)]
    private ?string $status = null;

    #[ORM\Column(length: 8)]
    private ?string $type = null;

    #[ORM\Column]
    private ?int $principal = null;

    #[ORM\Column]
    private ?float $interestRate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $transferDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dueDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $actualDueDate = null;

    #[ORM\ManyToOne(inversedBy: 'loans')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SystemUser $loaner = null;

    #[ORM\ManyToOne(inversedBy: 'loans')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Borrower $borrower = null;

    /**
     * @var Collection<int, Period>
     */
    #[ORM\OneToMany(targetEntity: Period::class, mappedBy: 'loan')]
    private Collection $periods;

    public function __construct()
    {
        parent::__construct();
        $this->periods = new ArrayCollection();
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getPrincipal(): ?int
    {
        return $this->principal;
    }

    public function setPrincipal(int $principal): static
    {
        $this->principal = $principal;

        return $this;
    }

    public function getInterestRate(): ?float
    {
        return $this->interestRate;
    }

    public function setInterestRate(float $interestRate): static
    {
        $this->interestRate = $interestRate;

        return $this;
    }

    public function getTransferDate(): ?\DateTimeInterface
    {
        return $this->transferDate;
    }

    public function setTransferDate(?\DateTimeInterface $transferDate): static
    {
        $this->transferDate = $transferDate;

        return $this;
    }

    public function getDueDate(): ?\DateTimeInterface
    {
        return $this->dueDate;
    }

    public function setDueDate(\DateTimeInterface $dueDate): static
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    public function getActualDueDate(): ?\DateTimeInterface
    {
        return $this->actualDueDate;
    }

    public function setActualDueDate(?\DateTimeInterface $actualDueDate): static
    {
        $this->actualDueDate = $actualDueDate;

        return $this;
    }

    public function getLoaner(): ?SystemUser
    {
        return $this->loaner;
    }

    public function setLoaner(?SystemUser $loaner): static
    {
        $this->loaner = $loaner;

        return $this;
    }

    public function getBorrower(): ?Borrower
    {
        return $this->borrower;
    }

    public function setBorrower(?Borrower $borrower): static
    {
        $this->borrower = $borrower;

        return $this;
    }

    /**
     * @return Collection<int, Period>
     */
    public function getPeriods(): Collection
    {
        return $this->periods;
    }

    public function addPeriod(Period $period): static
    {
        if (!$this->periods->contains($period)) {
            $this->periods->add($period);
            $period->setLoan($this);
        }

        return $this;
    }

    public function removePeriod(Period $period): static
    {
        if ($this->periods->removeElement($period)) {
            // set the owning side to null (unless already changed)
            if ($period->getLoan() === $this) {
                $period->setLoan(null);
            }
        }

        return $this;
    }
}
