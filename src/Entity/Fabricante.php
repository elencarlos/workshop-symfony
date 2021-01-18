<?php

namespace App\Entity;

use App\Repository\FabricanteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FabricanteRepository::class)
 * @ORM\Table(name="fabricante")
 */
class Fabricante
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nome;

    /**
     * @ORM\OneToMany(targetEntity=Carro::class, mappedBy="fabricante")
     */
    private $carros;

    public function __construct()
    {
        $this->carros = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * @return Collection|Carro[]
     */
    public function getCarros(): Collection
    {
        return $this->carros;
    }

    public function addCarro(Carro $carro): self
    {
        if (!$this->carros->contains($carro)) {
            $this->carros[] = $carro;
            $carro->setFabricante($this);
        }

        return $this;
    }

    public function removeCarro(Carro $carro): self
    {
        if ($this->carros->removeElement($carro)) {
            // set the owning side to null (unless already changed)
            if ($carro->getFabricante() === $this) {
                $carro->setFabricante(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nome;
    }
}
