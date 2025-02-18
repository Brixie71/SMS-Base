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
 * Entity class for "contract_terms" table
 */
#[Entity]
#[Table(name: "contract_terms")]
class ContractTerm extends AbstractEntity
{
    #[Id]
    #[Column(name: "term_id", type: "integer", unique: true)]
    #[GeneratedValue(strategy: "SEQUENCE")]
    #[SequenceGenerator(sequenceName: "contract_terms_term_id_seq")]
    private int $termId;

    #[Column(name: "contract_id", type: "integer", nullable: true)]
    private ?int $contractId;

    #[Column(name: "term_type", type: "string", nullable: true)]
    private ?string $termType;

    #[Column(type: "text", nullable: true)]
    private ?string $description;

    #[Column(type: "text", nullable: true)]
    private ?string $value;

    #[Column(type: "integer", nullable: true)]
    private ?int $priority;

    #[Column(name: "is_mandatory", type: "boolean", nullable: true)]
    private ?bool $isMandatory;

    public function getTermId(): int
    {
        return $this->termId;
    }

    public function setTermId(int $value): static
    {
        $this->termId = $value;
        return $this;
    }

    public function getContractId(): ?int
    {
        return $this->contractId;
    }

    public function setContractId(?int $value): static
    {
        $this->contractId = $value;
        return $this;
    }

    public function getTermType(): ?string
    {
        return HtmlDecode($this->termType);
    }

    public function setTermType(?string $value): static
    {
        $this->termType = RemoveXss($value);
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

    public function getValue(): ?string
    {
        return HtmlDecode($this->value);
    }

    public function setValue(?string $value): static
    {
        $this->value = RemoveXss($value);
        return $this;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setPriority(?int $value): static
    {
        $this->priority = $value;
        return $this;
    }

    public function getIsMandatory(): ?bool
    {
        return $this->isMandatory;
    }

    public function setIsMandatory(?bool $value): static
    {
        $this->isMandatory = $value;
        return $this;
    }
}
