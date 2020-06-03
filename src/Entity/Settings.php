<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SettingsRepository")
 */
class Settings
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $keyword;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $mobile;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $fax;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $google;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $recapctha;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $map;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $facebook;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $twitter;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $instagram;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $youtube;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $smtp_user;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $smtp_password;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $smtp_host;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $smtp_port;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getKeyword(): ?string
    {
        return $this->keyword;
    }

    public function setKeyword(?string $keyword): self
    {
        $this->keyword = $keyword;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getMobile(): ?string
    {
        return $this->mobile;
    }

    public function setMobile(?string $mobile): self
    {
        $this->mobile = $mobile;

        return $this;
    }

    public function getFax(): ?string
    {
        return $this->fax;
    }

    public function setFax(?string $fax): self
    {
        $this->fax = $fax;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(?string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getGoogle(): ?string
    {
        return $this->google;
    }

    public function setGoogle(?string $google): self
    {
        $this->google = $google;

        return $this;
    }

    public function getRecapctha(): ?string
    {
        return $this->recapctha;
    }

    public function setRecapctha(?string $recapctha): self
    {
        $this->recapctha = $recapctha;

        return $this;
    }

    public function getMap(): ?string
    {
        return $this->map;
    }

    public function setMap(?string $map): self
    {
        $this->map = $map;

        return $this;
    }

    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    public function setFacebook(?string $facebook): self
    {
        $this->facebook = $facebook;

        return $this;
    }

    public function getTwitter(): ?string
    {
        return $this->twitter;
    }

    public function setTwitter(?string $twitter): self
    {
        $this->twitter = $twitter;

        return $this;
    }

    public function getInstagram(): ?string
    {
        return $this->instagram;
    }

    public function setInstagram(string $instagram): self
    {
        $this->instagram = $instagram;

        return $this;
    }

    public function getYoutube(): ?string
    {
        return $this->youtube;
    }

    public function setYoutube(?string $youtube): self
    {
        $this->youtube = $youtube;

        return $this;
    }

    public function getSmtpUser(): ?string
    {
        return $this->smtp_user;
    }

    public function setSmtpUser(?string $smtp_user): self
    {
        $this->smtp_user = $smtp_user;

        return $this;
    }

    public function getSmtpPassword(): ?string
    {
        return $this->smtp_password;
    }

    public function setSmtpPassword(?string $smtp_password): self
    {
        $this->smtp_password = $smtp_password;

        return $this;
    }

    public function getSmtpHost(): ?string
    {
        return $this->smtp_host;
    }

    public function setSmtpHost(?string $smtp_host): self
    {
        $this->smtp_host = $smtp_host;

        return $this;
    }

    public function getSmtpPort(): ?string
    {
        return $this->smtp_port;
    }

    public function setSmtpPort(?string $smtp_port): self
    {
        $this->smtp_port = $smtp_port;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

}
