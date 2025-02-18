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
 * Entity class for "maintenance_logs" table
 */
#[Entity]
#[Table(name: "maintenance_logs")]
class MaintenanceLog extends AbstractEntity
{
    #[Id]
    #[Column(name: "log_id", type: "integer", unique: true)]
    #[GeneratedValue(strategy: "SEQUENCE")]
    #[SequenceGenerator(sequenceName: "maintenance_logs_log_id_seq")]
    private int $logId;

    #[Column(name: "schedule_id", type: "integer", nullable: true)]
    private ?int $scheduleId;

    #[Column(name: "start_time", type: "datetime", nullable: true)]
    private ?DateTime $startTime;

    #[Column(name: "end_time", type: "datetime", nullable: true)]
    private ?DateTime $endTime;

    #[Column(name: "performed_by", type: "integer", nullable: true)]
    private ?int $performedBy;

    #[Column(name: "verified_by", type: "integer", nullable: true)]
    private ?int $verifiedBy;

    #[Column(name: "status_id", type: "integer", nullable: true)]
    private ?int $statusId;

    #[Column(name: "next_maintenance_date", type: "date", nullable: true)]
    private ?DateTime $nextMaintenanceDate;

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

    public function getLogId(): int
    {
        return $this->logId;
    }

    public function setLogId(int $value): static
    {
        $this->logId = $value;
        return $this;
    }

    public function getScheduleId(): ?int
    {
        return $this->scheduleId;
    }

    public function setScheduleId(?int $value): static
    {
        $this->scheduleId = $value;
        return $this;
    }

    public function getStartTime(): ?DateTime
    {
        return $this->startTime;
    }

    public function setStartTime(?DateTime $value): static
    {
        $this->startTime = $value;
        return $this;
    }

    public function getEndTime(): ?DateTime
    {
        return $this->endTime;
    }

    public function setEndTime(?DateTime $value): static
    {
        $this->endTime = $value;
        return $this;
    }

    public function getPerformedBy(): ?int
    {
        return $this->performedBy;
    }

    public function setPerformedBy(?int $value): static
    {
        $this->performedBy = $value;
        return $this;
    }

    public function getVerifiedBy(): ?int
    {
        return $this->verifiedBy;
    }

    public function setVerifiedBy(?int $value): static
    {
        $this->verifiedBy = $value;
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

    public function getNextMaintenanceDate(): ?DateTime
    {
        return $this->nextMaintenanceDate;
    }

    public function setNextMaintenanceDate(?DateTime $value): static
    {
        $this->nextMaintenanceDate = $value;
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
