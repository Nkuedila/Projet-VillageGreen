<?php

namespace App\Entity;

use App\Repository\LivraisonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LivraisonRepository::class)]
class Livraison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_livraison = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse_livraison = null;

    #[ORM\ManyToOne(inversedBy: 'livraisons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Commande $commande = null;

    #[ORM\OneToMany(targetEntity: DetailsLivraison::class, mappedBy: 'livraison', cascade: ['persist', 'remove'])]
    private Collection $detailsLivraisons;

    public function __construct()
    {
        $this->detailsLivraisons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateLivraison(): ?\DateTimeInterface
    {
        return $this->date_livraison;
    }

    public function setDateLivraison(\DateTimeInterface $date_livraison): static
    {
        $this->date_livraison = $date_livraison;

        return $this;
    }

    public function getAdresseLivraison(): ?string
    {
        return $this->adresse_livraison;
    }

    public function setAdresseLivraison(string $adresse_livraison): static
    {
        $this->adresse_livraison = $adresse_livraison;

        return $this;
    }

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(?Commande $commande): static
    {
        $this->commande = $commande;

        return $this;
    }

    /**
     * @return Collection<int, DetailsLivraison>
     */
    public function getDetailsLivraisons(): Collection
    {
        return $this->detailsLivraisons;
    }

    public function addDetailsLivraison(DetailsLivraison $detailsLivraison): static
    {
        if (!$this->detailsLivraisons->contains($detailsLivraison)) {
            $this->detailsLivraisons->add($detailsLivraison);
            $detailsLivraison->setLivraison($this);
        }

        return $this;
    }

    public function removeDetailsLivraison(DetailsLivraison $detailsLivraison): static
    {
        if ($this->detailsLivraisons->removeElement($detailsLivraison)) {
            if ($detailsLivraison->getLivraison() === $this) {
                $detailsLivraison->setLivraison(null);
            }
        }

        return $this;
    }
}
