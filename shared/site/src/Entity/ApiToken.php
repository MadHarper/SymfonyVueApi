<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ApiTokenRepository")
 */
class ApiToken
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $token;

    /**
     * @ORM\Column(type="datetime")
     */
    private $axpiresAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="apiTokens")
     * @ORM\JoinColumn(nullable=false)
     */
    private $apiUser;

    public function __construct(User $user)
    {
        $this->token = bin2hex(random_bytes(60));
        $this->user = $user;
        $this->expiresAt = new \DateTime('+12 hour');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function getAxpiresAt(): ?\DateTimeInterface
    {
        return $this->axpiresAt;
    }

    public function getApiUser(): ?User
    {
        return $this->apiUser;
    }

    public function renewExpiresAt()
    {
        $this->expiresAt = new \DateTime('+1 hour');
    }

    public function isExpired(): bool
    {
        return $this->getAxpiresAt() <= new \DateTime();
    }

//    public function setToken(string $token): self
//    {
//        $this->token = $token;
//
//        return $this;
//    }
//
//    public function setAxpiresAt(\DateTimeInterface $axpiresAt): self
//    {
//        $this->axpiresAt = $axpiresAt;
//
//        return $this;
//    }
//
//
//    public function setApiUser(?User $apiUser): self
//    {
//        $this->apiUser = $apiUser;
//
//        return $this;
//    }
}
