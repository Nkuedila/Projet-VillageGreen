<?php

namespace App\Entity;

use App\Repository\DetailsLivraisonRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetailsLivraisonRepository::class)]
class DetailsLivraison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?INT $quantite = null;

    #[ORM\ManyToOne(inversedBy: 'detailsLivraisons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Produits $produits = null;

    #[ORM\ManyToOne(targetEntity: Livraison::class, inversedBy: 'detailsLivraisons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Livraison $livraison = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite ): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getProduits(): ?Produits
    {
        return $this->produits;
    }

    public function setProduits(?Produits $produits): static
    {
        $this->produits = $produits;

        return $this;
    }

    public function getLivraison(): ?Livraison
    {
        return $this->livraison;
    }

    public function setLivraison(?Livraison $livraison): static
    {
        $this->livraison = $livraison;

        return $this;
    }
}
