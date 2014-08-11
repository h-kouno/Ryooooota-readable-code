<?php
//var_dump($argv);

$recipe_data = array();

//読み込むファイルの指定
if (isset($argv) && isset($argv[1]) && $argv[1] != '') {
    	
    $readFile = $argv[1]; // 読み込んだファイル名
    
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
$recipeFile = fopen($readFile, "r");
//行を読み込み、配列へ格納
while ($line = fgetcsv($recipeFile)) {
    $recipe_data[] = $line;
}
// var_dump($recipe_data);
// exit;

// ファイルを閉じる
fclose($recipeFile);

// レシピのタイトルを表示する
foreach ($recipe_data as $id => $recipe) {
    $recipeId = $recipe[0];
    $recipeName = $recipe[1];
    echo "$recipeId: $recipeName\n";
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
            $errorMsg .= '「php ./readable-code.php recipe-data.csv」';
            break;
        default:
            $errorMsg .= 'エラーになりました。';
            break;
    }
    //エラーメッセージの表示
    echo $errorMsg;

}

?>
