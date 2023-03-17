<?php

// ＜アルゴリズムの注意点＞

// アルゴリズムではこれまでのように調べる力ではなく物事を論理的に考える力が必要です。

// 検索して答えを探して解いても考える力には繋がりません。

// まずは検索に頼らずに自分で処理手順を考えてみましょう。

 

// 「algorithm5」で作成したポーカープログラムにジョーカーを追加してください。

// ジョーカー１枚のみ、suitをjoker、numberを0と表す。

// 上記以外は不正として処理してください。

 

// 追加された役

// 「フォーカード」＋ジョーカーは「ファイブカード」

 

// 判定は強い役を優先してください。組み合わせの強さ順は以下とする。

// ロイヤルストレートフラッシュ > ストレートフラッシュ > ファイブカード > フォーカード > フルハウス > フラッシュ > ストレート > スリーカード > ツーペア > ワンペア

// ジョーカーが出た時点で最低でも「ワンペア」となること

 

// 手札

$cards = [

    ['suit' => 'heart', 'number' => 11],

    ['suit' => 'joker', 'number' => 0],

    ['suit' => 'spade', 'number' => 12],

    ['suit' => 'club', 'number' => 10],

    ['suit' => 'heart', 'number' => 9],

];

 

function judge($cards)

{

 

    // カードの不正チェック

 

    $c = array_unique($cards, SORT_REGULAR);

    $count = count($c);

 

    foreach ($cards as $card) {

        if ($card["number"] > 13 || $card["number"] < 0) {

            return "不正";

        } elseif ($card["suit"]  != "heart" && $card["suit"]  != "spade" && $card["suit"]  != "diamond" && $card["suit"]  != "club" && $card["suit"]  != "joker") {

            return "不正";

        } elseif ($count < 5) {

            return "不正";

        } elseif ($card["suit"]  != "joker" && $card["number"] == 0) {

            return "不正";

        } elseif ($card["suit"]  == "joker" && $card["number"] != 0) {

            return "不正";

        }

    }

 

    // 役判定

    $number = array_column($cards, "number");

    sort($number);

    $a = array_count_values($number);

    sort($a);

 

    $suit = array_column($cards, "suit");

    $b = array_count_values($suit);

    sort($b);

 

    $straightFstNum = $number[1];

    $sNumber = range($straightFstNum, $straightFstNum + 3);

    $straight = array_unshift($sNumber, 0);

 

    // 結果を返す

    if ($number[0] !== 0) {

 

        if ($number == [1, 10, 11, 12, 13] && $b == [5]) {

            return  "ロイヤルストレートフラッシュ";

        } elseif ($number == [$number[0], $number[0] + 1, $number[0] + 2, $number[0] + 3, $number[0] + 4] && $b == [5]) {

            return  "ストレートフラッシュ";

        } elseif ($a == [1, 4]) {

            return  "フォーカード";

        } elseif ($a == [2, 3]) {

            return  "フルハウス";

        } elseif ($b == [5]) {

            return  "フラッシュ";

        } elseif ($number == [$number[0], $number[0] + 1, $number[0] + 2, $number[0] + 3, $number[0] + 4]) {

            return  "ストレート";

        } elseif ($a == [1, 1, 3]) {

            return  "スリーカード";

        } elseif ($a == [1, 2, 2]) {

            return  "ツーペア";

        } elseif ($a == [1, 1, 1, 2]) {

            return  "ワンペア";

        } else {

            return  "なし";

        }

    } elseif ($number[0] === 0) {

        if (($number == [0, 1, 10, 11, 12] || $number == [0, 10, 11, 12, 13] || $number == [0, 1, 11, 12, 13] || $number == [0, 1, 10, 12, 13] || $number == [0, 1, 10, 11, 13]) && $b == [1, 4]) {

            return  "ロイヤルストレートフラッシュ";  //jokerがどれかに含まれるとき

        } elseif ($number == $straight && $b == [1, 4]) {

            return  "ストレートフラッシュ";

        } elseif ($a == [1, 4]) {

            return  "ファイブカード";

        } elseif ($a == [1, 1, 3]) {

            return "フォーカード";

        } elseif ($a == [1, 2, 2]) {

            return  "フルハウス";

        } elseif ($b == [1, 4]) {

            return  "フラッシュ";

        } elseif ($number == $sNumber) {

            return  "ストレート";

        } elseif ($a == [1, 1, 1, 2]) {

            return  "スリーカード";

        } elseif ($a == [1, 1, 1, 1, 1]) {

            return  var_dump($straight);

        }

    }

}

 

?>

<!DOCTYPE html>

<html lang="ja">

 

<head>

    <meta charset="utf-8">

    <title>ポーカー役判定（ジョーカーあり）</title>

</head>

 

<body>

    <section>

        <p>手札は</p>

        <p><?php foreach ($cards as $card) : ?><?= $card['suit'] . $card['number'] . '&nbsp;' ?><?php endforeach; ?></p>

        <p>役は<?= judge($cards) ?>です。</p>

    </section>

</body>

 

</html>