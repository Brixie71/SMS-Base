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
 * Entity class for "unit_categories" table
 */
#[Entity]
#[Table(name: "unit_categories")]
class UnitCategory extends AbstractEntity
{
    #[Id]
    #[Column(name: "category_id", type: "integer", unique: true)]
    #[GeneratedValue(strategy: "SEQUENCE")]
    #[SequenceGenerator(sequenceName: "unit_categories_category_id_seq")]
    private int $categoryId;

    #[Column(type: "string")]
    private string $name;

    #[Column(type: "text", nullable: true)]
    private ?string $description;

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function setCategoryId(int $value): static
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
