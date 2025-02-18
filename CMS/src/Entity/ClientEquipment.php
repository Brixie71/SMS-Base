<?php

namespace PHPMaker2024\CMS\Entity;

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
use PHPMaker2024\CMS\AbstractEntity;
use PHPMaker2024\CMS\AdvancedSecurity;
use PHPMaker2024\CMS\UserProfile;
use function PHPMaker2024\CMS\Config;
use function PHPMaker2024\CMS\EntityManager;
use function PHPMaker2024\CMS\RemoveXss;
use function PHPMaker2024\CMS\HtmlDecode;
use function PHPMaker2024\CMS\EncryptPassword;

/**
 * Entity class for "client_equipment" table
 */
#[Entity]
#[Table(name: "client_equipment")]
class ClientEquipment extends AbstractEntity
{
    #[Id]
    #[Column(name: "equipment_id", type: "integer", unique: true)]
    #[GeneratedValue(strategy: "SEQUENCE")]
    #[SequenceGenerator(sequenceName: "client_equipment_equipment_id_seq")]
    private int $equipmentId;

    #[Column(name: "client_id", type: "integer", nullable: true)]
    private ?int $clientId;

    #[Column(name: "contract_id", type: "integer", nullable: true)]
    private ?int $contractId;

    #[Column(name: "tower_equipment_id", type: "integer", nullable: true)]
    private ?int $towerEquipmentId;

    #[Column(name: "installation_date", type: "date", nullable: true)]
    private ?DateTime $installationDate;

    #[Column(name: "removal_date", type: "date", nullable: true)]
    private ?DateTime $removalDate;

    #[Column(type: "string", nullable: true)]
    private ?string $status;

    #[Column(name: "maintenance_schedule", type: "string", nullable: true)]
    private ?string $maintenanceSchedule;

    #[Column(name: "last_maintenance_date", type: "date", nullable: true)]
    private ?DateTime $lastMaintenanceDate;

    #[Column(name: "next_maintenance_date", type: "date", nullable: true)]
    private ?DateTime $nextMaintenanceDate;

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

    public function getClientId(): ?int
    {
        return $this->clientId;
    }

    public function setClientId(?int $value): static
    {
        $this->clientId = $value;
        return $this;
    }

    public function getContractId(): ?int
    {
        return $this->contractId;
    }

    public function setContractId(?int $value): static
    {
        $this->contractId = $value;
        return $this;
    }

    public function getTowerEquipmentId(): ?int
    {
        return $this->towerEquipmentId;
    }

    public function setTowerEquipmentId(?int $value): static
    {
        $this->towerEquipmentId = $value;
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

    public function getRemovalDate(): ?DateTime
    {
        return $this->removalDate;
    }

    public function setRemovalDate(?DateTime $value): static
    {
        $this->removalDate = $value;
        return $this;
    }

    public function getStatus(): ?string
    {
        return HtmlDecode($this->status);
    }

    public function setStatus(?string $value): static
    {
        $this->status = RemoveXss($value);
        return $this;
    }

    public function getMaintenanceSchedule(): ?string
    {
        return HtmlDecode($this->maintenanceSchedule);
    }

    public function setMaintenanceSchedule(?string $value): static
    {
        $this->maintenanceSchedule = RemoveXss($value);
        return $this;
    }

    public function getLastMaintenanceDate(): ?DateTime
    {
        return $this->lastMaintenanceDate;
    }

    public function setLastMaintenanceDate(?DateTime $value): static
    {
        $this->lastMaintenanceDate = $value;
        return $this;
    }

    public function getNextMaintenanceDate(): ?DateTime
    {
        return $this->nextMaintenanceDate;
    }

    public function setNextMaintenanceDate(?DateTime $value): static
    {
        $this->nextMaintenanceDate = $value;
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
