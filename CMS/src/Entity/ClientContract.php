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
 * Entity class for "client_contracts" table
 */
#[Entity]
#[Table(name: "client_contracts")]
class ClientContract extends AbstractEntity
{
    #[Id]
    #[Column(name: "contract_id", type: "integer", unique: true)]
    #[GeneratedValue(strategy: "SEQUENCE")]
    #[SequenceGenerator(sequenceName: "client_contracts_contract_id_seq")]
    private int $contractId;

    #[Column(name: "client_id", type: "integer", nullable: true)]
    private ?int $clientId;

    #[Column(name: "contract_code", type: "string", unique: true)]
    private string $contractCode;

    #[Column(name: "start_date", type: "date", nullable: true)]
    private ?DateTime $startDate;

    #[Column(name: "end_date", type: "date", nullable: true)]
    private ?DateTime $endDate;

    #[Column(type: "string", nullable: true)]
    private ?string $status;

    #[Column(name: "contract_type", type: "string", nullable: true)]
    private ?string $contractType;

    #[Column(name: "service_level", type: "string", nullable: true)]
    private ?string $serviceLevel;

    #[Column(name: "auto_renewal", type: "boolean", nullable: true)]
    private ?bool $autoRenewal;

    #[Column(name: "renewal_notice_days", type: "integer", nullable: true)]
    private ?int $renewalNoticeDays;

    #[Column(name: "created_by", type: "integer", nullable: true)]
    private ?int $createdBy;

    #[Column(name: "created_at", type: "datetime", nullable: true)]
    private ?DateTime $createdAt;

    public function getContractId(): int
    {
        return $this->contractId;
    }

    public function setContractId(int $value): static
    {
        $this->contractId = $value;
        return $this;
    }

    public function getClientId(): ?int
    {
        return $this->clientId;
    }

    public function setClientId(?int $value): static
    {
        $this->clientId = $value;
        return $this;
    }

    public function getContractCode(): string
    {
        return HtmlDecode($this->contractCode);
    }

    public function setContractCode(string $value): static
    {
        $this->contractCode = RemoveXss($value);
        return $this;
    }

    public function getStartDate(): ?DateTime
    {
        return $this->startDate;
    }

    public function setStartDate(?DateTime $value): static
    {
        $this->startDate = $value;
        return $this;
    }

    public function getEndDate(): ?DateTime
    {
        return $this->endDate;
    }

    public function setEndDate(?DateTime $value): static
    {
        $this->endDate = $value;
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

    public function getContractType(): ?string
    {
        return HtmlDecode($this->contractType);
    }

    public function setContractType(?string $value): static
    {
        $this->contractType = RemoveXss($value);
        return $this;
    }

    public function getServiceLevel(): ?string
    {
        return HtmlDecode($this->serviceLevel);
    }

    public function setServiceLevel(?string $value): static
    {
        $this->serviceLevel = RemoveXss($value);
        return $this;
    }

    public function getAutoRenewal(): ?bool
    {
        return $this->autoRenewal;
    }

    public function setAutoRenewal(?bool $value): static
    {
        $this->autoRenewal = $value;
        return $this;
    }

    public function getRenewalNoticeDays(): ?int
    {
        return $this->renewalNoticeDays;
    }

    public function setRenewalNoticeDays(?int $value): static
    {
        $this->renewalNoticeDays = $value;
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
