<?php

namespace PHPMaker2024\AMS\Entity;

use DateTime;
use DateTimeImmutable;
use DateInterval;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\SequenceGenerator;
use Doctrine\DBAL\Types\Types;
use PHPMaker2024\AMS\AbstractEntity;
use PHPMaker2024\AMS\AdvancedSecurity;
use PHPMaker2024\AMS\UserProfile;
use function PHPMaker2024\AMS\Config;
use function PHPMaker2024\AMS\EntityManager;
use function PHPMaker2024\AMS\RemoveXss;
use function PHPMaker2024\AMS\HtmlDecode;
use function PHPMaker2024\AMS\EncryptPassword;

/**
 * Entity class for "towers" table
 */
#[Entity]
#[Table(name: "towers")]
class Tower extends AbstractEntity
{
    #[Id]
    #[Column(name: "tower_id", type: "integer", unique: true)]
    #[GeneratedValue(strategy: "SEQUENCE")]
    #[SequenceGenerator(sequenceName: "towers_tower_id_seq")]
    private int $towerId;

    #[Column(type: "string")]
    private string $name;

    #[Column(type: "string", unique: true)]
    private string $code;

    #[Column(name: "type_id", type: "integer", nullable: true)]
    private ?int $typeId;

    #[Column(name: "status_id", type: "integer", nullable: true)]
    private ?int $statusId;

    #[Column(type: "decimal", nullable: true)]
    private ?string $height;

    #[Column(type: "decimal", nullable: true)]
    private ?string $latitude;

    #[Column(type: "decimal", nullable: true)]
    private ?string $longitude;

    #[Column(type: "text", nullable: true)]
    private ?string $address;

    #[Column(type: "string", nullable: true)]
    private ?string $city;

    #[Column(type: "string", nullable: true)]
    private ?string $region;

    #[Column(name: "installation_date", type: "date", nullable: true)]
    private ?DateTime $installationDate;

    #[Column(name: "last_maintenance", type: "date", nullable: true)]
    private ?DateTime $lastMaintenance;

    #[Column(name: "created_by", type: "integer", nullable: true)]
    private ?int $createdBy;

    #[Column(name: "created_at", type: "datetime", nullable: true)]
    private ?DateTime $createdAt;

    #[Column(name: "updated_by", type: "integer", nullable: true)]
    private ?int $updatedBy;

    #[Column(name: "updated_at", type: "datetime", nullable: true)]
    private ?DateTime $updatedAt;

    #[Column(type: "text", nullable: true)]
    private ?string $notes;

    public function getTowerId(): int
    {
        return $this->towerId;
    }

    public function setTowerId(int $value): static
    {
        $this->towerId = $value;
        return $this;
    }

    public function getName(): string
    {
        return HtmlDecode($this->name);
    }

    public function setName(string $value): static
    {
        $this->name = RemoveXss($value);
        return $this;
    }

    public function getCode(): string
    {
        return HtmlDecode($this->code);
    }

    public function setCode(string $value): static
    {
        $this->code = RemoveXss($value);
        return $this;
    }

    public function getTypeId(): ?int
    {
        return $this->typeId;
    }

    public function setTypeId(?int $value): static
    {
        $this->typeId = $value;
        return $this;
    }

    public function getStatusId(): ?int
    {
        return $this->statusId;
    }

    public function setStatusId(?int $value): static
    {
        $this->statusId = $value;
        return $this;
    }

    public function getHeight(): ?string
    {
        return $this->height;
    }

    public function setHeight(?string $value): static
    {
        $this->height = $value;
        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(?string $value): static
    {
        $this->latitude = $value;
        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(?string $value): static
    {
        $this->longitude = $value;
        return $this;
    }

    public function getAddress(): ?string
    {
        return HtmlDecode($this->address);
    }

    public function setAddress(?string $value): static
    {
        $this->address = RemoveXss($value);
        return $this;
    }

    public function getCity(): ?string
    {
        return HtmlDecode($this->city);
    }

    public function setCity(?string $value): static
    {
        $this->city = RemoveXss($value);
        return $this;
    }

    public function getRegion(): ?string
    {
        return HtmlDecode($this->region);
    }

    public function setRegion(?string $value): static
    {
        $this->region = RemoveXss($value);
        return $this;
    }

    public function getInstallationDate(): ?DateTime
    {
        return $this->installationDate;
    }

    public function setInstallationDate(?DateTime $value): static
    {
        $this->installationDate = $value;
        return $this;
    }

    public function getLastMaintenance(): ?DateTime
    {
        return $this->lastMaintenance;
    }

    public function setLastMaintenance(?DateTime $value): static
    {
        $this->lastMaintenance = $value;
        return $this;
    }

    public function getCreatedBy(): ?int
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?int $value): static
    {
        $this->createdBy = $value;
        return $this;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTime $value): static
    {
        $this->createdAt = $value;
        return $this;
    }

    public function getUpdatedBy(): ?int
    {
        return $this->updatedBy;
    }

    public function setUpdatedBy(?int $value): static
    {
        $this->updatedBy = $value;
        return $this;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTime $value): static
    {
        $this->updatedAt = $value;
        return $this;
    }

    public function getNotes(): ?string
    {
        return HtmlDecode($this->notes);
    }

    public function setNotes(?string $value): static
    {
        $this->notes = RemoveXss($value);
        return $this;
    }
}
