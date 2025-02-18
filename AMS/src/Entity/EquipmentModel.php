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
 * Entity class for "equipment_models" table
 */
#[Entity]
#[Table(name: "equipment_models")]
class EquipmentModel extends AbstractEntity
{
    #[Id]
    #[Column(name: "model_id", type: "integer", unique: true)]
    #[GeneratedValue(strategy: "SEQUENCE")]
    #[SequenceGenerator(sequenceName: "equipment_models_model_id_seq")]
    private int $modelId;

    #[Column(name: "manufacturer_id", type: "integer", nullable: true)]
    private ?int $manufacturerId;

    #[Column(name: "type_id", type: "integer", nullable: true)]
    private ?int $typeId;

    #[Column(name: "model_number", type: "string")]
    private string $modelNumber;

    #[Column(type: "string", nullable: true)]
    private ?string $name;

    #[Column(type: "text", nullable: true)]
    private ?string $description;

    #[Column(type: "json", nullable: true)]
    private mixed $specifications;

    #[Column(name: "support_end_date", type: "date", nullable: true)]
    private ?DateTime $supportEndDate;

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

    public function getModelId(): int
    {
        return $this->modelId;
    }

    public function setModelId(int $value): static
    {
        $this->modelId = $value;
        return $this;
    }

    public function getManufacturerId(): ?int
    {
        return $this->manufacturerId;
    }

    public function setManufacturerId(?int $value): static
    {
        $this->manufacturerId = $value;
        return $this;
    }

    public function getTypeId(): ?int
    {
        return $this->typeId;
    }

    public function setTypeId(?int $value): static
    {
        $this->typeId = $value;
        return $this;
    }

    public function getModelNumber(): string
    {
        return HtmlDecode($this->modelNumber);
    }

    public function setModelNumber(string $value): static
    {
        $this->modelNumber = RemoveXss($value);
        return $this;
    }

    public function getName(): ?string
    {
        return HtmlDecode($this->name);
    }

    public function setName(?string $value): static
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

    public function getSpecifications(): mixed
    {
        return HtmlDecode($this->specifications);
    }

    public function setSpecifications(mixed $value): static
    {
        $this->specifications = RemoveXss($value);
        return $this;
    }

    public function getSupportEndDate(): ?DateTime
    {
        return $this->supportEndDate;
    }

    public function setSupportEndDate(?DateTime $value): static
    {
        $this->supportEndDate = $value;
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
