<?php

namespace App\Controller;

use App\Entity\Pessoa, Doctrine\ORM\EntityManagerInterface, Lacus\CpfVal\CpfValidator;

/**
 * Controlador gerenciador das pessoas.
 */
class PessoaController {

    /**
     * Construtor do controlador.
     *
     * @param EntityManagerInterface $em O gerenciador de entidades do Doctrine.
     */
    public function __construct(private EntityManagerInterface $em) {}


    /**
     * Exibe a lista de pessoas.
     */
    public function index(): void {
        $busca = $_GET['busca'] ?? '';
        $repo = $this->em->getRepository(Pessoa::class);
        if($busca !== '') {
            $pessoas = $repo->createQueryBuilder('p')
                ->where('p.nome LIKE :busca')
                ->setParameter('busca', '%' . $busca . '%')
                ->orderBy('p.nome', 'ASC')
                ->getQuery()
                ->getResult();
        } else {
            $pessoas = $repo->findBy([], ['nome' => 'ASC']);
        }
        require __DIR__ . '/../View/pessoa/index.php';
    }

    /**
     * Exibe o formulário para criar uma nova pessoa.
     */
    public function create(): void {
        require __DIR__ . '/../View/pessoa/form.php';
    }

    /**
     * Salva uma nova pessoa no banco de dados.
     */
    public function store(): void {
        $pessoa = new Pessoa();
        $pessoa->setNome(trim($_POST['nome'] ?? ''));
        if(!(new CpfValidator())->isValid($_POST['cpf'] ?? '')) {
            echo 'CPF inválido';
            return;
        }
        $pessoa->setCpf(trim($_POST['cpf'] ?? ''));
        $this->em->persist($pessoa);
        $this->em->flush();
        
        header('Location: /magazord-teste/public/pessoas');
        exit;
    }

    /**
     * Exibe os detalhes de uma pessoa específica.
     *
     * @param int $id O ID da pessoa a ser exibida.
     */
    public function show(int $id): void {
        $pessoa = $this->em->find(Pessoa::class, $id);
        if(!$pessoa) {
            http_response_code(404);
            echo 'Pessoa não encontrada';
            return;
        }
        require __DIR__ . '/../View/pessoa/show.php';
    }

    /**
     * Exibe o formulário para editar uma pessoa existente.
     *
     * @param int $id O ID da pessoa a ser editada.
     */
    public function edit(int $id): void {
        $pessoa = $this->em->find(Pessoa::class, $id);
        if(!$pessoa) {
            http_response_code(404);
            echo 'Pessoa não encontrada';
            return;
        }
        require __DIR__ . '/../View/pessoa/form.php';
    }

    /**
     * Atualiza uma pessoa existente no banco de dados.
     */
    public function update(): void {
        $id = (int)($_POST['id'] ?? 0);
        $pessoa = $this->em->find(Pessoa::class, $id);
        if(!$pessoa) {
            http_response_code(404);
            echo 'Pessoa não encontrada';
            return;
        }
        $pessoa->setNome(trim($_POST['nome'] ?? ''));
        if(!(new CpfValidator())->isValid($_POST['cpf'] ?? '')) {
            echo 'CPF inválido';
            return;
        }
        $pessoa->setCpf(trim($_POST['cpf'] ?? ''));
        $this->em->flush();

        header('Location: /magazord-teste/public/pessoas');
        exit;
    }

    /**
     * Exclui uma pessoa do banco de dados.
     *
     * @param int $id O ID da pessoa a ser excluída.
     */
    public function delete(int $id): void {
        $pessoa = $this->em->find(Pessoa::class, $id);
        if($pessoa) {
            $this->em->remove($pessoa);
            $this->em->flush();
        }
        header('Location: /magazord-teste/public/pessoas');
        exit;
    }
    
}