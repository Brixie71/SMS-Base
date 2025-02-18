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
 * Entity class for "clients" table
 */
#[Entity]
#[Table(name: "clients")]
class Client extends AbstractEntity
{
    #[Id]
    #[Column(name: "client_id", type: "integer", unique: true)]
    #[GeneratedValue(strategy: "SEQUENCE")]
    #[SequenceGenerator(sequenceName: "clients_client_id_seq")]
    private int $clientId;

    #[Column(name: "client_code", type: "string", unique: true)]
    private string $clientCode;

    #[Column(name: "company_name", type: "string")]
    private string $companyName;

    #[Column(name: "type_id", type: "integer", nullable: true)]
    private ?int $typeId;

    #[Column(type: "string", nullable: true)]
    private ?string $status;

    #[Column(name: "account_manager_id", type: "integer", nullable: true)]
    private ?int $accountManagerId;

    #[Column(name: "registration_date", type: "date", nullable: true)]
    private ?DateTime $registrationDate;

    #[Column(type: "string", nullable: true)]
    private ?string $website;

    #[Column(type: "text", nullable: true)]
    private ?string $notes;

    #[Column(name: "created_by", type: "integer", nullable: true)]
    private ?int $createdBy;

    #[Column(name: "created_at", type: "datetime", nullable: true)]
    private ?DateTime $createdAt;

    public function getClientId(): int
    {
        return $this->clientId;
    }

    public function setClientId(int $value): static
    {
        $this->clientId = $value;
        return $this;
    }

    public function getClientCode(): string
    {
        return HtmlDecode($this->clientCode);
    }

    public function setClientCode(string $value): static
    {
        $this->clientCode = RemoveXss($value);
        return $this;
    }

    public function getCompanyName(): string
    {
        return HtmlDecode($this->companyName);
    }

    public function setCompanyName(string $value): static
    {
        $this->companyName = RemoveXss($value);
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

    public function getStatus(): ?string
    {
        return HtmlDecode($this->status);
    }

    public function setStatus(?string $value): static
    {
        $this->status = RemoveXss($value);
        return $this;
    }

    public function getAccountManagerId(): ?int
    {
        return $this->accountManagerId;
    }

    public function setAccountManagerId(?int $value): static
    {
        $this->accountManagerId = $value;
        return $this;
    }

    public function getRegistrationDate(): ?DateTime
    {
        return $this->registrationDate;
    }

    public function setRegistrationDate(?DateTime $value): static
    {
        $this->registrationDate = $value;
        return $this;
    }

    public function getWebsite(): ?string
    {
        return HtmlDecode($this->website);
    }

    public function setWebsite(?string $value): static
    {
        $this->website = RemoveXss($value);
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
