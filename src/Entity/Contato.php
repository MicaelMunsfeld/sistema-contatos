<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'tbcontato')]
/**
 * Entidade representando um contato.
 */
class Contato {
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    /**
     * O ID do contato.
     * 
     * @var int|null
     */
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    /**
     * O tipo do contato (telefone ou email).
     * 
     * @var string
     */
    private string $tipo; // telefone ou email

    #[ORM\Column(length: 255)]
    /**
     * A descrição do contato.
     * 
     * @var string
     */
    private string $descricao;

    #[ORM\ManyToOne(targetEntity: Pessoa::class, inversedBy: 'contatos')]
    #[ORM\JoinColumn(nullable: false)]
    /**
     * A pessoa associada a este contato.
     * 
     * @var Pessoa
     */
    private Pessoa $pessoa;

    /**
     * Retorna o ID do contato.
     *
     * @return int|null O ID do contato ou null se não definido.
     */
    public function getId(): ?int {
        return $this->id;
    }

    /**
     * Retorna o tipo do contato.
     *
     * @return string O tipo do contato.
     */
    public function getTipo(): string {
        return $this->tipo;
    }

    /**
     * Define o tipo do contato.
     *
     * @param string $tipo O tipo do contato.
     * 
     * @return self Retorna a instância atual para encadeamento de métodos.
     */
    public function setTipo(string $tipo): self {
        $this->tipo = $tipo;
        return $this;
    }

    /**
     * Retorna a descrição do contato.
     *
     * @return string A descrição do contato.
     */
    public function getDescricao(): string {
        return $this->descricao;
    }

    /**
     * Define a descrição do contato.
     *
     * @param string $descricao A descrição do contato.
     * 
     * @return self Retorna a instância atual para encadeamento de métodos.
     */
    public function setDescricao(string $descricao): self {
        $this->descricao = $descricao;
        return $this;
    }

    /**
     * Retorna a pessoa associada a este contato.
     *
     * @return Pessoa A pessoa associada.
     */
    public function getPessoa(): Pessoa {
        return $this->pessoa;
    }

    /**
     * Define a pessoa associada a este contato.
     *
     * @param Pessoa $pessoa A pessoa a ser associada.
     * 
     * @return self Retorna a instância atual para encadeamento de métodos.
     */
    public function setPessoa(Pessoa $pessoa): self {
        $this->pessoa = $pessoa;
        return $this;
    }

}