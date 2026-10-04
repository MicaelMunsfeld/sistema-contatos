<?php

namespace Tests\Validation;

use Lacus\CpfVal\CpfValidator, PHPUnit\Framework\TestCase;

/**
 * Testes da validação de CPF.
 */
class CpfValidationTest extends TestCase {

    /**
     * @var CpfValidator
     */
    private CpfValidator $validator;

    /**
     * Configura o validador antes de cada teste.
     */
    protected function setUp(): void {
        $this->validator = new CpfValidator();
    }

    /**
     * Testa a validação de um CPF válido com máscara.
     */
    public function testCpfValidoComMascara(): void {
        $this->assertTrue($this->validator->isValid('529.982.247-25'));
    }

    /**
     * Testa a validação de um CPF válido sem máscara.
     */
    public function testCpfValidoSemMascara(): void {
        $this->assertTrue($this->validator->isValid('52998224725'));
    }

    /**
     * Testa a validação de um CPF inválido.
     */
    public function testCpfInvalido(): void {
        $this->assertFalse($this->validator->isValid('123.456.789-00'));
    }

    /**
     * Testa a validação de um CPF com caracteres não numéricos.
     */
    public function testCpfVazio(): void {
        $this->assertFalse($this->validator->isValid(''));
    }

    /**
     * Testa a validação de um CPF com tamanho incorreto.
     */
    public function testCpfComTamanhoIncorreto(): void {
        $this->assertFalse($this->validator->isValid('123'));
    }
    
}