<?php

// 文字コード設定
header('Content-Type: application/json; charset=UTF-8');

// リクエストした URL
$request_uri = $_SERVER["REQUEST_URI"];

// ここのURL 例: "/dns/"
$url = "/";

// ドメインの解析
$domain = substr($request_uri, mb_strlen($url));

// ドメインの存在確認
if( !(checkdnsrr($domain, "NS")) ){

    // ステータス404を返す
    http_response_code(404);

    // エラーメッセージを生成
    $arr["message"] = "Not Found Domain";
    $arr["errors"]["type"] = "UnKnown Domain";
    $arr["errors"]["message"] = "存在しないドメインです。(A domain that does not exist.)";

    // 出力
    print json_encode($arr, JSON_PRETTY_PRINT);

    // 終了
    exit;
}

// ステータス200を返す
http_response_code(200);

// IPv4アドレスリソースレコードを取得
$dns_a = dns_get_record($domain, DNS_A);

// エイリアス(Canonical Name)リソースレコードを取得
$dns_cname = dns_get_record($domain, DNS_CNAME);

// ネームサーバーを取得
$dns_ns = dns_get_record($domain, DNS_NS);

// DNS 名前空間内の場所を取得
$dns_ptr = dns_get_record($domain, DNS_PTR);

// 関連付けられている任意の文字列を取得
$dns_txt = dns_get_record($domain, DNS_TXT);

// CPU を識別する IANA 番号を取得
$dns_hinfo = dns_get_record($domain, DNS_HINFO);

// CAA タグの値を取得
$dns_caa = dns_get_record($domain, DNS_CAA);

// IPv6 アドレスを取得
$dns_soa = dns_get_record($domain, DNS_SOA);

// リソースレコードの元となるマシンの FQDN を取得
$dns_aaaa = dns_get_record($domain, DNS_AAAA);

// ipv6 データとマージするための親レコード を取得
$dns_a6 = dns_get_record($domain, DNS_A6);

// リクエストされたサービスが存在するホスト名とポート を取得
$dns_srv = dns_get_record($domain, DNS_SRV);

// リクエストされたサービスが存在するホスト名とポート を取得
$dns_naptr = dns_get_record($domain, DNS_NAPTR);

// DNSをまとめる
$dns = [
    $dns_a,
    $dns_cname,
    $dns_ns,
    $dns_ptr,
    $dns_txt,
    $dns_hinfo,
    $dns_caa,
    $dns_soa,
    $dns_aaaa,
    $dns_a6,
    $dns_srv,
    $dns_naptr
];

// 配列を定義する
$d = [];

// ドメイン情報を載せる
$d["domain"] = $domain;

// $dnsの数だけ繰り返す
for ($i=0; $i < count($dns); $i++) { 
    
    // もし、要素が0より多いなら
    if( count($dns[$i]) > 0 ){

        // 配列を定義する
        $d[$dns[$i][0]["type"]] = [];

        // コード数だけ繰り返す
        for ($n=0; $n < count($dns[$i]); $n++) { 

            // 配列に追加
            array_push($d[$dns[$i][0]["type"]], $dns[$i][$n]);
        }
    }
}

// 出力
print json_encode($d, JSON_PRETTY_PRINT);

// 終了
exit;
?>
