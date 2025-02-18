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
 * Entity class for "service_requests" table
 */
#[Entity]
#[Table(name: "service_requests")]
class ServiceRequest extends AbstractEntity
{
    #[Id]
    #[Column(name: "request_id", type: "integer", unique: true)]
    #[GeneratedValue(strategy: "SEQUENCE")]
    #[SequenceGenerator(sequenceName: "service_requests_request_id_seq")]
    private int $requestId;

    #[Column(name: "client_id", type: "integer", nullable: true)]
    private ?int $clientId;

    #[Column(name: "equipment_id", type: "integer", nullable: true)]
    private ?int $equipmentId;

    #[Column(name: "request_type", type: "string", nullable: true)]
    private ?string $requestType;

    #[Column(type: "string", nullable: true)]
    private ?string $priority;

    #[Column(type: "text", nullable: true)]
    private ?string $description;

    #[Column(name: "requested_by", type: "integer", nullable: true)]
    private ?int $requestedBy;

    #[Column(name: "requested_date", type: "datetime", nullable: true)]
    private ?DateTime $requestedDate;

    #[Column(name: "scheduled_date", type: "datetime", nullable: true)]
    private ?DateTime $scheduledDate;

    #[Column(name: "completion_date", type: "datetime", nullable: true)]
    private ?DateTime $completionDate;

    #[Column(type: "string", nullable: true)]
    private ?string $status;

    #[Column(name: "assigned_to", type: "integer", nullable: true)]
    private ?int $assignedTo;

    #[Column(type: "text", nullable: true)]
    private ?string $resolution;

    #[Column(name: "response_time_minutes", type: "integer", nullable: true)]
    private ?int $responseTimeMinutes;

    #[Column(type: "text", nullable: true)]
    private ?string $notes;

    public function getRequestId(): int
    {
        return $this->requestId;
    }

    public function setRequestId(int $value): static
    {
        $this->requestId = $value;
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

    public function getEquipmentId(): ?int
    {
        return $this->equipmentId;
    }

    public function setEquipmentId(?int $value): static
    {
        $this->equipmentId = $value;
        return $this;
    }

    public function getRequestType(): ?string
    {
        return HtmlDecode($this->requestType);
    }

    public function setRequestType(?string $value): static
    {
        $this->requestType = RemoveXss($value);
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

    public function getDescription(): ?string
    {
        return HtmlDecode($this->description);
    }

    public function setDescription(?string $value): static
    {
        $this->description = RemoveXss($value);
        return $this;
    }

    public function getRequestedBy(): ?int
    {
        return $this->requestedBy;
    }

    public function setRequestedBy(?int $value): static
    {
        $this->requestedBy = $value;
        return $this;
    }

    public function getRequestedDate(): ?DateTime
    {
        return $this->requestedDate;
    }

    public function setRequestedDate(?DateTime $value): static
    {
        $this->requestedDate = $value;
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

    public function getCompletionDate(): ?DateTime
    {
        return $this->completionDate;
    }

    public function setCompletionDate(?DateTime $value): static
    {
        $this->completionDate = $value;
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

    public function getAssignedTo(): ?int
    {
        return $this->assignedTo;
    }

    public function setAssignedTo(?int $value): static
    {
        $this->assignedTo = $value;
        return $this;
    }

    public function getResolution(): ?string
    {
        return HtmlDecode($this->resolution);
    }

    public function setResolution(?string $value): static
    {
        $this->resolution = RemoveXss($value);
        return $this;
    }

    public function getResponseTimeMinutes(): ?int
    {
        return $this->responseTimeMinutes;
    }

    public function setResponseTimeMinutes(?int $value): static
    {
        $this->responseTimeMinutes = $value;
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
