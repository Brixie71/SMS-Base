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
 * Entity class for "client_contacts" table
 */
#[Entity]
#[Table(name: "client_contacts")]
class ClientContact extends AbstractEntity
{
    #[Id]
    #[Column(name: "contact_id", type: "integer", unique: true)]
    #[GeneratedValue(strategy: "SEQUENCE")]
    #[SequenceGenerator(sequenceName: "client_contacts_contact_id_seq")]
    private int $contactId;

    #[Column(name: "client_id", type: "integer", nullable: true)]
    private ?int $clientId;

    #[Column(type: "string")]
    private string $name;

    #[Column(type: "string", nullable: true)]
    private ?string $position;

    #[Column(type: "string", nullable: true)]
    private ?string $email;

    #[Column(type: "string", nullable: true)]
    private ?string $phone;

    #[Column(type: "string", nullable: true)]
    private ?string $mobile;

    #[Column(name: "is_primary", type: "boolean", nullable: true)]
    private ?bool $isPrimary;

    #[Column(name: "is_technical", type: "boolean", nullable: true)]
    private ?bool $isTechnical;

    #[Column(type: "text", nullable: true)]
    private ?string $notes;

    public function getContactId(): int
    {
        return $this->contactId;
    }

    public function setContactId(int $value): static
    {
        $this->contactId = $value;
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

    public function getName(): string
    {
        return HtmlDecode($this->name);
    }

    public function setName(string $value): static
    {
        $this->name = RemoveXss($value);
        return $this;
    }

    public function getPosition(): ?string
    {
        return HtmlDecode($this->position);
    }

    public function setPosition(?string $value): static
    {
        $this->position = RemoveXss($value);
        return $this;
    }

    public function getEmail(): ?string
    {
        return HtmlDecode($this->email);
    }

    public function setEmail(?string $value): static
    {
        $this->email = RemoveXss($value);
        return $this;
    }

    public function getPhone(): ?string
    {
        return HtmlDecode($this->phone);
    }

    public function setPhone(?string $value): static
    {
        $this->phone = RemoveXss($value);
        return $this;
    }

    public function getMobile(): ?string
    {
        return HtmlDecode($this->mobile);
    }

    public function setMobile(?string $value): static
    {
        $this->mobile = RemoveXss($value);
        return $this;
    }

    public function getIsPrimary(): ?bool
    {
        return $this->isPrimary;
    }

    public function setIsPrimary(?bool $value): static
    {
        $this->isPrimary = $value;
        return $this;
    }

    public function getIsTechnical(): ?bool
    {
        return $this->isTechnical;
    }

    public function setIsTechnical(?bool $value): static
    {
        $this->isTechnical = $value;
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
