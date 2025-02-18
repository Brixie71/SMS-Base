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
 * Entity class for "manufacturers" table
 */
#[Entity]
#[Table(name: "manufacturers")]
class Manufacturer extends AbstractEntity
{
    #[Id]
    #[Column(name: "manufacturer_id", type: "integer", unique: true)]
    #[GeneratedValue(strategy: "SEQUENCE")]
    #[SequenceGenerator(sequenceName: "manufacturers_manufacturer_id_seq")]
    private int $manufacturerId;

    #[Column(type: "string")]
    private string $name;

    #[Column(name: "contact_person", type: "string", nullable: true)]
    private ?string $contactPerson;

    #[Column(name: "contact_number", type: "string", nullable: true)]
    private ?string $contactNumber;

    #[Column(type: "string", nullable: true)]
    private ?string $email;

    #[Column(type: "text", nullable: true)]
    private ?string $address;

    #[Column(type: "string", nullable: true)]
    private ?string $website;

    #[Column(name: "support_contact", type: "text", nullable: true)]
    private ?string $supportContact;

    #[Column(name: "created_by", type: "integer", nullable: true)]
    private ?int $createdBy;

    #[Column(name: "created_at", type: "datetime", nullable: true)]
    private ?DateTime $createdAt;

    #[Column(name: "updated_by", type: "integer", nullable: true)]
    private ?int $updatedBy;

    #[Column(name: "updated_at", type: "datetime", nullable: true)]
    private ?DateTime $updatedAt;

    public function getManufacturerId(): int
    {
        return $this->manufacturerId;
    }

    public function setManufacturerId(int $value): static
    {
        $this->manufacturerId = $value;
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

    public function getContactPerson(): ?string
    {
        return HtmlDecode($this->contactPerson);
    }

    public function setContactPerson(?string $value): static
    {
        $this->contactPerson = RemoveXss($value);
        return $this;
    }

    public function getContactNumber(): ?string
    {
        return HtmlDecode($this->contactNumber);
    }

    public function setContactNumber(?string $value): static
    {
        $this->contactNumber = RemoveXss($value);
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

    public function getAddress(): ?string
    {
        return HtmlDecode($this->address);
    }

    public function setAddress(?string $value): static
    {
        $this->address = RemoveXss($value);
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

    public function getSupportContact(): ?string
    {
        return HtmlDecode($this->supportContact);
    }

    public function setSupportContact(?string $value): static
    {
        $this->supportContact = RemoveXss($value);
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

    public function getUpdatedBy(): ?int
    {
        return $this->updatedBy;
    }

    public function setUpdatedBy(?int $value): static
    {
        $this->updatedBy = $value;
        return $this;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTime $value): static
    {
        $this->updatedAt = $value;
        return $this;
    }
}
