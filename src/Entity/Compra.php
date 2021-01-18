<?php

namespace App\Entity;

use App\Repository\CompraRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompraRepository::class)
 */
class Compra
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Cliente::class, inversedBy="compras")
     */
    private $cliente;

    /**
     * @ORM\ManyToMany(targetEntity=Carro::class)
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

    public function getCliente(): ?Cliente
    {
        return $this->cliente;
    }

    public function setCliente(?Cliente $cliente): self
    {
        $this->cliente = $cliente;

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
        }

        return $this;
    }

    public function removeCarro(Carro $carro): self
    {
        $this->carros->removeElement($carro);

        return $this;
    }
}
