<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FibControllerTest extends TestCase
{
    /**
     * リクエストが成功した場合にJSON形式のレスポンスを返す
     */
    public function testGetFibNumWithCorrectParam()
    {
        // n = 99 の場合、正常なレスポンスが返ってくることを確認
        $response = $this->get('/fib?n=99');
        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'success',
            'code' => 200,
            'data' => [
                "fibonacci_num" => "218922995834555169026"
            ]
        ]);
    }

    /**
     * リクエストが失敗した場合にJSON形式のレスポンスを返す
     */
    public function testGetFibNumWithInvalidParam()
    {
        // n がない場合、不正なレスポンスが返ることを確認
        $response = $this->get('/fib?n=-10');
        $response->assertStatus(400);
        $response->assertJson([
            'status' => 'error',
            'code' => 400,
            'message' => "パラメータnを入力してください"
        ]);

        // n = -10 の場合、不正なレスポンスが返ることを確認
        $response = $this->get('/fib?n=-10');
        $response->assertStatus(400);
        $response->assertJson([
            'status' => 'error',
            'code' => 400,
            'message' => "パラメータnに0より大きい整数を入力してください"
        ]);

        // n = abc の場合、不正なレスポンスが返ることを確認
        $response = $this->get('/fib?n=abc');
        $response->assertStatus(400);
        $response->assertJson([
            'status' => 'error',
            'code' => 400,
            'message' => "パラメータnに0より大きい整数を入力してください"
        ]);
    }
}