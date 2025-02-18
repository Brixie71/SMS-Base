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
 * Entity class for "maintenance_schedules" table
 */
#[Entity]
#[Table(name: "maintenance_schedules")]
class MaintenanceSchedule extends AbstractEntity
{
    #[Id]
    #[Column(name: "schedule_id", type: "integer", unique: true)]
    #[GeneratedValue(strategy: "SEQUENCE")]
    #[SequenceGenerator(sequenceName: "maintenance_schedules_schedule_id_seq")]
    private int $scheduleId;

    #[Column(name: "equipment_id", type: "integer", nullable: true)]
    private ?int $equipmentId;

    #[Column(name: "maintenance_type_id", type: "integer", nullable: true)]
    private ?int $maintenanceTypeId;

    #[Column(name: "team_id", type: "integer", nullable: true)]
    private ?int $teamId;

    #[Column(name: "scheduled_date", type: "date", nullable: true)]
    private ?DateTime $scheduledDate;

    #[Column(name: "status_id", type: "integer", nullable: true)]
    private ?int $statusId;

    #[Column(type: "string", nullable: true)]
    private ?string $priority;

    #[Column(name: "estimated_duration", type: "integer", nullable: true)]
    private ?int $estimatedDuration;

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

    public function getScheduleId(): int
    {
        return $this->scheduleId;
    }

    public function setScheduleId(int $value): static
    {
        $this->scheduleId = $value;
        return $this;
    }

    public function getEquipmentId(): ?int
    {
        return $this->equipmentId;
    }

    public function setEquipmentId(?int $value): static
    {
        $this->equipmentId = $value;
        return $this;
    }

    public function getMaintenanceTypeId(): ?int
    {
        return $this->maintenanceTypeId;
    }

    public function setMaintenanceTypeId(?int $value): static
    {
        $this->maintenanceTypeId = $value;
        return $this;
    }

    public function getTeamId(): ?int
    {
        return $this->teamId;
    }

    public function setTeamId(?int $value): static
    {
        $this->teamId = $value;
        return $this;
    }

    public function getScheduledDate(): ?DateTime
    {
        return $this->scheduledDate;
    }

    public function setScheduledDate(?DateTime $value): static
    {
        $this->scheduledDate = $value;
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

    public function getPriority(): ?string
    {
        return HtmlDecode($this->priority);
    }

    public function setPriority(?string $value): static
    {
        $this->priority = RemoveXss($value);
        return $this;
    }

    public function getEstimatedDuration(): ?int
    {
        return $this->estimatedDuration;
    }

    public function setEstimatedDuration(?int $value): static
    {
        $this->estimatedDuration = $value;
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
