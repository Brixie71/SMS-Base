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
 * Entity class for "tower_equipment" table
 */
#[Entity]
#[Table(name: "tower_equipment")]
class TowerEquipment extends AbstractEntity
{
    #[Id]
    #[Column(name: "equipment_id", type: "integer", unique: true)]
    #[GeneratedValue(strategy: "SEQUENCE")]
    #[SequenceGenerator(sequenceName: "tower_equipment_equipment_id_seq")]
    private int $equipmentId;

    #[Column(name: "tower_id", type: "integer", nullable: true)]
    private ?int $towerId;

    #[Column(name: "model_id", type: "integer", nullable: true)]
    private ?int $modelId;

    #[Column(name: "serial_number", type: "string", unique: true, nullable: true)]
    private ?string $serialNumber;

    #[Column(name: "installation_date", type: "date", nullable: true)]
    private ?DateTime $installationDate;

    #[Column(name: "warranty_expiry", type: "date", nullable: true)]
    private ?DateTime $warrantyExpiry;

    #[Column(name: "status_id", type: "integer", nullable: true)]
    private ?int $statusId;

    #[Column(name: "last_maintenance", type: "date", nullable: true)]
    private ?DateTime $lastMaintenance;

    #[Column(name: "next_maintenance", type: "date", nullable: true)]
    private ?DateTime $nextMaintenance;

    #[Column(name: "client_id", type: "integer", nullable: true)]
    private ?int $clientId;

    #[Column(name: "installed_by", type: "integer", nullable: true)]
    private ?int $installedBy;

    #[Column(name: "created_by", type: "integer", nullable: true)]
    private ?int $createdBy;

    #[Column(name: "created_at", type: "datetime", nullable: true)]
    private ?DateTime $createdAt;

    #[Column(name: "updated_by", type: "integer", nullable: true)]
    private ?int $updatedBy;

    #[Column(name: "updated_at", type: "datetime", nullable: true)]
    private ?DateTime $updatedAt;

    #[Column(name: "is_active", type: "boolean", nullable: true)]
    private ?bool $isActive;

    #[Column(type: "text", nullable: true)]
    private ?string $notes;

    public function getEquipmentId(): int
    {
        return $this->equipmentId;
    }

    public function setEquipmentId(int $value): static
    {
        $this->equipmentId = $value;
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

    public function getModelId(): ?int
    {
        return $this->modelId;
    }

    public function setModelId(?int $value): static
    {
        $this->modelId = $value;
        return $this;
    }

    public function getSerialNumber(): ?string
    {
        return HtmlDecode($this->serialNumber);
    }

    public function setSerialNumber(?string $value): static
    {
        $this->serialNumber = RemoveXss($value);
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

    public function getWarrantyExpiry(): ?DateTime
    {
        return $this->warrantyExpiry;
    }

    public function setWarrantyExpiry(?DateTime $value): static
    {
        $this->warrantyExpiry = $value;
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

    public function getLastMaintenance(): ?DateTime
    {
        return $this->lastMaintenance;
    }

    public function setLastMaintenance(?DateTime $value): static
    {
        $this->lastMaintenance = $value;
        return $this;
    }

    public function getNextMaintenance(): ?DateTime
    {
        return $this->nextMaintenance;
    }

    public function setNextMaintenance(?DateTime $value): static
    {
        $this->nextMaintenance = $value;
        return $this;
    }

    public function getClientId(): ?int
    {
        return $this->clientId;
    }

    public function setClientId(?int $value): static
    {
        $this->clientId = $value;
        return $this;
    }

    public function getInstalledBy(): ?int
    {
        return $this->installedBy;
    }

    public function setInstalledBy(?int $value): static
    {
        $this->installedBy = $value;
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

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(?bool $value): static
    {
        $this->isActive = $value;
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
