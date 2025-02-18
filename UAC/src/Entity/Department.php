<?php

namespace PHPMaker2024\UAC\Entity;

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
use PHPMaker2024\UAC\AbstractEntity;
use PHPMaker2024\UAC\AdvancedSecurity;
use PHPMaker2024\UAC\UserProfile;
use function PHPMaker2024\UAC\Config;
use function PHPMaker2024\UAC\EntityManager;
use function PHPMaker2024\UAC\RemoveXss;
use function PHPMaker2024\UAC\HtmlDecode;
use function PHPMaker2024\UAC\EncryptPassword;

/**
 * Entity class for "departments" table
 */
#[Entity]
#[Table(name: "departments")]
class Department extends AbstractEntity
{
    #[Id]
    #[Column(name: "department_id", type: "integer", unique: true)]
    #[GeneratedValue(strategy: "SEQUENCE")]
    #[SequenceGenerator(sequenceName: "departments_department_id_seq")]
    private int $departmentId;

    #[Column(name: "department_name", type: "string", unique: true)]
    private string $departmentName;

    #[Column(type: "text", nullable: true)]
    private ?string $description;

    public function getDepartmentId(): int
    {
        return $this->departmentId;
    }

    public function setDepartmentId(int $value): static
    {
        $this->departmentId = $value;
        return $this;
    }

    public function getDepartmentName(): string
    {
        return HtmlDecode($this->departmentName);
    }

    public function setDepartmentName(string $value): static
    {
        $this->departmentName = RemoveXss($value);
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
