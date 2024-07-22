<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\MappedSuperclass]
abstract class AbstractBaseEntity
{
    #[ORM\Id]
    #[ORM\Column(type: Types::STRING, length: 36, unique: true, nullable: false)]
    private string $id;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $created;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $modified;

    public function __construct(){
        $currentTimestamp = new \DateTime();

        $this->id = Uuid::v7()->toRfc4122();
        $this->created = $currentTimestamp;
        $this->modified = $currentTimestamp;
    }

    #[ORM\PreUpdate]
    public function updateTimestamp(): void{
        $currentTimestamp = new \DateTime();

        if(is_null($this->created)) {
            $this->created = $currentTimestamp;
        }
        $this->modified = $currentTimestamp;

    }
    public function getId(): string{
        return $this->id;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(?\DateTimeInterface $created): void
    {
        $this->created = $created;
    }

    public function getModified(): ?\DateTimeInterface
    {
        return $this->modified;
    }

    public function setModified(?\DateTimeInterface $modified): void
    {
        $this->modified = $modified;
    }
}