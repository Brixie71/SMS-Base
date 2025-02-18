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
 * Entity class for "service_types" table
 */
#[Entity]
#[Table(name: "service_types")]
class ServiceType extends AbstractEntity
{
    #[Id]
    #[Column(name: "service_id", type: "integer", unique: true)]
    #[GeneratedValue(strategy: "SEQUENCE")]
    #[SequenceGenerator(sequenceName: "service_types_service_id_seq")]
    private int $serviceId;

    #[Column(type: "string")]
    private string $name;

    #[Column(type: "text", nullable: true)]
    private ?string $description;

    #[Column(name: "sla_hours", type: "integer", nullable: true)]
    private ?int $slaHours;

    #[Column(name: "severity_level", type: "string", nullable: true)]
    private ?string $severityLevel;

    #[Column(name: "maintenance_frequency", type: "integer", nullable: true)]
    private ?int $maintenanceFrequency;

    #[Column(name: "is_active", type: "boolean", nullable: true)]
    private ?bool $isActive;

    public function getServiceId(): int
    {
        return $this->serviceId;
    }

    public function setServiceId(int $value): static
    {
        $this->serviceId = $value;
        return $this;
    }

    public function getName(): string
    {
        return HtmlDecode($this->name);
    }

    public function setName(string $value): static
    {
        $this->name = RemoveXss($value);
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

    public function getSlaHours(): ?int
    {
        return $this->slaHours;
    }

    public function setSlaHours(?int $value): static
    {
        $this->slaHours = $value;
        return $this;
    }

    public function getSeverityLevel(): ?string
    {
        return HtmlDecode($this->severityLevel);
    }

    public function setSeverityLevel(?string $value): static
    {
        $this->severityLevel = RemoveXss($value);
        return $this;
    }

    public function getMaintenanceFrequency(): ?int
    {
        return $this->maintenanceFrequency;
    }

    public function setMaintenanceFrequency(?int $value): static
    {
        $this->maintenanceFrequency = $value;
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
}
