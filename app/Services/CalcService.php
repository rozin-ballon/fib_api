<?php

namespace App\Services;

class CalcService
{

    /**
     * N番目のフィボナッチ数を返す
     * Nが0以下の場合にはfalseを返す
     * @param int $N
     * @return string|false
     */
    public function calcFibonacci(int $N)
    {
        // Nが不正な値の場合
        if($N <= 0) {
            return false;
        }
        // Nが1,2の場合は1を返す
        if($N <= 2) {
            return "1";
        }

        $S = strrev(decbin($N-2));
        $M = strlen($S);
        
        // 行列の累乗を計算
        $L = [[[1, 1], [1, 0]]];
        for ($i = 1; $i < $M; $i++) {
            $L[] = $this->matrixMulti($L[$i - 1], $L[$i - 1]);
        }

        // 行列を掛け算
        $R = [[1, 0], [0, 1]];
        $initMat = [[1],[1]];
        for ($i = 0; $i < $M; $i++) {
            if ($S[$i] == '1') {
                $R = $this->matrixMulti($R, $L[$i]);
            }
        }
        $R = $this->matrixMulti($R, $initMat);

        return gmp_strval($R[0][0]);
    }

    /**
     * 行列a, bの掛け算の結果を返す
     * @param array<int, array<int,gmp|int>> $a
     * @param array<int, array<int,gmp|int>> $b
     * @return array<int, array<int,gmp|int>> $c 
     */
    public function matrixMulti(array $a, array $b)
    {
        $c = array_fill(0, count($a), array_fill(0, count($b[0]), 0));
        for ($i = 0; $i < count($a); $i++) {
            for ($j = 0; $j < count($b[0]); $j++) {
                for ($k = 0; $k < count($a[0]); $k++) {
                    $c[$i][$j] = gmp_add($c[$i][$j],gmp_mul(gmp_init($a[$i][$k]),gmp_init($b[$k][$j])));
                }
            }
        }
        return $c;
    }
    
}
