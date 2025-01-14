<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\CalcService;

class CalcServiceTest extends TestCase
{
    protected $calcService;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->calcService = new CalcService();
    }

    /**
     * 正常な入力におけるフィボナッチ数計算のテスト
     */
    public function testCalcFibonacciIsSuccese()
    {

        $result = $this->calcService->calcFibonacci(1);
        $this->assertEquals("1", $result);

        $result = $this->calcService->calcFibonacci(2);
        $this->assertEquals("1", $result);

        $result = $this->calcService->calcFibonacci(5);
        $this->assertEquals("5", $result);

        $result = $this->calcService->calcFibonacci(10);
        $this->assertEquals("55", $result);

        $result = $this->calcService->calcFibonacci(99);
        $this->assertEquals("218922995834555169026", $result);

        $result = $this->calcService->calcFibonacci(200);
        $this->assertEquals("280571172992510140037611932413038677189525", $result);
    }

    /**
     * 不正な入力におけるフィボナッチ数計算のテスト
     */
    public function testCalcFibonacciIsError()
    {

        $result = $this->calcService->calcFibonacci(0);
        $this->assertFalse($result);

        $result = $this->calcService->calcFibonacci(-100);
        $this->assertFalse($result);

    }

    /**
     * 行列の掛け算のテスト
     */
    public function testMatrixMulti()
    {
        //  2*2行列の掛け算
        $a = [[1, 1], [1, 0]];
        $b = [[1, 1], [1, 0]];
        $result = $this->calcService->matrixMulti($a, $b);
        $expected = [
            [gmp_init(2), gmp_init(1)],
            [gmp_init(1), gmp_init(1)]
        ];
        $this->assertEquals($expected, $result);

        //  2*2と2*1行列の掛け算
        $a = [[1, 1], [1, 0]];
        $b = [[1], [1]];
        $result = $this->calcService->matrixMulti($a, $b);
        $expected = [
            [gmp_init(2)],
            [gmp_init(1)]
        ];
        $this->assertEquals($expected, $result);
    }
}
