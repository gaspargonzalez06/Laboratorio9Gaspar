<?php
require_once(__DIR__.'/Calculadora.php');
use \PHPUnit\Framework\TestCase;
class CalculadoraTest extends TestCase{

    public function testSumar(){
        $calculadora =new Calculadora();
        $resultado_calculado=$calculadora->sumar(3,3);
        //$this->assertEquals("6",$resultado_calculado);
        $this->assertSame("6",$calculadora->sumar(3,3));
    }
    public function testRestar(){
        $calculadora =new Calculadora();
        $resultado_calculado=$calculadora->restar(3,3);
        $this->assertEquals(0,$resultado_calculado);
    }
    public function testMultiplicar(){
        $calculadora =new Calculadora();
        $resultado_calculado=$calculadora->multiplicar(3,3);
        $this->assertEquals(9,$resultado_calculado);
    }
    public function testDividir(){
        $calculadora =new Calculadora();
        $this->assertEqualsWithDelta(0.33,$calculadora->dividir(1,3), 0.003);
    }
    public function testGenerarArreglo(){
        $calculadora=new Calculadora();
        //$this->assertContains(5,$calculadora->generarArreglo());
        //$this->assertCount(5,$calculadora->generarArreglo());
        $this->assertNotEmpty($calculadora->generarArreglo());
    }

    public function testCapturarEntradasPermutacion()
    {
        // Se crea el doble de prueba para la clase Calculadora, método 'capturarEntradasPermutacion'
        $stub = $this->createMock('Calculadora');
        $stub->method('capturarEntradasPermutacion')
            ->willReturn(array(5, 3));
   
        $this->assertSame(array(5, 3), $stub->capturarEntradasPermutacion());
    }
    
    public function testCalcularPermutacion()
    {
    /* Se crea un mock para la clase Calculadora.
         Solo se hace mock al método calcularFactorial*/
        $mock = $this->getMockBuilder('Calculadora')
            ->onlyMethods(array('calcularFactorial'))
            ->getMock();

        /* Se configuran las expectativas para el método calcularFactorial
        se llamará dos veces y devolverá 120 y 6, en cada ocasión, respectivamente. */
        $mock->expects($this->exactly(2))
            ->method('calcularFactorial')
            ->will($this->onConsecutiveCalls(120,6));

        /* Se hace el assert. */
        $this->assertSame(20, $mock->calcularPermutacion(5,2));


    }
    public function testComprobarLlamada()
    {
        $mock = $this->getMockBuilder('Calculadora')
            ->onlyMethods(array('calcularFactorial'))
            ->getMock();
        /*$mock->expects($this->exactly(2))
            ->method('calcularFactorial')
            ->withConsecutive([5],[3]);
            
        $mock->calcularFactorial(5);
        $mock->calcularFactorial(4);*/
        /*$mock->expects($this->once())
            ->method('calcularFactorial')
            ->with(5)
            ->will($this->returnValue(120));
            $resultado_calculado = $mock->calcularFactorial(5);
            $this->assertEquals(120,$resultado_calculado);
            //$mock->calcularFactorial(3);
            $this->assertEquals(12,$resultado_calculado);*/
        $mock->expects($this->exactly(2))
            ->method('calcularFactorial')
            ->withConsecutive([5],[3])
            ->will($this->onConsecutiveCalls(120,6));
        $this->assertEquals(120,$mock->calcularFactorial(5));
        $this->assertEquals(6,$mock->calcularFactorial(3));
    }
   
}