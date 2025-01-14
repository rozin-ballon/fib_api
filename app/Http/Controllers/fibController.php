<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CalcService;
use App\Services\ResponseService;

class fibController extends Controller
{
    protected $calcService;
    protected $responseService;
    
    /**
     * @param CalcService $calcService 計算用クラス
     * @param ResponseService $cresponseService レスポンス用クラス
     */
    public function __construct(CalcService $calcService, ResponseService $responseService)
    {
        $this->calcService = $calcService;
        $this->responseService = $responseService;
    }

    /**
     * リクエストを受け取り、nの値に応じてレスポンスを決定する
     * @param Request $request リクエスト
     * @return \Illuminate\Http\JsonResponse $resultJSON レスポンス
     */
    public function getFibNum(Request $request) {
        $n = $request->query('n');
        if ($n==null) {
            $result = $this->responseService->errorResponse("パラメータnを入力してください");
        }elseif(!ctype_digit($n) || $n <= 0) {
            $result = $this->responseService->errorResponse("パラメータnに0より大きい整数を入力してください");
        }else {
            $fibNum = $this->calcService->calcFibonacci($n);
            $result = $this->responseService->successResponse(['fibonacci_num' => $fibNum]);
        }
        
        return $result;
    }
}
