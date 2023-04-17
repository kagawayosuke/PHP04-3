<?php
// ＜アルゴリズムの注意点＞
// アルゴリズムではこれまでのように調べる力ではなく物事を論理的に考える力が必要です。
// 検索して答えを探して解いても考える力には繋がりません。
// まずは検索に頼らずに自分で処理手順を考えてみましょう。
 
 
// 以下は分数の足し算を行うプログラムです。
// calcFraction関数内に分子と分母を渡すと、分数の答えを返すプログラムを記載してください。
 
// 例えば
// 1/10 + 5/6 の場合、答えは 14/15
// 1/7 + 4/9 の場合、答えは 37/63
// 1/50 + 1/100 の場合、答えは 3/100
// となります。
 
// また通分には最小公約数を求める関数gcd、約分には最大公約数を求める関数lcm をそれぞれ利用してください。
 
$num1 = 1;  // 分子
$deno1 = 10; // 分母
$num2 = 5;  // 分子
$deno2 = 6; // 分母
 
function calcFraction($num1, $deno1, $num2, $deno2):array  {
    // この関数内に処理を記述
    $lcm = lcm($deno1, $deno2);
    $num = (($lcm / $deno1 ) * $num1) + (($lcm / $deno2 ) * $num2);
    $gcd = gcd($num,$lcm);
    return[$num / $gcd , $lcm / $gcd];
}
 
function gcd($m, $n){
  if($n > $m) list($m, $n) = array($n, $m);
 
  while($n !== 0) {
    $tmp_n = $n;
    $n = $m % $n;
    $m = $tmp_n;
  }
  return $m;
}
 
// 最小公倍数
function lcm($m, $n){
  return $m * $n / gcd($m, $n);
}
?>
<?php echo $num1 ."/". $deno1 ." + ". $num2 ."/". $deno2 ?>
の場合、答えは<?php vprintf('%d / %d', calcFraction($num1, $deno1, $num2, $deno2)); ?>