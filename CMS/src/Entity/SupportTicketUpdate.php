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
 * Entity class for "support_ticket_updates" table
 */
#[Entity]
#[Table(name: "support_ticket_updates")]
class SupportTicketUpdate extends AbstractEntity
{
    #[Id]
    #[Column(name: "update_id", type: "integer", unique: true)]
    #[GeneratedValue(strategy: "SEQUENCE")]
    #[SequenceGenerator(sequenceName: "support_ticket_updates_update_id_seq")]
    private int $updateId;

    #[Column(name: "ticket_id", type: "integer", nullable: true)]
    private ?int $ticketId;

    #[Column(name: "update_type", type: "string", nullable: true)]
    private ?string $updateType;

    #[Column(type: "text", nullable: true)]
    private ?string $description;

    #[Column(name: "updated_by", type: "integer", nullable: true)]
    private ?int $updatedBy;

    #[Column(name: "updated_at", type: "datetime", nullable: true)]
    private ?DateTime $updatedAt;

    #[Column(type: "string", nullable: true)]
    private ?string $status;

    public function getUpdateId(): int
    {
        return $this->updateId;
    }

    public function setUpdateId(int $value): static
    {
        $this->updateId = $value;
        return $this;
    }

    public function getTicketId(): ?int
    {
        return $this->ticketId;
    }

    public function setTicketId(?int $value): static
    {
        $this->ticketId = $value;
        return $this;
    }

    public function getUpdateType(): ?string
    {
        return HtmlDecode($this->updateType);
    }

    public function setUpdateType(?string $value): static
    {
        $this->updateType = RemoveXss($value);
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

    public function getStatus(): ?string
    {
        return HtmlDecode($this->status);
    }

    public function setStatus(?string $value): static
    {
        $this->status = RemoveXss($value);
        return $this;
    }
}
