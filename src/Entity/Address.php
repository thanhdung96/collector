<?php

namespace App\Entity;

use App\Repository\AddressRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AddressRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Address extends AbstractBaseEntity
{
    #[ORM\Column(length: 64)]
    private ?string $houseNumber = null;

    #[ORM\Column(length: 64)]
    private ?string $street = null;

    #[ORM\Column(length: 64)]
    private ?string $ward = null;

    #[ORM\Column(length: 64)]
    private ?string $district = null;

    #[ORM\Column(length: 64)]
    private ?string $city = null;

    public function getHouseNumber(): ?string
    {
        return $this->houseNumber;
    }

    public function setHouseNumber(string $houseNumber): static
    {
        $this->houseNumber = $houseNumber;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): static
    {
        $this->street = $street;

        return $this;
    }

    public function getWard(): ?string
    {
        return $this->ward;
    }

    public function setWard(string $ward): static
    {
        $this->ward = $ward;

        return $this;
    }

    public function getDistrict(): ?string
    {
        return $this->district;
    }

    public function setDistrict(string $district): static
    {
        $this->district = $district;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }
}
