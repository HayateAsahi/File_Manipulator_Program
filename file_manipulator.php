<?php
//php file_manipulator.php reverse input.txt output.txt
$command = $argv[1];
$inputFile = $argv[2];
$outputFile = $argv[3];

class DataValidation {

    private $errorMsg = "";

    function validateInput($command, $inputFile, $outputFile){

        global $argv;

        //必要な引数の数を確認
        if (count($argv) < 4){
            $this -> errorMsg = "入力項目が足りません";
            return false;
        }

        //空文字の確認
        if ($command == "" || $inputFile == "" || $outputFile == "") {
            $this -> errorMsg = "入力されていない項目があります。";
            return false;
        }

        return true;

    }
    // エラーメッセージ取得用のメッソド
    function getErrorMsg(){
        return $this -> errorMsg;
    }
}

// インスタンス化
$dv = new DataValidation;

// バリデーションチェック
if ($dv -> validateInput($command, $inputFile, $outputFile)) {
    // バリデーション成功時の処理
    if($command == 'reverse'){
        //ファイルを受け取る
        $content = file_get_contents($inputFile);

        if($content === false) {
            echo "ファイルを読み込めませんでした。\n";
            exit;
        }

        //内容を逆にする
        $reverseContent = strrev($content);

        // 内容をファイルに書き込む
        if(file_put_contents($outputFile, $reverseContent) === false) {
            echo "ファイルの書き込みに失敗しました。\n";
            exit;
        }

        echo "ファイルが正常に反転されました。\n";
    }
} else {
    // バリデーション失敗時の処理
    echo $dv -> getErrorMsg() . "\n";
}

?>
