<?php

namespace Tests\Entity;

use App\Entity\Pessoa, App\Entity\Contato, PHPUnit\Framework\TestCase;

/**
 * Testes da entidade Pessoa.
 */
class PessoaTest extends TestCase {

    /**
     * Testa a criação de uma pessoa com nome e CPF.
     */
    public function testPodeCriarPessoaComNomeECpf(): void {
        $pessoa = new Pessoa();
        $pessoa->setNome('Maria Silva');
        $pessoa->setCpf('529.982.247-25');

        $this->assertSame('Maria Silva', $pessoa->getNome());
        $this->assertSame('529.982.247-25', $pessoa->getCpf());
        $this->assertNull($pessoa->getId());
    }

    /**
     * Testa que uma pessoa inicia sem contatos.
     */
    public function testPessoaIniciaSemContatos(): void {
        $pessoa = new Pessoa();
        $this->assertCount(0, $pessoa->getContatos());
    }

    /**
     * Testa a adição de um contato a uma pessoa.
     */
    public function testPodeAdicionarContatoNaPessoa(): void {
        $pessoa = new Pessoa();
        $pessoa->setNome('João');
        $pessoa->setCpf('52998224725');

        $contato = new Contato();
        $contato->setTipo('email');
        $contato->setDescricao('joao@email.com');

        $pessoa->addContato($contato);

        $this->assertCount(1, $pessoa->getContatos());
        $this->assertSame($pessoa, $contato->getPessoa());
        $this->assertTrue($pessoa->getContatos()->contains($contato));
    }

    /**
     * Testa que um contato não é duplicado ao ser adicionado duas vezes.
     */
    public function testNaoDuplicaContatoAoAdicionarDuasVezes(): void {
        $pessoa = new Pessoa();
        $pessoa->setNome('Ana');
        $pessoa->setCpf('52998224725');

        $contato = new Contato();
        $contato->setTipo('telefone');
        $contato->setDescricao('11999999999');

        $pessoa->addContato($contato);
        $pessoa->addContato($contato);

        $this->assertCount(1, $pessoa->getContatos());
    }
    
}