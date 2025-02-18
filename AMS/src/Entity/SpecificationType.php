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
 * Entity class for "specification_types" table
 */
#[Entity]
#[Table(name: "specification_types")]
class SpecificationType extends AbstractEntity
{
    #[Id]
    #[Column(name: "spec_type_id", type: "integer", unique: true)]
    #[GeneratedValue(strategy: "SEQUENCE")]
    #[SequenceGenerator(sequenceName: "specification_types_spec_type_id_seq")]
    private int $specTypeId;

    #[Column(type: "string")]
    private string $name;

    #[Column(type: "text", nullable: true)]
    private ?string $description;

    #[Column(name: "data_type", type: "string", nullable: true)]
    private ?string $dataType;

    #[Column(name: "unit_category_id", type: "integer", nullable: true)]
    private ?int $unitCategoryId;

    #[Column(name: "validation_rules", type: "json", nullable: true)]
    private mixed $validationRules;

    #[Column(name: "is_required", type: "boolean", nullable: true)]
    private ?bool $isRequired;

    public function getSpecTypeId(): int
    {
        return $this->specTypeId;
    }

    public function setSpecTypeId(int $value): static
    {
        $this->specTypeId = $value;
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

    public function getDataType(): ?string
    {
        return HtmlDecode($this->dataType);
    }

    public function setDataType(?string $value): static
    {
        $this->dataType = RemoveXss($value);
        return $this;
    }

    public function getUnitCategoryId(): ?int
    {
        return $this->unitCategoryId;
    }

    public function setUnitCategoryId(?int $value): static
    {
        $this->unitCategoryId = $value;
        return $this;
    }

    public function getValidationRules(): mixed
    {
        return HtmlDecode($this->validationRules);
    }

    public function setValidationRules(mixed $value): static
    {
        $this->validationRules = RemoveXss($value);
        return $this;
    }

    public function getIsRequired(): ?bool
    {
        return $this->isRequired;
    }

    public function setIsRequired(?bool $value): static
    {
        $this->isRequired = $value;
        return $this;
    }
}
