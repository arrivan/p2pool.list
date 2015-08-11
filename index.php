<?php
function ghash($globall_hashrate){
	if($globall_hashrate>(1024*1024*1024*1024)){
		$hash_display = ($globall_hashrate/(1024*1024*1024*1024));
		$hash_string = ' TH/s';
	} else if($globall_hashrate>(1024*1024*1024)){
		$hash_display = ($globall_hashrate/(1024*1024*1024));
		$hash_string = ' GH/s';
	} else if($globall_hashrate>(1024*1024)){
		$hash_display = ($globall_hashrate/(1024*1024));
		$hash_string = ' MH/s';
	} else if($globall_hashrate>1024){
		$hash_display = ($globall_hashrate/1024);
		$hash_string = ' KH/s';
	} else {
		$hash_display = $globall_hashrate;
		$hash_string = ' H/s';
	}
	
	return round($hash_display, 2).$hash_string;
}

$json = json_decode(file_get_contents("http://eu.p2pool.pl:9171/global_stats"));
$vtc_hashrate = ghash($json->{"pool_hash_rate"});

$json = json_decode(file_get_contents("http://eu.p2pool.pl:7903/global_stats"));
$drk_hashrate = ghash($json->{"pool_hash_rate"});

$json = json_decode(file_get_contents("http://eu.p2pool.pl:19327/global_stats"));
$ftc_hashrate = ghash($json->{"pool_hash_rate"});

$json = json_decode(file_get_contents("http://eu.p2pool.pl:9332/global_stats"));
$btc_hashrate = ghash($json->{"pool_hash_rate"});


$vtc_price = file_get_contents("http://dash.org.ru/price.php?name=VTC");
$drk_price = file_get_contents("http://dash.org.ru/price.php?name=DRK");
$ftc_price = file_get_contents("http://dash.org.ru/price.php?name=FTC");
$btc_price = file_get_contents("http://dash.org.ru/price.php?name=BTC");

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="./favicon.ico">
	
    <title>P2Pool: Bitcoin, Vertcoin, DASH, Darkcoin, Feathercoin</title>
	<meta name="description" content="p2pool vertcoin, dash, bitcoin, darkcoin, feathercoin" />
	<meta name="keywords" content="p2pool, dash, bitcoin, vertcoin, darkcoin, feathercoin" />
	<link rel="stylesheet" href="//p2pool.pl/css/bootstrap.css">
	<link rel="stylesheet" href="//p2pool.pl/css/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="css/alertify.core.css"/>
	<link rel="stylesheet" type="text/css" href="css/alertify.bootstrap.css"/>
	<link href="//p2pool.pl/css/justified-nav.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="//p2pool.pl/js/bootstrap.min.js"></script>
	<script src="//p2pool.pl/js/alertify.js"></script>
	<!--<style>.dropdown:hover > .dropdown-menu { display: block; }</style> -->
	<style>
	body {
		background: #dfe1e2;
   }
pre {
  overflow: auto;
  word-wrap: normal;
  white-space: pre;
}
   </style>

  </head>

  <body>


      <div class="container">
<nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">P2Pool.pl</a>
          </div>
			<div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
			<li><a href="http://eu.btc.p2pool.pl">Bitcoin</a></li>
			<li><a href="http://eu.drk.p2pool.pl">DASH</a></li>
			<li><a href="http://eu.vtc.p2pool.pl">Vertcoin</a></li>
			<li><a href="http://eu.ftc.p2pool.pl">Feathercoin</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li><li style="position: relative; display: block; padding: 15px 5px; color: #fff;">BTC: <?=$btc_price;?>$ | DRK <?=$drk_price;?>$ | VTC <?=$vtc_price;?>$ | FTC <?=$ftc_price;?>$</li></li>
            </ul>
          </div><!--/.nav-collapse -->
		  
        </div><!--/.container-fluid -->
      </nav>

      </div><!-- /.container -->
	
<div class="container">
<div class="container">
<center><img src="/img/logo.png" border="0"></center>  
<div class="row">
<center><h4>Dear miners, we are glad to see you in our pool.<br/>
If you have any problems, please write in <a href="https://forum.bits.media/index.php?/topic/15283-p2poolpl-btc-dash-vtc-ftc/" target="_blank">this topic</a>.<br/>
Do not forget, <lu style="color:#0076A0">mining on p2pools</lu> help avoid 51% network attack.
</h4>
</center>

<div class="row">

<div class="col-lg-12">		
<div class="col-lg-3">
<center>
<h2><img width="112" height="112" src="./img/btc.png"><br/>Bitcoin</h2>
<div class="panel panel-default">
<table class="table table-bordered">
	<tbody>
	<tr><td>Hashrate</td><td><?=$btc_hashrate;?></td></tr>
		<tr><td><img src="/img/fr.png" style="margin-bottom:2px;"> Pool</td><td>eu.p2pool.pl:9332</td></tr>
		<tr><td><img src="/img/us.png" style="margin-bottom:2px;"> Pool</td><td>... </td></tr>
		<tr><td><img src="/img/anon.png" style="margin-bottom:3px;"> Pool</td><td title="same port (9332)">wrwx2dy7jyh32o53.onion</td></tr>
		<tr><td>Username</td><td>Bitcoin Address</td></tr>
		<tr><td>Password</td><td>Anything</td></tr>
		<tr><td>Exchange</td><td><a href="https://btc-e.com/" target="_blank">BTC/USD</a></td></tr>
		<tr><td>Algorithm</td><td>SHA-256</td></tr>
	</tbody> 
</table>
</div>
</center>
</div>

<div class="col-lg-3">
<center>
<h2><img width="112" height="112" src="./img/dark.png"><br/>DASH</h2>
<div class="panel panel-default">
<table class="table table-bordered">
	<tbody>
		<tr><td>Hashrate</td><td><?=$drk_hashrate;?></td></tr>
		<tr><td><img src="/img/fr.png" style="margin-bottom:2px;"> Pool</td><td>eu.p2pool.pl:7903</td></tr>
		<tr><td><img src="/img/us.png" style="margin-bottom:2px;"> Pool</td><td title="by default.abcd">us.p2pool.pl:7903</td></tr>
		<tr><td><img src="/img/anon.png" style="margin-bottom:3px;"> Pool</td><td title="same port (7903)">wrwx2dy7jyh32o53.onion</td></tr>
		<tr><td>Username</td><td>DASH Address</td></tr>
		<tr><td>Password</td><td>Anything</td></tr>
		<tr><td>Exchange</td><td><a href="https://www.cryptsy.com/markets/view/155" target="_blank">DRK/BTC</a> | <a href="https://www.cryptsy.com/markets/view/213" target="_blank">DRK/USD</a></td></tr>
		<tr><td>Algorithm</td><td>X11</td></tr>
	</tbody> 
</table>
</div>
</center>
</div>

<div class="col-lg-3">
<center>
<h2><img width="112" height="112" src="./img/vertcoin.128.png"><br/>Vertcoin</h2>
<div class="panel panel-default">
<table class="table table-bordered">
	<tbody>
	<tr><td>Hashrate</td><td><?=$vtc_hashrate;?></td></tr>
		<tr><td><img src="/img/fr.png" style="margin-bottom:2px;"> Pool</td><td>eu.p2pool.pl:9171</td></tr>
		<tr><td><img src="/img/us.png" style="margin-bottom:2px;"> Pool</td><td>... </td></tr>
		<tr><td><img src="/img/anon.png" style="margin-bottom:3px;"> Pool</td><td title="same port (9171)">wrwx2dy7jyh32o53.onion</td></tr>
		<tr><td>Username</td><td>Vertcoin Address</td></tr>
		<tr><td>Password</td><td>Anything</td></tr>
		<tr><td>Exchange</td><td><a href="https://www.cryptsy.com/markets/view/151" target="_blank">VTC/BTC</a></td></tr>
		<tr><td>Algorithm</td><td>Lyra2REv2</td></tr>
	</tbody> 
</table>
</div>
</center>
</div>

<div class="col-lg-3">
<center>
<h2><img width="112" height="112" src="./img/feathercoin.png"><br/>Feathercoin</h2>
<div class="panel panel-default">
<table class="table table-bordered">
	<tbody>
		<tr><td>Hashrate</td><td><?=$ftc_hashrate;?></td></tr>
		<tr><td><img src="/img/fr.png" style="margin-bottom:2px;"> Pool</td><td>eu.p2pool.pl:19327</td></tr>
		<tr><td><img src="/img/us.png" style="margin-bottom:2px;"> Pool</td><td>... </td></tr>
		<tr><td><img src="/img/anon.png" style="margin-bottom:3px;"> Pool</td><td title="same port (19327)">wrwx2dy7jyh32o53.onion</td></tr>
		<tr><td>Username</td><td>Feathercoin Address</td></tr>
		<tr><td>Password</td><td>Anything</td></tr>
		<tr><td>Exchange</td><td><a href="https://www.cryptsy.com/markets/view/5" target="_blank">FTC/BTC</a> | <a href="https://www.cryptsy.com/markets/view/6" target="_blank">FTC/USD</a></td></tr>
		<tr><td>Algorithm</td><td>NeoScrypt</td></tr>
	</tbody> 
</table>
</div>
</center>
</div>

</div>

</div>

<div class="footer">
Please, <u>don`t use an exchange address</u> for payout. And don`t use <lu style="color:#0076A0">no-submit-stale</lu> for sgminer. If you want use <lu style="color:#0076A0">onion p2pool</lu> use this settings (for sgminer).
<pre>"url" : "socks5:127.0.0.1:9050|stratum+tcp://wrwx2dy7jyh32o53.onion:7903"</pre>

Add two nodes in <lu style="color:#0076A0">example.conf</lu> => when one node offline your miner go to the second node. You can get <a href="http://dash.org.ru/pages/stats.php#p2pool" target="_blank">p2pool list on this page</a>.
<pre>
"pools" : [
	{
		"url" : "stratum+tcp://eu.p2pool.pl:7903",
		"user" : "XkB8ySpiqyVHeAXHsNhU83mUJ7Jd3CJaqW",
		"pass" : "x"
	},
	{
		"url" : "stratum+tcp://us.p2pool.pl:7903",
		"user" : "XkB8ySpiqyVHeAXHsNhU83mUJ7Jd3CJaqW",
		"pass" : "x"
	}
]</pre>
</div>
</div> 
	
	<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter25288835 = new Ya.Metrika({id:25288835,
                    webvisor:true,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/25288835" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
  </body>
</html>
