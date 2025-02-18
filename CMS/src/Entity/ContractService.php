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
 * Entity class for "contract_services" table
 */
#[Entity]
#[Table(name: "contract_services")]
class ContractService extends AbstractEntity
{
    #[Id]
    #[Column(name: "contract_id", type: "integer")]
    private int $contractId;

    #[Id]
    #[Column(name: "service_id", type: "integer")]
    private int $serviceId;

    #[Column(type: "decimal", nullable: true)]
    private ?string $quantity;

    #[Column(name: "start_date", type: "date", nullable: true)]
    private ?DateTime $startDate;

    #[Column(name: "end_date", type: "date", nullable: true)]
    private ?DateTime $endDate;

    #[Column(type: "string", nullable: true)]
    private ?string $status;

    #[Column(name: "sla_terms", type: "text", nullable: true)]
    private ?string $slaTerms;

    #[Column(type: "text", nullable: true)]
    private ?string $notes;

    public function __construct(int $contractId, int $serviceId)
    {
        $this->contractId = $contractId;
        $this->serviceId = $serviceId;
    }

    public function getContractId(): int
    {
        return $this->contractId;
    }

    public function setContractId(int $value): static
    {
        $this->contractId = $value;
        return $this;
    }

    public function getServiceId(): int
    {
        return $this->serviceId;
    }

    public function setServiceId(int $value): static
    {
        $this->serviceId = $value;
        return $this;
    }

    public function getQuantity(): ?string
    {
        return $this->quantity;
    }

    public function setQuantity(?string $value): static
    {
        $this->quantity = $value;
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

    public function getSlaTerms(): ?string
    {
        return HtmlDecode($this->slaTerms);
    }

    public function setSlaTerms(?string $value): static
    {
        $this->slaTerms = RemoveXss($value);
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
}
