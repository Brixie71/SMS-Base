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
 * Entity class for "client_documents" table
 */
#[Entity]
#[Table(name: "client_documents")]
class ClientDocument extends AbstractEntity
{
    #[Id]
    #[Column(name: "document_id", type: "integer", unique: true)]
    #[GeneratedValue(strategy: "SEQUENCE")]
    #[SequenceGenerator(sequenceName: "client_documents_document_id_seq")]
    private int $documentId;

    #[Column(name: "client_id", type: "integer", nullable: true)]
    private ?int $clientId;

    #[Column(name: "document_type", type: "string", nullable: true)]
    private ?string $documentType;

    #[Column(type: "string", nullable: true)]
    private ?string $title;

    #[Column(name: "file_path", type: "text", nullable: true)]
    private ?string $filePath;

    #[Column(name: "upload_date", type: "datetime", nullable: true)]
    private ?DateTime $uploadDate;

    #[Column(name: "expiry_date", type: "date", nullable: true)]
    private ?DateTime $expiryDate;

    #[Column(type: "string", nullable: true)]
    private ?string $status;

    #[Column(name: "uploaded_by", type: "integer", nullable: true)]
    private ?int $uploadedBy;

    #[Column(type: "text", nullable: true)]
    private ?string $notes;

    public function getDocumentId(): int
    {
        return $this->documentId;
    }

    public function setDocumentId(int $value): static
    {
        $this->documentId = $value;
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

    public function getDocumentType(): ?string
    {
        return HtmlDecode($this->documentType);
    }

    public function setDocumentType(?string $value): static
    {
        $this->documentType = RemoveXss($value);
        return $this;
    }

    public function getTitle(): ?string
    {
        return HtmlDecode($this->title);
    }

    public function setTitle(?string $value): static
    {
        $this->title = RemoveXss($value);
        return $this;
    }

    public function getFilePath(): ?string
    {
        return HtmlDecode($this->filePath);
    }

    public function setFilePath(?string $value): static
    {
        $this->filePath = RemoveXss($value);
        return $this;
    }

    public function getUploadDate(): ?DateTime
    {
        return $this->uploadDate;
    }

    public function setUploadDate(?DateTime $value): static
    {
        $this->uploadDate = $value;
        return $this;
    }

    public function getExpiryDate(): ?DateTime
    {
        return $this->expiryDate;
    }

    public function setExpiryDate(?DateTime $value): static
    {
        $this->expiryDate = $value;
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

    public function getUploadedBy(): ?int
    {
        return $this->uploadedBy;
    }

    public function setUploadedBy(?int $value): static
    {
        $this->uploadedBy = $value;
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
