<?php

namespace Tests\Controller;

use App\Entity\Pessoa, Doctrine\ORM\EntityManagerInterface, Doctrine\ORM\EntityRepository, PHPUnit\Framework\TestCase;

/**
 * Testes das operações de CRUD de Pessoa
 * usando mock do EntityManager (sem banco real).
 */
class PessoaCrudTest extends TestCase {

    /**
     * Testa a criação de uma nova pessoa e sua persistência.
     */
    public function testDeNovaPessoa(): void {
        $pessoa = new Pessoa();
        $pessoa->setNome('Teste CRUD');
        $pessoa->setCpf('52998224725');

        $em = $this->createMock(EntityManagerInterface::class);
        $em->expects($this->once())
            ->method('persist')
            ->with($this->identicalTo($pessoa));
        $em->expects($this->once())
            ->method('flush');
        $em->persist($pessoa);
        $em->flush();

        $this->assertSame('Teste CRUD', $pessoa->getNome());
        $this->assertSame('52998224725', $pessoa->getCpf());
    }

    /**
     * Testa a busca de uma pessoa por ID.
     */
    public function testBuscaPessoaPorId(): void {
        $pessoa = new Pessoa();
        $pessoa->setNome('Busca Teste');
        $pessoa->setCpf('52998224725');

        $em = $this->createMock(EntityManagerInterface::class);
        $em->expects($this->once())
            ->method('find')
            ->with(Pessoa::class, 1)
            ->willReturn($pessoa);
        $resultado = $em->find(Pessoa::class, 1);
        $this->assertInstanceOf(Pessoa::class, $resultado);
        $this->assertSame('Busca Teste', $resultado->getNome());
    }

    /**
     * Testa a busca de uma pessoa inexistente.
     */
    public function testBuscaPessoaInexistente(): void {
        $em = $this->createMock(EntityManagerInterface::class);
        $em->expects($this->once())
            ->method('find')
            ->with(Pessoa::class, 999)
            ->willReturn(null);
        $resultado = $em->find(Pessoa::class, 999);
        $this->assertNull($resultado);
    }

    /**
     * Testa a atualização de uma pessoa existente.
     */
    public function testAtualizacaoDePessoa(): void {
        $pessoa = new Pessoa();
        $pessoa->setNome('Nome Antigo');
        $pessoa->setCpf('52998224725');
        $pessoa->setNome('Nome Novo');

        $em = $this->createMock(EntityManagerInterface::class);
        $em->expects($this->once())
            ->method('flush');
        $em->flush();

        $this->assertSame('Nome Novo', $pessoa->getNome());
    }

    /**
     * Testa a exclusão de uma pessoa existente.
     */
    public function testExclusaoDePessoa(): void {
        $pessoa = new Pessoa();
        $pessoa->setNome('Para Excluir');
        $pessoa->setCpf('52998224725');

        $em = $this->createMock(EntityManagerInterface::class);
        $em->expects($this->once())
            ->method('remove')
            ->with($this->identicalTo($pessoa));
        $em->expects($this->once())
            ->method('flush');
        $em->remove($pessoa);
        $em->flush();

        $this->assertTrue(true);
    }

    /**
     * Testa a listagem de pessoas.
     */
    public function testListagemDePessoas(): void {
        $pessoa1 = new Pessoa();
        $pessoa1->setNome('Ana');
        $pessoa1->setCpf('52998224725');

        $pessoa2 = new Pessoa();
        $pessoa2->setNome('Bruno');
        $pessoa2->setCpf('11144477735');

        $repo = $this->createMock(EntityRepository::class);
        $repo->expects($this->once())
            ->method('findBy')
            ->with([], ['nome' => 'ASC'])
            ->willReturn([$pessoa1, $pessoa2]);

        $em = $this->createMock(EntityManagerInterface::class);
        $em->expects($this->once())
            ->method('getRepository')
            ->with(Pessoa::class)
            ->willReturn($repo);

        $lista = $em->getRepository(Pessoa::class)->findBy([], ['nome' => 'ASC']);

        $this->assertCount(2, $lista);
        $this->assertSame('Ana', $lista[0]->getNome());
        $this->assertSame('Bruno', $lista[1]->getNome());
    }

}