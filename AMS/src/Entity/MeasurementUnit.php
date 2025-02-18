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
 * Entity class for "measurement_units" table
 */
#[Entity]
#[Table(name: "measurement_units")]
class MeasurementUnit extends AbstractEntity
{
    #[Id]
    #[Column(name: "unit_id", type: "integer", unique: true)]
    #[GeneratedValue(strategy: "SEQUENCE")]
    #[SequenceGenerator(sequenceName: "measurement_units_unit_id_seq")]
    private int $unitId;

    #[Column(name: "category_id", type: "integer", nullable: true)]
    private ?int $categoryId;

    #[Column(type: "string")]
    private string $name;

    #[Column(type: "string")]
    private string $symbol;

    #[Column(name: "conversion_factor", type: "decimal", nullable: true)]
    private ?string $conversionFactor;

    #[Column(name: "base_unit_id", type: "integer", nullable: true)]
    private ?int $baseUnitId;

    #[Column(type: "text", nullable: true)]
    private ?string $description;

    public function getUnitId(): int
    {
        return $this->unitId;
    }

    public function setUnitId(int $value): static
    {
        $this->unitId = $value;
        return $this;
    }

    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }

    public function setCategoryId(?int $value): static
    {
        $this->categoryId = $value;
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

    public function getSymbol(): string
    {
        return HtmlDecode($this->symbol);
    }

    public function setSymbol(string $value): static
    {
        $this->symbol = RemoveXss($value);
        return $this;
    }

    public function getConversionFactor(): ?string
    {
        return $this->conversionFactor;
    }

    public function setConversionFactor(?string $value): static
    {
        $this->conversionFactor = $value;
        return $this;
    }

    public function getBaseUnitId(): ?int
    {
        return $this->baseUnitId;
    }

    public function setBaseUnitId(?int $value): static
    {
        $this->baseUnitId = $value;
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
}
