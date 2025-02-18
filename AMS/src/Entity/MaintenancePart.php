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
 * Entity class for "maintenance_parts" table
 */
#[Entity]
#[Table(name: "maintenance_parts")]
class MaintenancePart extends AbstractEntity
{
    #[Id]
    #[Column(name: "part_id", type: "integer", unique: true)]
    #[GeneratedValue(strategy: "SEQUENCE")]
    #[SequenceGenerator(sequenceName: "maintenance_parts_part_id_seq")]
    private int $partId;

    #[Column(name: "log_id", type: "integer", nullable: true)]
    private ?int $logId;

    #[Column(name: "part_name", type: "string", nullable: true)]
    private ?string $partName;

    #[Column(type: "integer", nullable: true)]
    private ?int $quantity;

    #[Column(name: "unit_cost", type: "decimal", nullable: true)]
    private ?string $unitCost;

    #[Column(name: "total_cost", type: "decimal", nullable: true)]
    private ?string $totalCost;

    #[Column(type: "string", nullable: true)]
    private ?string $supplier;

    #[Column(name: "warranty_period", type: "integer", nullable: true)]
    private ?int $warrantyPeriod;

    #[Column(name: "created_by", type: "integer", nullable: true)]
    private ?int $createdBy;

    #[Column(name: "created_at", type: "datetime", nullable: true)]
    private ?DateTime $createdAt;

    #[Column(type: "text", nullable: true)]
    private ?string $notes;

    public function getPartId(): int
    {
        return $this->partId;
    }

    public function setPartId(int $value): static
    {
        $this->partId = $value;
        return $this;
    }

    public function getLogId(): ?int
    {
        return $this->logId;
    }

    public function setLogId(?int $value): static
    {
        $this->logId = $value;
        return $this;
    }

    public function getPartName(): ?string
    {
        return HtmlDecode($this->partName);
    }

    public function setPartName(?string $value): static
    {
        $this->partName = RemoveXss($value);
        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $value): static
    {
        $this->quantity = $value;
        return $this;
    }

    public function getUnitCost(): ?string
    {
        return $this->unitCost;
    }

    public function setUnitCost(?string $value): static
    {
        $this->unitCost = $value;
        return $this;
    }

    public function getTotalCost(): ?string
    {
        return $this->totalCost;
    }

    public function setTotalCost(?string $value): static
    {
        $this->totalCost = $value;
        return $this;
    }

    public function getSupplier(): ?string
    {
        return HtmlDecode($this->supplier);
    }

    public function setSupplier(?string $value): static
    {
        $this->supplier = RemoveXss($value);
        return $this;
    }

    public function getWarrantyPeriod(): ?int
    {
        return $this->warrantyPeriod;
    }

    public function setWarrantyPeriod(?int $value): static
    {
        $this->warrantyPeriod = $value;
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
