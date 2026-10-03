<?php

namespace App\Controller;

use App\Entity\Pessoa, Doctrine\ORM\EntityManagerInterface;

class PessoaController {

    public function __construct(private EntityManagerInterface $em) {}

    public function index(): void {
        $busca = $_GET['busca'] ?? '';
        $repo = $this->em->getRepository(Pessoa::class);

        if ($busca !== '') {
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

    public function create(): void {
        require __DIR__ . '/../View/pessoa/form.php';
    }

    public function store(): void {
        $pessoa = new Pessoa();
        $pessoa->setNome(trim($_POST['nome'] ?? ''));
        $pessoa->setCpf(trim($_POST['cpf'] ?? ''));

        $this->em->persist($pessoa);
        $this->em->flush();

        header('Location: /magazord-teste/public/pessoas');
        exit;
    }

    public function show(int $id): void {
        $pessoa = $this->em->find(Pessoa::class, $id);
        if (!$pessoa) {
            http_response_code(404);
            echo 'Pessoa não encontrada';
            return;
        }
        require __DIR__ . '/../View/pessoa/show.php';
    }

    public function edit(int $id): void {
        $pessoa = $this->em->find(Pessoa::class, $id);
        if (!$pessoa) {
            http_response_code(404);
            echo 'Pessoa não encontrada';
            return;
        }
        require __DIR__ . '/../View/pessoa/form.php';
    }

    public function update(): void {
        $id = (int)($_POST['id'] ?? 0);
        $pessoa = $this->em->find(Pessoa::class, $id);
        if (!$pessoa) {
            http_response_code(404);
            echo 'Pessoa não encontrada';
            return;
        }

        $pessoa->setNome(trim($_POST['nome'] ?? ''));
        $pessoa->setCpf(trim($_POST['cpf'] ?? ''));
        $this->em->flush();

        header('Location: /magazord-teste/public/pessoas');
        exit;
    }

    public function delete(int $id): void {
        $pessoa = $this->em->find(Pessoa::class, $id);
        if ($pessoa) {
            $this->em->remove($pessoa);
            $this->em->flush();
        }
        header('Location: /magazord-teste/public/pessoas');
        exit;
    }
    
}