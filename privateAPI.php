<?php
//PrivateAPIの使用の際の認証と実行
 function Authentication($ACCESS_KEY, $url,$API_SECRET, $request_body = 0,$request_type){
  //アクセスキーの取得
  $strAccessKey = $ACCESS_KEY;
  //シークレットキーの取得
  $strAccessSecret = $API_SECRET;
  //リクエスト先のurl取得
  $strUrl = $url;
  //タイムスタンプの取得
  $intNonce = time();

   //SIGNATUREの作成
  //リクエストボディが無いとき
  if($request_body === 0){
    $strMessage = $intNonce . $strUrl ;
  }else{
    $strMessage = $intNonce . $strUrl . http_build_query($request_body );
  }

  $strSignature = hash_hmac("sha256", $strMessage, $strAccessSecret);

  //認証時ヘッダー
  $headers = array(
    "ACCESS-KEY: {$strAccessKey}",
    "ACCESS-SIGNATURE: {$strSignature}",
    "ACCESS-NONCE: {$intNonce}",
    );

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $strUrl );

    if($request_type == 'POST'){
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
      curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($request_body));
    }else{
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
    }

    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    //ヘッダー追加オプション
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    $response = curl_exec($curl);
    $result = json_decode($response, true);
    curl_close($curl);
    return $result;
}


function public_api($url,$request_body = 0){
    $strUrl = $url;

  //リクエストボディが無いとき
  if($request_body === 0){
    $strMessage = $strUrl ;
  }else{
    $strMessage =  $strUrl . '?' . http_build_query($request_body );
  }

  $curl = curl_init();

  curl_setopt($curl, CURLOPT_URL, $strMessage );
  curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

  $response = curl_exec($curl);
  $result = json_decode($response, true);
  curl_close($curl);
  return $result;
}
