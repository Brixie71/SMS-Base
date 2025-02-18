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
 * Entity class for "team_members" table
 */
#[Entity]
#[Table(name: "team_members")]
class TeamMember extends AbstractEntity
{
    #[Id]
    #[Column(name: "team_id", type: "integer")]
    private int $teamId;

    #[Id]
    #[Column(name: "user_id", type: "integer")]
    private int $userId;

    #[Column(type: "string", nullable: true)]
    private ?string $role;

    #[Column(name: "assigned_date", type: "date", nullable: true)]
    private ?DateTime $assignedDate;

    #[Column(name: "created_by", type: "integer", nullable: true)]
    private ?int $createdBy;

    #[Column(name: "created_at", type: "datetime", nullable: true)]
    private ?DateTime $createdAt;

    public function __construct(int $teamId, int $userId)
    {
        $this->teamId = $teamId;
        $this->userId = $userId;
    }

    public function getTeamId(): int
    {
        return $this->teamId;
    }

    public function setTeamId(int $value): static
    {
        $this->teamId = $value;
        return $this;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $value): static
    {
        $this->userId = $value;
        return $this;
    }

    public function getRole(): ?string
    {
        return HtmlDecode($this->role);
    }

    public function setRole(?string $value): static
    {
        $this->role = RemoveXss($value);
        return $this;
    }

    public function getAssignedDate(): ?DateTime
    {
        return $this->assignedDate;
    }

    public function setAssignedDate(?DateTime $value): static
    {
        $this->assignedDate = $value;
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
