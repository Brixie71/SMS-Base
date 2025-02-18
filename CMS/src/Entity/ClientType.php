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
 * Entity class for "client_types" table
 */
#[Entity]
#[Table(name: "client_types")]
class ClientType extends AbstractEntity
{
    #[Id]
    #[Column(name: "type_id", type: "integer", unique: true)]
    #[GeneratedValue(strategy: "SEQUENCE")]
    #[SequenceGenerator(sequenceName: "client_types_type_id_seq")]
    private int $typeId;

    #[Column(type: "string")]
    private string $name;

    #[Column(type: "text", nullable: true)]
    private ?string $description;

    #[Column(name: "priority_level", type: "integer", nullable: true)]
    private ?int $priorityLevel;

    #[Column(name: "is_active", type: "boolean", nullable: true)]
    private ?bool $isActive;

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

    public function getDescription(): ?string
    {
        return HtmlDecode($this->description);
    }

    public function setDescription(?string $value): static
    {
        $this->description = RemoveXss($value);
        return $this;
    }

    public function getPriorityLevel(): ?int
    {
        return $this->priorityLevel;
    }

    public function setPriorityLevel(?int $value): static
    {
        $this->priorityLevel = $value;
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
