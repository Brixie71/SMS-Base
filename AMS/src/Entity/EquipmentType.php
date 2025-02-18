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
 * Entity class for "equipment_types" table
 */
#[Entity]
#[Table(name: "equipment_types")]
class EquipmentType extends AbstractEntity
{
    #[Id]
    #[Column(name: "type_id", type: "integer", unique: true)]
    #[GeneratedValue(strategy: "SEQUENCE")]
    #[SequenceGenerator(sequenceName: "equipment_types_type_id_seq")]
    private int $typeId;

    #[Column(type: "string")]
    private string $name;

    #[Column(type: "string", nullable: true)]
    private ?string $category;

    #[Column(type: "text", nullable: true)]
    private ?string $description;

    #[Column(name: "maintenance_interval", type: "integer", nullable: true)]
    private ?int $maintenanceInterval;

    #[Column(name: "requires_certification", type: "boolean", nullable: true)]
    private ?bool $requiresCertification;

    #[Column(name: "created_by", type: "integer", nullable: true)]
    private ?int $createdBy;

    #[Column(name: "created_at", type: "datetime", nullable: true)]
    private ?DateTime $createdAt;

    #[Column(name: "updated_by", type: "integer", nullable: true)]
    private ?int $updatedBy;

    #[Column(name: "updated_at", type: "datetime", nullable: true)]
    private ?DateTime $updatedAt;

    public function getTypeId(): int
    {
        return $this->typeId;
    }

    public function setTypeId(int $value): static
    {
        $this->typeId = $value;
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

    public function getCategory(): ?string
    {
        return HtmlDecode($this->category);
    }

    public function setCategory(?string $value): static
    {
        $this->category = RemoveXss($value);
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

    public function getMaintenanceInterval(): ?int
    {
        return $this->maintenanceInterval;
    }

    public function setMaintenanceInterval(?int $value): static
    {
        $this->maintenanceInterval = $value;
        return $this;
    }

    public function getRequiresCertification(): ?bool
    {
        return $this->requiresCertification;
    }

    public function setRequiresCertification(?bool $value): static
    {
        $this->requiresCertification = $value;
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
}
