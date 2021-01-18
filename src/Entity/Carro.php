<?php

namespace App\Entity;

use App\Repository\CarroRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CarroRepository::class)
 * @ORM\Table(name="carro")
 */
class Carro
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
     * @ORM\ManyToOne(targetEntity=Fabricante::class, inversedBy="carros")
     */
    private $fabricante;

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

    public function getFabricante(): ?Fabricante
    {
        return $this->fabricante;
    }

    public function setFabricante(?Fabricante $fabricante): self
    {
        $this->fabricante = $fabricante;

        return $this;
    }

    public function __toString(): string
    {
        return $this->nome;
    }
}
