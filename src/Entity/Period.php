<?php

namespace App\Entity;

use App\Repository\PeriodRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PeriodRepository::class)]
class Period
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 32, nullable: true)]
    private ?string $transactionCode = null;

    #[ORM\Column(length: 16)]
    private ?string $status = null;

    #[ORM\Column]
    private ?int $interest = null;

    #[ORM\Column(nullable: true)]
    private ?int $delayCompensation = null;

    #[ORM\Column(nullable: true)]
    private ?int $skippingCompensation = null;

    #[ORM\ManyToOne(inversedBy: 'periods')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Loan $loan = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTransactionCode(): ?string
    {
        return $this->transactionCode;
    }

    public function setTransactionCode(?string $transactionCode): static
    {
        $this->transactionCode = $transactionCode;

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

    public function getInterest(): ?int
    {
        return $this->interest;
    }

    public function setInterest(int $interest): static
    {
        $this->interest = $interest;

        return $this;
    }

    public function getDelayCompensation(): ?int
    {
        return $this->delayCompensation;
    }

    public function setDelayCompensation(?int $delayCompensation): static
    {
        $this->delayCompensation = $delayCompensation;

        return $this;
    }

    public function getSkippingCompensation(): ?int
    {
        return $this->skippingCompensation;
    }

    public function setSkippingCompensation(?int $skippingCompensation): static
    {
        $this->skippingCompensation = $skippingCompensation;

        return $this;
    }

    public function getLoan(): ?Loan
    {
        return $this->loan;
    }

    public function setLoan(?Loan $loan): static
    {
        $this->loan = $loan;

        return $this;
    }
}
