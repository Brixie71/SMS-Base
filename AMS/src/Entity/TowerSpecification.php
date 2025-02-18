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
 * Entity class for "tower_specifications" table
 */
#[Entity]
#[Table(name: "tower_specifications")]
class TowerSpecification extends AbstractEntity
{
    #[Id]
    #[Column(name: "spec_id", type: "integer", unique: true)]
    #[GeneratedValue(strategy: "SEQUENCE")]
    #[SequenceGenerator(sequenceName: "tower_specifications_spec_id_seq")]
    private int $specId;

    #[Column(name: "tower_id", type: "integer", nullable: true)]
    private ?int $towerId;

    #[Column(name: "spec_type_id", type: "integer", nullable: true)]
    private ?int $specTypeId;

    #[Column(type: "text", nullable: true)]
    private ?string $value;

    #[Column(name: "unit_id", type: "integer", nullable: true)]
    private ?int $unitId;

    #[Column(name: "created_by", type: "integer", nullable: true)]
    private ?int $createdBy;

    #[Column(name: "created_at", type: "datetime", nullable: true)]
    private ?DateTime $createdAt;

    #[Column(name: "updated_by", type: "integer", nullable: true)]
    private ?int $updatedBy;

    #[Column(name: "updated_at", type: "datetime", nullable: true)]
    private ?DateTime $updatedAt;

    public function getSpecId(): int
    {
        return $this->specId;
    }

    public function setSpecId(int $value): static
    {
        $this->specId = $value;
        return $this;
    }

    public function getTowerId(): ?int
    {
        return $this->towerId;
    }

    public function setTowerId(?int $value): static
    {
        $this->towerId = $value;
        return $this;
    }

    public function getSpecTypeId(): ?int
    {
        return $this->specTypeId;
    }

    public function setSpecTypeId(?int $value): static
    {
        $this->specTypeId = $value;
        return $this;
    }

    public function getValue(): ?string
    {
        return HtmlDecode($this->value);
    }

    public function setValue(?string $value): static
    {
        $this->value = RemoveXss($value);
        return $this;
    }

    public function getUnitId(): ?int
    {
        return $this->unitId;
    }

    public function setUnitId(?int $value): static
    {
        $this->unitId = $value;
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
}
