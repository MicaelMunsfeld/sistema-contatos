<?php

namespace App\Controller;

use App\Entity\Contato, App\Entity\Pessoa, Doctrine\ORM\EntityManagerInterface;

/**
 * Controlador gerenciador dos contatos.
 */
class ContatoController {

    /**
     * Construtor do controlador.
     *
     * @param EntityManagerInterface $em O gerenciador de entidades do Doctrine.
     */
    public function __construct(private EntityManagerInterface $em) {}


    /**
     * Exibe a lista de contatos.
     */
    public function index(): void {
        $contatos = $this->em->getRepository(Contato::class)->findBy([], ['id' => 'DESC']);
        require __DIR__ . '/../View/contato/index.php';
    }

    /**
     * Exibe o formulário para criar um novo contato.
     */
    public function create(): void {
        $pessoas = $this->em->getRepository(Pessoa::class)->findBy([], ['nome' => 'ASC']);
        require __DIR__ . '/../View/contato/form.php';
    }

    /**
     * Salva um novo contato no banco de dados.
     */
    public function store(): void {
        $pessoaId = (int)($_POST['pessoa_id'] ?? 0);
        $pessoa = $this->em->find(Pessoa::class, $pessoaId);
        if(!$pessoa) {
            echo 'Pessoa inválida';
            return;
        }
        $contato = new Contato();
        $contato->setTipo($_POST['tipo'] ?? 'telefone');
        $contato->setDescricao(trim($_POST['descricao'] ?? ''));
        $contato->setPessoa($pessoa);
        $this->em->persist($contato);
        $this->em->flush();

        header('Location: /magazord-teste/public/contatos');
        exit;
    }

    /**
     * Exibe os detalhes de um contato específico.
     *
     * @param int $id O ID do contato a ser exibido.
     */
    public function show(int $id): void {
        $contato = $this->em->find(Contato::class, $id);
        if(!$contato) {
            http_response_code(404);
            echo 'Contato não encontrado';
            return;
        }
        require __DIR__ . '/../View/contato/show.php';
    }

    /**
     * Exibe o formulário para editar um contato existente.
     *
     * @param int $id O ID do contato a ser editado.
     */
    public function edit(int $id): void {
        $contato = $this->em->find(Contato::class, $id);
        if(!$contato) {
            http_response_code(404);
            echo 'Contato não encontrado';
            return;
        }
        $pessoas = $this->em->getRepository(Pessoa::class)->findBy([], ['nome' => 'ASC']);
        require __DIR__ . '/../View/contato/form.php';
    }

    /**
     * Atualiza um contato existente no banco de dados.
     */
    public function update(): void {
        $id = (int)($_POST['id'] ?? 0);
        $contato = $this->em->find(Contato::class, $id);
        if(!$contato) {
            http_response_code(404);
            echo 'Contato não encontrado';
            return;
        }
        $pessoaId = (int)($_POST['pessoa_id'] ?? 0);
        $pessoa = $this->em->find(Pessoa::class, $pessoaId);
        if(!$pessoa) {
            echo 'Pessoa inválida';
            return;
        }
        $contato->setTipo($_POST['tipo'] ?? 'telefone');
        $contato->setDescricao(trim($_POST['descricao'] ?? ''));
        $contato->setPessoa($pessoa);
        $this->em->flush();

        header('Location: /magazord-teste/public/contatos');
        exit;
    }

    /**
     * Exclui um contato do banco de dados.
     *
     * @param int $id O ID do contato a ser excluído.
     */
    public function delete(int $id): void {
        $contato = $this->em->find(Contato::class, $id);
        if($contato) {
            $this->em->remove($contato);
            $this->em->flush();
        }
        header('Location: /magazord-teste/public/contatos');
        exit;
    }
    
}