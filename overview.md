## 概要
HTTPリクエストに基づいてフィボナッチ数列の値を返すAPI  
下記 URL でリクエストを受け、n番目のフィボナッチ数を返す

https://fib-api-a9p4.onrender.com/fib?n=10

### 使用言語・フレームワーク等
- PHP
- laravel
- Render.com
- Nginx

### ファイルの構成(変更部分の抜粋)
```
project
├─ app
│  ├─ Http
│  │  └─ Controllers
│  │     └─ fibController.php
│  └─ Services
│     ├─ CalcService.php
│     └─ ResponseService.php
├─ routes
│  └─ web.php
└─ tests
   └─ Unit
      ├─ CalcServiceTest.php
      └─ FibControllerTest.php
```

### 作成ファイル
#### app/Http/Controllers/fibController.php

- HTTPリクエストを受け取り、nの値に応じてレスポンスを決定する。
- コンストラクタでCalcServiceとResponseServiceのインスタンスを作成する。
- nが正常な値の場合、CalcServiceを呼び出してフィボナッチ数の計算を行い、ResponseService を使用して結果をJSON形式で返す。

#### app/Services/CalcService.php

- フィボナッチ数の計算を担当する。
- calcFibonacci()では、nの値に対してループを使用した再帰のない計算を行う。
- matrixMulti()では、行列の計算を行う。

#### app/Services/ResponseService.php

- 引数に応じてJSON形式でレスポンスを構築する。
- リクエストが成功した場合はsuccessResponse()を、失敗した場合はerrorResponse()を利用する。

#### routes/web.php

- API のルートを設定している。/fib というパスを定義し、fibControllerのgetFibNumメソッドを呼び出す。

#### tests/Unit/CalcServiceTest.php

- CalcServiceにおける計算関数が正しく動作しているかをテストする。
- testCalcFibonacciIsSuccese：　正常な入力におけるフィボナッチ数計算のテスト
- testCalcFibonacciIsError：　不正な入力におけるフィボナッチ数計算のテスト
- testCalcFibonacciIsError：　行列の掛け算のテスト

#### tests/Unit/FibControllerTest.php

- fibControllerの動作をテストする。
- リクエストとレスポンスが想定された挙動をすることを検証する。
- testGetFibNumWithCorrectParam：　正常なレスポンスを確認するテスト
- testGetFibNumWithInvalidParam：　無効なパラメータの場合のレスポンスを確認するテスト
