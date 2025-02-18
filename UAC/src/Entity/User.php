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
 * Entity class for "users" table
 */
#[Entity]
#[Table(name: "users")]
class User extends AbstractEntity
{
    #[Id]
    #[Column(name: "user_id", type: "integer", unique: true)]
    #[GeneratedValue(strategy: "SEQUENCE")]
    #[SequenceGenerator(sequenceName: "users_user_id_seq")]
    private int $userId;

    #[Column(name: "department_id", type: "integer", nullable: true)]
    private ?int $departmentId;

    #[Column(type: "string", unique: true)]
    private string $username;

    #[Column(type: "string", unique: true)]
    private string $email;

    #[Column(name: "password_hash", type: "string")]
    private string $passwordHash;

    #[Column(name: "mobile_number", type: "string", nullable: true)]
    private ?string $mobileNumber;

    #[Column(name: "first_name", type: "string", nullable: true)]
    private ?string $firstName;

    #[Column(name: "middle_name", type: "string", nullable: true)]
    private ?string $middleName;

    #[Column(name: "last_name", type: "string", nullable: true)]
    private ?string $lastName;

    #[Column(name: "date_created", type: "datetime", nullable: true)]
    private ?DateTime $dateCreated;

    #[Column(name: "last_login", type: "datetime", nullable: true)]
    private ?DateTime $lastLogin;

    #[Column(name: "is_active", type: "boolean", nullable: true)]
    private ?bool $isActive;

    #[Column(name: "user_level_id", type: "string", nullable: true)]
    private ?string $userLevelId;

    #[Column(name: "reports_to_user_id", type: "integer", nullable: true)]
    private ?int $reportsToUserId;

    #[Column(type: "string", nullable: true)]
    private ?string $photo;

    #[Column(type: "text", nullable: true)]
    private ?string $profile;

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $value): static
    {
        $this->userId = $value;
        return $this;
    }

    public function getDepartmentId(): ?int
    {
        return $this->departmentId;
    }

    public function setDepartmentId(?int $value): static
    {
        $this->departmentId = $value;
        return $this;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $value): static
    {
        $this->username = $value;
        return $this;
    }

    public function getEmail(): string
    {
        return HtmlDecode($this->email);
    }

    public function setEmail(string $value): static
    {
        $this->email = RemoveXss($value);
        return $this;
    }

    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    public function setPasswordHash(string $value): static
    {
        $this->passwordHash = EncryptPassword(Config("CASE_SENSITIVE_PASSWORD") ? $value : strtolower($value));
        return $this;
    }

    public function getMobileNumber(): ?string
    {
        return HtmlDecode($this->mobileNumber);
    }

    public function setMobileNumber(?string $value): static
    {
        $this->mobileNumber = RemoveXss($value);
        return $this;
    }

    public function getFirstName(): ?string
    {
        return HtmlDecode($this->firstName);
    }

    public function setFirstName(?string $value): static
    {
        $this->firstName = RemoveXss($value);
        return $this;
    }

    public function getMiddleName(): ?string
    {
        return HtmlDecode($this->middleName);
    }

    public function setMiddleName(?string $value): static
    {
        $this->middleName = RemoveXss($value);
        return $this;
    }

    public function getLastName(): ?string
    {
        return HtmlDecode($this->lastName);
    }

    public function setLastName(?string $value): static
    {
        $this->lastName = RemoveXss($value);
        return $this;
    }

    public function getDateCreated(): ?DateTime
    {
        return $this->dateCreated;
    }

    public function setDateCreated(?DateTime $value): static
    {
        $this->dateCreated = $value;
        return $this;
    }

    public function getLastLogin(): ?DateTime
    {
        return $this->lastLogin;
    }

    public function setLastLogin(?DateTime $value): static
    {
        $this->lastLogin = $value;
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

    public function getUserLevelId(): ?string
    {
        return $this->userLevelId;
    }

    public function setUserLevelId(?string $value): static
    {
        $this->userLevelId = $value;
        return $this;
    }

    public function getReportsToUserId(): ?int
    {
        return $this->reportsToUserId;
    }

    public function setReportsToUserId(?int $value): static
    {
        $this->reportsToUserId = $value;
        return $this;
    }

    public function getPhoto(): ?string
    {
        return HtmlDecode($this->photo);
    }

    public function setPhoto(?string $value): static
    {
        $this->photo = RemoveXss($value);
        return $this;
    }

    public function getProfile(): ?string
    {
        return HtmlDecode($this->profile);
    }

    public function setProfile(?string $value): static
    {
        $this->profile = RemoveXss($value);
        return $this;
    }

    // Get login arguments
    public function getLoginArguments(): array
    {
        return [
            "userName" => $this->get('username'),
            "userId" => $this->get('user_id'),
            "parentUserId" => $this->get('reports_to_user_id'),
            "userLevel" => $this->get('user_level_id') ?? AdvancedSecurity::ANONYMOUS_USER_LEVEL_ID,
            "userPrimaryKey" => $this->get('user_id'),
        ];
    }
}
