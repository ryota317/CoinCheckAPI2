<?php
//一定数値になれば買い、一定数値になれば売る
require_once 'privateAPI.php';
$strAccessKey = "**************";
$strAccessSecret = "************";
//残高url
$balance_url = "https://coincheck.com/api/accounts/balance";
//現在のレートを取得する
$rate_url = "https://coincheck.com/api/exchange/orders/rate";
//新規注文url
$new_order_url = "https://coincheck.com/api/exchange/orders";

$arrQuery_rate_sell = array(
  "order_type" => "sell",
  "pair" => "btc_jpy",
  "price" => 5000
);
$arrQuery_rate_buy = array(
  "order_type" => "buy",
  "pair" => "btc_jpy",
  "price" => 5000
);

//残高の取得
 $balance = Authentication($strAccessKey , $balance_url ,$strAccessSecret , 0, "GET");

$rate_sell_result =public_api($rate_url,$arrQuery_rate_sell);
$rate_buy_result =public_api($rate_url,$arrQuery_rate_buy);

//売るレートが1032250
if($rate_sell_result["rate"] < 1032250){
//買う
//売っているレートに最低購入ビット量0.005をかけて残高を超えていなければ購入
if($rate_sell_result["rate"] * 0.005 < $balance["jpy"]){

$arrQuery_order_buy =  array(
  "pair" => "btc_jpy",
  "order_type" => "buy",
  "rate" => floor($rate_sell_result["rate"]),
  "amount" => 0.005
);

 $order_buy_result = Authentication($strAccessKey ,  $new_order_url ,$strAccessSecret , $arrQuery_order_buy
 , "POST");
var_dump($order_buy_result);exit();

 if($order_buy_result['success'] ){
//購入成功
echo '成功';
 }else{
//購入失敗
echo '失敗';
 }
}
}
if($rate_sell_result["rate"] > 1032750){
  //売る
  //保持ビットコイン量が0.005よりあれば
  if( 0.005 <= $balance["btc"]){
    $arrQuery_order_sell =  array(
      "pair" => "btc_jpy",
      "order_type" => "sell",
      "rate" => floor($rate_sell_result["rate"]),
      "amount" => $balance["btc"]
    );
    $order_sell_result = Authentication($strAccessKey ,  $new_order_url ,$strAccessSecret , $arrQuery_order_sell
    , "POST");
  }
}
echo time();
 ?>
