<?php

// ＜アルゴリズムの注意点＞

// アルゴリズムではこれまでのように調べる力ではなく物事を論理的に考える力が必要です。

// 検索して答えを探して解いても考える力には繋がりません。

// まずは検索に頼らずに自分で処理手順を考えてみましょう。

 

// 以下はポーカーの役を判定するプログラムです。

// cards配列に格納したカードの役を判定し、結果表示してください。

// cards配列には計5枚、それぞれ絵柄(suit)、数字(numeber)を格納する

// 絵柄はheart, spade, diamond, clubのみ

// 数字は1-13のみ

 

// 上記以外の絵柄や数字が存在した場合、または同一の絵柄、数字がcards配列に存在した場合、

// 役の判定前に「手札が不正です」と表示してください。

// 役判定は関数に記述し、関数を呼び出して結果表示すること

// プログラムが完成したらcards配列を差し替えてすべての役で検証を行い、提出時にテストケースを示すこと

 

// <役>

// ワンペア・・・同じ数字２枚（ペア）が１組

// ツーペア・・・同じ数字２枚（ペア）が２組

// スリーカード・・・同じ数字３枚

// ストレート・・・数字の連番５枚（13と1は繋がらない）

// フラッシュ・・・同じマークが５枚

// フルハウス・・・同じ数字３枚が１組＋同じ数字２枚（ペア）が１組

// フォーカード・・・同じ数字４枚

// ストレートフラッシュ・・・数字の連番５枚＋同じマークが５枚

// ロイヤルストレートフラッシュ・・・1, 10, 11, 12, 13で同じマーク

// ※下の方が強い

 

// 表示例1）

// 手札は

// heart2 heart5 heart3 heart4 culb1

// 役はストレートです

 

// 表示例2）

// 手札は

// heart1 spade2 diamond11 club13 heart9

// 役はなしです

 

// 表示例3）

// 手札は

// heart1 heart1 heart3 heart4 heart5

// 手札は不正です

 

// 手札

 

$cards =  [

    ['suit' => 'club', 'number' => 5],

    ['suit' => 'club', 'number' => 6],

    ['suit' => 'club', 'number' => 7],

    ['suit' => 'club', 'number' => 8],

    ['suit' => 'club', 'number' => 9],

];

//テストケース

 

// ロイヤルストレートフラッシュ

/*$cards = [

     ['suit'=>'heart', 'number'=>12],

     ['suit'=>'heart', 'number'=>1],

     ['suit'=>'heart', 'number'=>13],

     ['suit'=>'heart', 'number'=>11],

     ['suit'=>'heart', 'number'=>10],

];*/

 

//ストレートフラッシュ

/*$cards = [

     ['suit'=>'club', 'number'=>4],

     ['suit'=>'club', 'number'=>1],

     ['suit'=>'club', 'number'=>5],

     ['suit'=>'club', 'number'=>3],

     ['suit'=>'club', 'number'=>2],

];*/

 

// フォーカード

/*$cards = [

    ['suit' => 'heart', 'number' => 4],

    ['suit' => 'diamond', 'number' => 4],

    ['suit' => 'spade', 'number' => 4],

    ['suit' => 'club', 'number' => 4],

    ['suit' => 'club', 'number' => 2],

];*/

 

// フルハウス

/*$cards = [

     ['suit'=>'heart', 'number'=>4],

     ['suit'=>'club', 'number'=>4],

     ['suit'=>'heart', 'number'=>7],

     ['suit'=>'spade', 'number'=>7],

     ['suit'=>'diamond', 'number'=>7],

];*/

 

// フラッシュ

/*$cards = [

     ['suit'=>'club', 'number'=>4],

     ['suit'=>'club', 'number'=>5],

     ['suit'=>'club', 'number'=>8],

     ['suit'=>'club', 'number'=>11],

     ['suit'=>'club', 'number'=>1],

];*/

 

// ストレート

/*$cards = [

    ['suit' => 'heart', 'number' => 9],

    ['suit' => 'club', 'number' => 10],

    ['suit' => 'heart', 'number' => 8],

    ['suit' => 'heart', 'number' => 11],

    ['suit' => 'spade', 'number' => 7],

];*/

 

// スリーカード

/*$cards = [

    ['suit' => 'heart', 'number' => 9],

    ['suit' => 'club', 'number' => 11],

    ['suit' => 'heart', 'number' => 5],

    ['suit' => 'heart', 'number' => 11],

    ['suit' => 'spade', 'number' => 11],

];*/

 

// ツーペア

/*$cards = [     ['suit'=>'diamond', 'number'=>11],

     ['suit'=>'club', 'number'=>7],

     ['suit'=>'heart', 'number'=>8],

     ['suit'=>'heart', 'number'=>11],

     ['suit'=>'spade', 'number'=>7],

];*/

 

// ワンペア

/*$cards = [

     ['suit'=>'heart', 'number'=>9],

     ['suit'=>'club', 'number'=>10],

     ['suit'=>'heart', 'number'=>10],

     ['suit'=>'heart', 'number'=>11],

     ['suit'=>'spade', 'number'=>7],

];*/

 

// 役なし

/*$cards = [

     ['suit'=>'heart', 'number'=>9],

     ['suit'=>'club', 'number'=>5],

     ['suit'=>'heart', 'number'=>8],

     ['suit'=>'heart', 'number'=>13],

     ['suit'=>'spade', 'number'=>7],

];*/

 

//不正

/*$cards = [

    ['suit' => 'heart', 'number' => 9],

    ['suit' => 'club', 'number' => 14],

    ['suit' => 'club', 'number' => 10],     ['suit' => 'heart', 'number' => 11],

    ['suit' => 'spade', 'number' => 7],

];*/

 

function judge($cards)

// この関数内に処理を記述

{

    $number = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13];

    $suit = ['spade', 'heart', 'club', 'diamond'];

 

    foreach ($cards as $card) {

        // カードの不正チェック

        if ($card['number'] < 1 || $card['number'] > 13) {

            return '手札は不正';

        }

        if (

            $card['suit'] == 'heart' || $card['suit'] == 'spade' ||

            $card['suit'] == 'diamond' || $card['suit'] == 'club'

        ) {

        } else {

            return '手札は不正';

        }

 

        if (count(array_unique($cards, SORT_REGULAR)) < 5) {

            return '手札は不正';

        }

    }

 

    // カードの並び替え

    $numArray = array_column($cards, "number");

    sort($numArray);

    $countNum = array_count_values($numArray);

    sort($countNum);

    $suitArray = array_column($cards, "suit");

    $countSuit = array_count_values($suitArray);

    sort($countSuit);

 

    // 役判定

    // 結果を返す

    if ($numArray == [1, 10, 11, 12, 13] && $countSuit == [5]) {

        return 'ロイヤルストレートフラッシュ';

    } elseif ($numArray == [$numArray[0], $numArray[0] + 1, $numArray[0] + 2, $numArray[0] + 3, $numArray[0] + 4] && $numArray[0] < 10 && $countSuit == [5]) {

        return 'ストレートフラッシュ';

    } elseif ($countNum == [1, 4]) {

        return 'フォーカード';

    } elseif ($countNum == [2, 3]) {

        return 'フルハウス';

    } elseif ($countSuit == [5]) {

        return 'フラッシュ';

    } elseif ($numArray == [$numArray[0], $numArray[0] + 1, $numArray[0] + 2, $numArray[0] + 3, $numArray[0] + 4] && $numArray[0] < 10) {

        return 'ストレート';

    } elseif ($countNum == [1, 1, 3]) {

        return 'スリーカード';

    } elseif ($countNum == [1, 2, 2]) {

        return 'ツーペア';

    } elseif ($countNum == [1, 1, 1, 2]) {

        return 'ワンペア';

    } else {

        return 'なし';

    }

}

?>

 

<!DOCTYPE html>

<html lang="ja">

 

<head>
    <meta charset="utf-8">
    <title>algorithm4</title>
</head>

<body>

    <section>

        <p>手札は</p>

        <p><?php foreach ($cards as $card) : ?><?= $card['suit'] . $card['number'] . '&nbsp;' ?><?php endforeach; ?></p>

        <p>役は<?= judge($cards) ?>です。</p>

    </section>

</body>

 

</html>