<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM, Doctrine\Common\Collections\Collection, Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity]
#[ORM\Table(name: 'tbpessoa')]
class Pessoa {

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    /**
     * O ID da pessoa.
     * 
     * @var int|null
     */
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    /**
     * O nome da pessoa.
     * 
     * @var string
     */
    private string $nome;

    #[ORM\Column(length: 14, unique: true)]
    /**
     * O CPF da pessoa.
     * 
     * @var string
     */
    private string $cpf;

    #[ORM\OneToMany(mappedBy: 'pessoa', targetEntity: Contato::class, cascade: ['persist', 'remove'])]
    /**
     * A coleção de contatos associados à pessoa.
     * 
     * @var Collection
     */
    private Collection $contatos;

    
    /**
     * Construtor da classe Pessoa, inicializando a coleção de contatos.
     */
    public function __construct() {
        $this->contatos = new ArrayCollection();
    }


    /**
     * Retorna o ID da pessoa.
     *
     * @return int|null O ID da pessoa ou null se não definido.
     */
    public function getId(): ?int { 
        return $this->id; 
    }

    /**
     * Retorna o nome da pessoa.
     *
     * @return string O nome da pessoa.
     */
    public function getNome(): string { 
        return $this->nome; 
    }

    /**
     * Define o nome da pessoa.
     *
     * @param string $nome O nome a ser definido.
     * 
     * @return self Retorna a instância atual para encadeamento de métodos.
     */
    public function setNome(string $nome): self { 
        $this->nome = $nome; return $this; 
    }

    /**
     * Retorna o CPF da pessoa.
     *
     * @return string O CPF da pessoa.
     */
    public function getCpf(): string { 
        return $this->cpf; 
    }

    /**
     * Define o CPF da pessoa.
     *
     * @param string $cpf O CPF a ser definido.
     * 
     * @return self Retorna a instância atual para encadeamento de métodos.
     */
    public function setCpf(string $cpf): self { 
        $this->cpf = $cpf; return $this; 
    }

    /**
     * Retorna a coleção de contatos associados à pessoa.
     *
     * @return Collection A coleção de contatos.
     */
    public function getContatos(): Collection { 
        return $this->contatos; 
    }

    /**
     * Adiciona um contato à coleção de contatos da pessoa.
     *
     * @param Contato $contato O contato a ser adicionado.
     * 
     * @return self Retorna a instância atual para encadeamento de métodos.
     */
    public function addContato(Contato $contato): self {
        if(!$this->contatos->contains($contato)) {
            $this->contatos->add($contato);
            $contato->setPessoa($this);
        }
        return $this;
    }
    
}