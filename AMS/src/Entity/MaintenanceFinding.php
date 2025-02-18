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
 * Entity class for "maintenance_findings" table
 */
#[Entity]
#[Table(name: "maintenance_findings")]
class MaintenanceFinding extends AbstractEntity
{
    #[Id]
    #[Column(name: "finding_id", type: "integer", unique: true)]
    #[GeneratedValue(strategy: "SEQUENCE")]
    #[SequenceGenerator(sequenceName: "maintenance_findings_finding_id_seq")]
    private int $findingId;

    #[Column(name: "log_id", type: "integer", nullable: true)]
    private ?int $logId;

    #[Column(name: "finding_type", type: "string", nullable: true)]
    private ?string $findingType;

    #[Column(type: "text", nullable: true)]
    private ?string $description;

    #[Column(type: "string", nullable: true)]
    private ?string $severity;

    #[Column(type: "text", nullable: true)]
    private ?string $recommendation;

    #[Column(name: "created_by", type: "integer", nullable: true)]
    private ?int $createdBy;

    #[Column(name: "created_at", type: "datetime", nullable: true)]
    private ?DateTime $createdAt;

    public function getFindingId(): int
    {
        return $this->findingId;
    }

    public function setFindingId(int $value): static
    {
        $this->findingId = $value;
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

    public function getFindingType(): ?string
    {
        return HtmlDecode($this->findingType);
    }

    public function setFindingType(?string $value): static
    {
        $this->findingType = RemoveXss($value);
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

    public function getSeverity(): ?string
    {
        return HtmlDecode($this->severity);
    }

    public function setSeverity(?string $value): static
    {
        $this->severity = RemoveXss($value);
        return $this;
    }

    public function getRecommendation(): ?string
    {
        return HtmlDecode($this->recommendation);
    }

    public function setRecommendation(?string $value): static
    {
        $this->recommendation = RemoveXss($value);
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
