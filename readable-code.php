<?php
//var_dump($argv);

//読み込むファイルの指定
if (isset($argv) && isset($argv[1]) && $argv[1] != '') {
    $readFile = $argv[1];
    //ファイルの存在チェック
    if (!file_exists($readFile)) {
        //ファイルが存在しない場合、エラー
        getErrorMsg('E0001');
        exit;
    }
} else {
    //パラメータ指定がない場合、エラー
    getErrorMsg('E0002');
    exit;
}


//ファイル読み込み
$handle = fopen($readFile, "r");
//行を読み込む
while (($buffer = fgets($handle, 4096)) !== false) {
    echo $buffer;
}



//エラーメッセージ表示用関数
function getErrorMsg($code) {
    //初期化
    $errorMsg = '';
    
    //エラーコードにより振り分け
    switch ($code) {
        case 'E0001':
            $errorMsg .= '指定されたファイルが存在しませんでした。';
            break;
        case 'E0002':
            $errorMsg .= '読み込み対象のファイルがありませんでした。';
            $errorMsg .= '後述のようにパラメータを指定してください。';
            $errorMsg .= '「php ./readable-code.php recipe-data.txt」';
            break;
        default:
            $errorMsg .= 'エラーになりました。';
            break;
    }
    //エラーメッセージの表示
    echo $errorMsg;

}

?>
