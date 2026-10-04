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

> **Transparência:** Exemplos de testes unitários e parte desta documentação, assim como eventuais dúvidas foram elaborados com auxílio de inteligência artificial, sendo revisados e adaptados ao contexto do projeto.

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

## Como iniciar o projeto (passo a passo)

### 1. Baixar o código

**Clonar com Git:**

```bash
git clone https://github.com/MicaelMunsfeld/sistema-contatos.git
cd sistema-contatos
