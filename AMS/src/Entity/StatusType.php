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
 * Entity class for "status_types" table
 */
#[Entity]
#[Table(name: "status_types")]
class StatusType extends AbstractEntity
{
    #[Id]
    #[Column(name: "status_id", type: "integer", unique: true)]
    #[GeneratedValue(strategy: "SEQUENCE")]
    #[SequenceGenerator(sequenceName: "status_types_status_id_seq")]
    private int $statusId;

    #[Column(type: "string")]
    private string $category;

    #[Column(type: "string")]
    private string $name;

    #[Column(type: "text", nullable: true)]
    private ?string $description;

    #[Column(name: "is_operational", type: "boolean", nullable: true)]
    private ?bool $isOperational;

    #[Column(name: "color_code", type: "string", nullable: true)]
    private ?string $colorCode;

    #[Column(name: "icon_class", type: "string", nullable: true)]
    private ?string $iconClass;

    #[Column(name: "sequence_no", type: "integer", nullable: true)]
    private ?int $sequenceNo;

    public function getStatusId(): int
    {
        return $this->statusId;
    }

    public function setStatusId(int $value): static
    {
        $this->statusId = $value;
        return $this;
    }

    public function getCategory(): string
    {
        return HtmlDecode($this->category);
    }

    public function setCategory(string $value): static
    {
        $this->category = RemoveXss($value);
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

    public function getIsOperational(): ?bool
    {
        return $this->isOperational;
    }

    public function setIsOperational(?bool $value): static
    {
        $this->isOperational = $value;
        return $this;
    }

    public function getColorCode(): ?string
    {
        return HtmlDecode($this->colorCode);
    }

    public function setColorCode(?string $value): static
    {
        $this->colorCode = RemoveXss($value);
        return $this;
    }

    public function getIconClass(): ?string
    {
        return HtmlDecode($this->iconClass);
    }

    public function setIconClass(?string $value): static
    {
        $this->iconClass = RemoveXss($value);
        return $this;
    }

    public function getSequenceNo(): ?int
    {
        return $this->sequenceNo;
    }

    public function setSequenceNo(?int $value): static
    {
        $this->sequenceNo = $value;
        return $this;
    }
}
