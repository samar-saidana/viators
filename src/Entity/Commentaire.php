<?php

namespace App\Entity;

use App\Repository\CommentaireRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentaireRepository::class)
 */
class Commentaire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")

     */
    private $date_com;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $comm_avis;

    /**
     * @ORM\ManyToOne(targetEntity=Avis::class, inversedBy="commentaires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $avis;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCom(): ?\DateTimeInterface
    {
        return $this->date_com;
    }

    public function setDateCom(\DateTimeInterface $date_com): self
    {
        $this->date_com = $date_com;

        return $this;
    }

    public function getCommAvis(): ?string
    {
        return $this->comm_avis;
    }

    public function setCommAvis(string $comm_avis): self
    {
        $this->comm_avis = $comm_avis;

        return $this;
    }

    public function getAvis(): ?Avis
    {
        return $this->avis;
    }

    public function setAvis(?Avis $avis): self
    {
        $this->avis = $avis;

        return $this;
    }
    public function __toString()
    {
       return $this->getCommAvis();

    }

    public function __construct()
    {
        $this->date_com = new \DateTime('now');
    }
}
