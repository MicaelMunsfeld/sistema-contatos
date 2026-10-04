<?php

namespace Tests\Entity;

use App\Entity\Contato, App\Entity\Pessoa, PHPUnit\Framework\TestCase;

/**
 * Testes das entidades Contato e Pessoa.
 */
class ContatoTest extends TestCase {

    /**
     * Testa a criação de um contato e sua associação a uma pessoa.
     */
    public function testPodeCriarContatoTelefone(): void {
        $pessoa = new Pessoa();
        $pessoa->setNome('Carlos');
        $pessoa->setCpf('52998224725');

        $contato = new Contato();
        $contato->setTipo('telefone');
        $contato->setDescricao('11988887777');
        $contato->setPessoa($pessoa);

        $this->assertSame('telefone', $contato->getTipo());
        $this->assertSame('11988887777', $contato->getDescricao());
        $this->assertSame($pessoa, $contato->getPessoa());
        $this->assertNull($contato->getId());
    }

    /**
     * Testa a criação de um contato do tipo email e sua associação a uma pessoa.
     */
    public function testPodeCriarContatoEmail(): void {
        $pessoa = new Pessoa();
        $pessoa->setNome('Carla');
        $pessoa->setCpf('52998224725');

        $contato = new Contato();
        $contato->setTipo('email');
        $contato->setDescricao('carla@teste.com');
        $contato->setPessoa($pessoa);

        $this->assertSame('email', $contato->getTipo());
        $this->assertSame('carla@teste.com', $contato->getDescricao());
    }
    
}