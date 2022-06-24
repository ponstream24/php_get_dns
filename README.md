# PHPでDNSコードを取得する方法

こちらのコードは、ITシステムラボの[APIサービス](https://api.itsystem-lab.com/)にて実装しています。

## 使用例
> https://api.itsystem-lab.com/dns/<ドメイン> <br>
> https://api.itsystem-lab.com/dns/google.com <br>

## 取得できる情報
このシステムで取得できる情報は以下の通りです。
<table>
 <thead>
   <tr>
       <th colspan="2">dns_get_record</th>
   </tr>
   <tr>
       <th>TYPE(レコード)</th>
       <th>情報</th>
   </tr>
 </thead>
 <tbody>
   <tr>
       <td>A</td>
       <td>ip: ドット区切り 10 進数形式の IPv4 アドレス。</td>
   </tr>
   <tr>
       <td>MX</td>
       <td>pri: メールエクスチェンジャの優先度。数字が小さいほど優先度が高い。<br>target: メールエクスチェンジャの FQDN。dns_get_mx() も参照ください。</td>
   </tr>
   <tr>
       <td>CNAME</td>
       <td>target: レコードのエイリアスの対象となっている場所の FQDN。</td>
   </tr>
   <tr>
       <td>NS</td>
       <td>target: このホスト名に対する権威をもっているネームサーバーの FQDN。</td>
   </tr>
   <tr>
       <td>PTR</td>
       <td>target: レコードが指している、DNS 名前空間内の場所</td>
   </tr>
   <tr>
       <td>TXt</td>
       <td>txt: このレコードに関連付けられている任意の文字列。</td>
   </tr>
   <tr>
       <td>HINFO</td>
       <td>cpu: このレコードが参照しているマシンの CPU を識別する IANA 番号。<br>os: このレコードが参照しているマシン上の OS を識別する IANA 番号。</td>
   </tr>
   <tr>
       <td>CAA</td>
       <td>flags: 1バイトのビットフィールド; 現在はビット0だけが定義されており、'critical' を意味します。 他のビットは予約されており、無視されるべきです。<br>tag: CAA タグの名前 (alphanumeric な ASCII 文字列)。<br>value: CAA タグの値 (バイナリ文字列, サブフォーマットの使用可) 詳細は、» RFC 6844 を参照ください。</td>
   </tr>
   <tr>
       <td>SOA</td>
       <td>mname: リソースレコードの元となるマシンの FQDN。<br>rname: このドメインの管理責任者の Email アドレス。<br>serial: ドメインのシリアル番号。<br>refresh: セカンダリネームサーバーがこのドメインのコピーを更新する際に参照するリフレッシュ間隔（秒単位。<br>retry: リフレッシュが失敗した際に 2 度目のリフレッシュを試みるまでの間隔（秒単位）<br>expire: セカンダリネームサーバーが、ゾーンデータの リフレッシュに失敗した場合にコピーのデータを破棄せず持ち続ける期間 （秒単位。<br>minimum-ttl: クライアントが、 一度取得したデータを再リクエストすることなしに利用できる最小期間（秒単位）。 個々のリソースレコードによって上書きが可能。</td>
   </tr>
   <tr>
       <td>AAAA</td>
       <td>ipv6: IPv6 アドレス。</td>
   </tr>
   <tr>
       <td>A6</td>
       <td>masklen: chain で指定された対象から引き継ぐビット長。<br>ipv6: chain とマージするためのこのレコードのアドレス。<br>chain: ipv6 データとマージするための親レコード。</td>
   </tr>
   <tr>
       <td>SRV</td>
       <td>pri: (Priority) 値が小さいものが優先されます。<br>weight: 同じ優先順位の targets からランダムに選択する際の重み。<br>target / port: リクエストされたサービスが存在するホスト名とポート。</td>
   </tr>
   <tr>
       <td>NAPTR</td>
       <td>order および pref: 上の pri および weight と同じ。 flags, services, regex, および replacement: » RFC 2915 で定義されるパラメータ。</td>
   </tr>
 </tbody>
</table>
 
> 参考文献 https://www.php.net/manual/ja/function.dns-get-record.php
 
 ## 解説
 このシステムは、PHPを使用しており、[dns_get_record()](https://www.php.net/manual/ja/function.dns-get-record.php) を使用しております。
```php
# 使用例
dns_get_record("ドメイン", $type);
```
 <br> <br>
> ITシステムラボ : https://www.itsystem-lab.com/
```
©︎Copyright All Rights Reserved ITsystemLab
```
