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
 * Entity class for "support_tickets" table
 */
#[Entity]
#[Table(name: "support_tickets")]
class SupportTicket extends AbstractEntity
{
    #[Id]
    #[Column(name: "ticket_id", type: "integer", unique: true)]
    #[GeneratedValue(strategy: "SEQUENCE")]
    #[SequenceGenerator(sequenceName: "support_tickets_ticket_id_seq")]
    private int $ticketId;

    #[Column(name: "client_id", type: "integer", nullable: true)]
    private ?int $clientId;

    #[Column(name: "equipment_id", type: "integer", nullable: true)]
    private ?int $equipmentId;

    #[Column(type: "string", nullable: true)]
    private ?string $subject;

    #[Column(type: "text", nullable: true)]
    private ?string $description;

    #[Column(type: "string", nullable: true)]
    private ?string $priority;

    #[Column(type: "string", nullable: true)]
    private ?string $category;

    #[Column(name: "submitted_by", type: "integer", nullable: true)]
    private ?int $submittedBy;

    #[Column(name: "assigned_to", type: "integer", nullable: true)]
    private ?int $assignedTo;

    #[Column(name: "created_at", type: "datetime", nullable: true)]
    private ?DateTime $createdAt;

    #[Column(type: "string", nullable: true)]
    private ?string $status;

    #[Column(type: "text", nullable: true)]
    private ?string $resolution;

    #[Column(name: "closed_at", type: "datetime", nullable: true)]
    private ?DateTime $closedAt;

    #[Column(name: "response_time_minutes", type: "integer", nullable: true)]
    private ?int $responseTimeMinutes;

    #[Column(name: "resolution_time_minutes", type: "integer", nullable: true)]
    private ?int $resolutionTimeMinutes;

    #[Column(name: "sla_compliant", type: "boolean", nullable: true)]
    private ?bool $slaCompliant;

    #[Column(name: "closed_by", type: "integer", nullable: true)]
    private ?int $closedBy;

    public function getTicketId(): int
    {
        return $this->ticketId;
    }

    public function setTicketId(int $value): static
    {
        $this->ticketId = $value;
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

    public function getSubject(): ?string
    {
        return HtmlDecode($this->subject);
    }

    public function setSubject(?string $value): static
    {
        $this->subject = RemoveXss($value);
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

    public function getPriority(): ?string
    {
        return HtmlDecode($this->priority);
    }

    public function setPriority(?string $value): static
    {
        $this->priority = RemoveXss($value);
        return $this;
    }

    public function getCategory(): ?string
    {
        return HtmlDecode($this->category);
    }

    public function setCategory(?string $value): static
    {
        $this->category = RemoveXss($value);
        return $this;
    }

    public function getSubmittedBy(): ?int
    {
        return $this->submittedBy;
    }

    public function setSubmittedBy(?int $value): static
    {
        $this->submittedBy = $value;
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

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTime $value): static
    {
        $this->createdAt = $value;
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

    public function getResolution(): ?string
    {
        return HtmlDecode($this->resolution);
    }

    public function setResolution(?string $value): static
    {
        $this->resolution = RemoveXss($value);
        return $this;
    }

    public function getClosedAt(): ?DateTime
    {
        return $this->closedAt;
    }

    public function setClosedAt(?DateTime $value): static
    {
        $this->closedAt = $value;
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

    public function getResolutionTimeMinutes(): ?int
    {
        return $this->resolutionTimeMinutes;
    }

    public function setResolutionTimeMinutes(?int $value): static
    {
        $this->resolutionTimeMinutes = $value;
        return $this;
    }

    public function getSlaCompliant(): ?bool
    {
        return $this->slaCompliant;
    }

    public function setSlaCompliant(?bool $value): static
    {
        $this->slaCompliant = $value;
        return $this;
    }

    public function getClosedBy(): ?int
    {
        return $this->closedBy;
    }

    public function setClosedBy(?int $value): static
    {
        $this->closedBy = $value;
        return $this;
    }
}
