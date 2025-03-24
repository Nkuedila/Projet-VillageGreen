<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Trait\SlugTrait;
use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;


#[ORM\Entity(repositoryClass: CategoriesRepository::class)]
#[ApiResource(normalizationContext: ['groups' => ['read:category']])]
class Categories
{
    use SlugTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read:category', 'read:produit'])]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Groups(['read:category', 'read:produit'])]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['read:category', 'read:produit'])]
    private ?string $image = null;

    /*    #[ORM\Column]
    private ?int $categoryCommande = null;  */

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'categories')]
    #[ORM\JoinColumn(name: 'parent_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    #[Groups(['read:category'])]

    private ?self $parent = null;

    /**
     * @var Collection<int, self>
     */
    #[ORM\OneToMany(targetEntity: Categories::class, mappedBy: 'parent')]
    #[Groups(['read:category'])]
    private Collection $categories;

    /**
     * @var Collection<int, Produits>
     */
    #[ORM\OneToMany(targetEntity: Produits::class, mappedBy: 'categories')]
    #[Groups(['read:category'])]
    private Collection $produits;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->produits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    /*     public function getCategoryCommande(): ?int
    {
        return $this->categoryCommande;
    }

    public function setCategoryCommande(int $categoryCommande): self
    {
        $this->categoryCommande = $categoryCommande;

        return $this;
    }  */

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): static
    {
        $this->parent = $parent;

        return $this;
    }


    /**
     *  @return Collection<int, self>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(self $category): static
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
            $category->setParent($this);
        }

        return $this;
    }

    public function removeCategory(self $category): static
    {
        if ($this->categories->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getParent() === $this) {
                $category->setParent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Produits>
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produits $produit): static
    {
        if (!$this->produits->contains($produit)) {
            $this->produits->add($produit);
            $produit->setCategories($this);
        }

        return $this;
    }

    public function removeProduit(Produits $produit): static
    {
        if ($this->produits->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getCategories() === $this) {
                $produit->setCategories(null);
            }
        }

        return $this;
    }
}
