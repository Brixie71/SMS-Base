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
 * Entity class for "maintenance_actions" table
 */
#[Entity]
#[Table(name: "maintenance_actions")]
class MaintenanceAction extends AbstractEntity
{
    #[Id]
    #[Column(name: "action_id", type: "integer", unique: true)]
    #[GeneratedValue(strategy: "SEQUENCE")]
    #[SequenceGenerator(sequenceName: "maintenance_actions_action_id_seq")]
    private int $actionId;

    #[Column(name: "log_id", type: "integer", nullable: true)]
    private ?int $logId;

    #[Column(name: "action_type", type: "string", nullable: true)]
    private ?string $actionType;

    #[Column(type: "text", nullable: true)]
    private ?string $description;

    #[Column(type: "text", nullable: true)]
    private ?string $result;

    #[Column(name: "created_by", type: "integer", nullable: true)]
    private ?int $createdBy;

    #[Column(name: "created_at", type: "datetime", nullable: true)]
    private ?DateTime $createdAt;

    public function getActionId(): int
    {
        return $this->actionId;
    }

    public function setActionId(int $value): static
    {
        $this->actionId = $value;
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

    public function getActionType(): ?string
    {
        return HtmlDecode($this->actionType);
    }

    public function setActionType(?string $value): static
    {
        $this->actionType = RemoveXss($value);
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

    public function getResult(): ?string
    {
        return HtmlDecode($this->result);
    }

    public function setResult(?string $value): static
    {
        $this->result = RemoveXss($value);
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
}
