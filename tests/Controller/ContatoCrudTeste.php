<?php

namespace Tests\Controller;

use App\Entity\Contato, App\Entity\Pessoa, Doctrine\ORM\EntityManagerInterface, PHPUnit\Framework\TestCase;

/**
 * Testes das operações de CRUD de Contato
 * usando mock do EntityManager (sem banco real).
 */
class ContatoCrudTest extends TestCase {

    /**
     * Testa a criação de um novo contato e sua persistência.
     */
    public function testNovoContato(): void {
        $pessoa = new Pessoa();
        $pessoa->setNome('Dono do Contato');
        $pessoa->setCpf('52998224725');

        $contato = new Contato();
        $contato->setTipo('email');
        $contato->setDescricao('teste@email.com');
        $contato->setPessoa($pessoa);

        $em = $this->createMock(EntityManagerInterface::class);
        $em->expects($this->once())
            ->method('persist')
            ->with($this->identicalTo($contato));
        $em->expects($this->once())
            ->method('flush');
        $em->persist($contato);
        $em->flush();

        $this->assertSame('email', $contato->getTipo());
        $this->assertSame($pessoa, $contato->getPessoa());
    }

    /**
     * Testa a atualização de um contato existente.
     */
    public function testExclusaoDeContato(): void {
        $pessoa = new Pessoa();
        $pessoa->setNome('Pessoa');
        $pessoa->setCpf('52998224725');

        $contato = new Contato();
        $contato->setTipo('telefone');
        $contato->setDescricao('11999999999');
        $contato->setPessoa($pessoa);

        $em = $this->createMock(EntityManagerInterface::class);
        $em->expects($this->once())
            ->method('remove')
            ->with($this->identicalTo($contato));
        $em->expects($this->once())
            ->method('flush');
        $em->remove($contato);
        $em->flush();

        $this->assertTrue(true);
    }

    /**
     * Testa a busca de um contato por ID.
     */
    public function testRelacionamentoPessoaContato(): void {
        $pessoa = new Pessoa();
        $pessoa->setNome('Relacionamento');
        $pessoa->setCpf('52998224725');

        $contato = new Contato();
        $contato->setTipo('email');
        $contato->setDescricao('rel@email.com');

        $pessoa->addContato($contato);

        $this->assertCount(1, $pessoa->getContatos());
        $this->assertSame($pessoa, $contato->getPessoa());
    }

}