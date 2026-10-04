# Sistema de Contatos

Sistema de gestão de **pessoas** e **contatos**, desenvolvido em PHP puro com padrão MVC e Doctrine ORM.

---

## Sobre o projeto

A aplicação permite:

- Cadastrar, listar, editar, visualizar e excluir **pessoas** (nome e CPF)
- Cadastrar, listar, editar, visualizar e excluir **contatos** (telefone ou e-mail)
- Pesquisar pessoas por nome
- Relacionar vários contatos a uma mesma pessoa (1:N)

O backend foi feito **sem framework**, utilizando:

- PHP 8.2+
- Composer
- Doctrine ORM
- MySQL (via XAMPP)
- PHPUnit (testes unitários)

> **Transparência:** Exemplos de testes unitários e parte desta documentação, assim como eventuais dúvidas, foram elaborados com auxílio de inteligência artificial, sendo revisados e adaptados ao contexto do projeto.

---

## Requisitos

| Item | Observação |
|------|------------|
| PHP 8.1+ | Recomendado 8.2 (XAMPP) |
| Composer | [https://getcomposer.org](https://getcomposer.org) |
| MySQL | Via XAMPP |
| Apache | Via XAMPP |
| Git | Opcional, para clonar o repositório |

Extensões PHP utilizadas: `pdo_mysql`, `mbstring`, `json`.

---

## Como iniciar o projeto

### 1. Baixar o código

**Opção A — Clonar com Git:**

```bash
git clone https://github.com/MicaelMunsfeld/sistema-contatos.git
cd sistema-contatos
```

**Opção B — Download ZIP:**

1. Acesse o repositório no GitHub
2. Clique em **Code → Download ZIP**
3. Extraia a pasta para `C:\xampp\htdocs\`
4. Entre na pasta do projeto pelo terminal

> ⚠️ Só clonar/baixar o código **não é suficiente**. É obrigatório seguir os passos abaixo.

### 2. Instalar as dependências

Dentro da pasta do projeto, execute:

```bash
composer install
```

Isso cria a pasta `vendor/` com Doctrine, biblioteca de CPF e PHPUnit.

### 3. Configurar o banco de dados

1. Abra o **XAMPP Control Panel**
2. Inicie o **Apache** e o **MySQL**
3. Acesse o phpMyAdmin: `http://localhost/phpmyadmin`
4. Crie um banco chamado:

```text
sistema_contatos
```

Collation sugerida: `utf8mb4_general_ci`

A conexão padrão (usuário `root` sem senha) está em `config/bootstrap.php`.
Se o MySQL tiver senha, deve ser alterada neste arquivo:

```php
$dbParams = [
    'driver'   => 'pdo_mysql',
    'host'     => '127.0.0.1',
    'user'     => 'root',
    'password' => '', // coloque a senha se houver
    'dbname'   => 'sistema_contatos',
];
```

### 4. Criar as tabelas

Ainda na pasta do projeto:

```bash
php bin/doctrine.php orm:schema-tool:create
```

Isso cria as tabelas `tbpessoa` e `tbcontato`.

Para recriar do zero (**apaga os dados existentes**):

```bash
php bin/doctrine.php orm:schema-tool:drop --force
php bin/doctrine.php orm:schema-tool:create
```

### 5. Ajustar a URL base (se necessário)

No arquivo `public/index.php`, a variável `$base` deve corresponder ao caminho da pasta no `htdocs`.

Exemplos:

```php
$base = '/sistema-contatos/public';
```

Os links nas Views usam o mesmo caminho. Ajuste se o nome da pasta for diferente.

### 6. Acessar a aplicação

Com Apache e MySQL rodando, abra no navegador:

```text
http://localhost/sistema-contatos/public/pessoas
```

(ou o nome da pasta que você utilizou)

A partir daí é possível cadastrar pessoas, pesquisar por nome, gerenciar contatos, editar e excluir registros.

---

## Estrutura de pastas (Com nomenclaturas de pastas e arquivos seguindo um padrão esperado do Doctrine)

```text
sistema-contatos/
├── bin/
│   └── doctrine.php              # Console do Doctrine
├── config/
│   └── bootstrap.php             # Autoload + EntityManager
├── public/
│   ├── index.php                 # Front Controller e rotas
│   └── .htaccess                 # URLs
├── src/
│   ├── Controller/               # PessoaController, ContatoController
│   ├── Entity/                   # Pessoa, Contato (Doctrine)
│   └── View/                     # Telas
├── tests/
│   ├── Entity/                   # Testes das entidades
│   ├── Validation/               # Testes de CPF
│   └── Controller/               # Testes de operações CRUD
├── composer.json
├── phpunit.xml
└── README.md
```

---

## Funcionalidades e rotas

### Pessoas

| Ação | Método | Rota |
|------|--------|------|
| Listar / pesquisar | GET | `/pessoas` |
| Formulário novo | GET | `/pessoas/criar` |
| Salvar | POST | `/pessoas/salvar` |
| Visualizar | GET | `/pessoas/{id}` |
| Formulário editar | GET | `/pessoas/editar/{id}` |
| Atualizar | POST | `/pessoas/atualizar` |
| Excluir | GET | `/pessoas/excluir/{id}` |

### Contatos

| Ação | Método | Rota |
|------|--------|------|
| Listar | GET | `/contatos` |
| Formulário novo | GET | `/contatos/criar` |
| Salvar | POST | `/contatos/salvar` |
| Visualizar | GET | `/contatos/{id}` |
| Formulário editar | GET | `/contatos/editar/{id}` |
| Atualizar | POST | `/contatos/atualizar` |
| Excluir | GET | `/contatos/excluir/{id}` |

---

## Testes unitários

Os testes cobrem:

- Regras das entidades (`Pessoa` e `Contato`)
- Relacionamento 1:N (pessoa → contatos)
- Validação de CPF (`lacus/cpf-val`)
- Operações de CRUD com mock do `EntityManager`

### Como executar

```bash
composer exec phpunit
```

ou:

```bash
vendor\bin\phpunit
```

Exemplo de saída esperada:

```text
OK (16 tests, 40 assertions)
```

> Se o Xdebug estiver ativo e aparecer timeout no console, isso não invalida os testes.
>
> Para silenciar no PowerShell:
>
> ```powershell
> $env:XDEBUG_MODE="off"; composer exec phpunit
> ```

---

## Observações técnicas

- Sem Docker e sem framework de backend (conforme escopo do teste)
- Persistência feita somente via Doctrine ORM
- Validação de CPF com a biblioteca `lacus/cpf-val` => `composer require lacus/cpf-val`
- Frontend simples (HTML/CSS), pois não é o foco da avaliação
- Controle de versão no GitHub

---

## Problemas comuns

| Problema | Possível solução |
|----------|------------------|
| Página 404 nas rotas | Verificar `.htaccess`, `mod_rewrite` e `AllowOverride All` no Apache |
| Erro de conexão com banco | Conferir nome do banco e dados em `config/bootstrap.php` |
| `vendor/bin/doctrine` não existe | Usar `php bin/doctrine.php` (script próprio do projeto) |
| Rotas quebradas | Ajustar `$base` no `public/index.php` conforme o nome da pasta |
| Projeto não roda após o clone | Executar `composer install` e criar banco/tabelas |

---

## Autor

**Micael Munsfeld**

Repositório: [https://github.com/MicaelMunsfeld/sistema-contatos](https://github.com/MicaelMunsfeld/sistema-contatos)
