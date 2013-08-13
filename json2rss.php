<?php
require_once("url.php");

$content = file_get_contents($url);
$json = json_decode($content);
var_dump($json);

$xml = new DOMDocument('1.0', 'UTF-8');
$xml->formatOutput = true;

$roo = $xml->createElement('rss');
$roo->setAttribute('version', '2.0');
$xml->appendChild($roo); 

$cha = $xml->createElement('channel');
$roo->appendChild($cha); 


$hea = $xml->createElement('title',
utf8_encode('Webcomics von Stefanie Hoefig')); 
$cha->appendChild($hea);


$hea = $xml->createElement('description',
utf8_encode('Uebersicht der aktuellen Webcomics von Stefanie Hoefig')); 
$cha->appendChild($hea);


$hea = $xml->createElement('language',
utf8_encode('de')); 
$cha->appendChild($hea);


#$hea = $xml->createElement('link',htmlentities('http://xml-rss.de')); 
#$cha->appendChild($hea);

$hea = $xml->createElement("link", htmlentities("http://test.com"));
$cha->appendChild($hea);


$hea = $xml->createElement('lastBuildDate',
utf8_encode(date("D, j M Y H:i:s ").'GMT'));
$cha->appendChild($hea);


for ($i=0; $i < 2; $i++) { 
	$itm = $xml->createElement('item');
    $cha->appendChild($itm);

	$dat = $xml->createElement('title',
	utf8_encode('Titel der Nachricht')); 
	$itm->appendChild($dat);


	$dat = $xml->createElement('description',
	utf8_encode('Die Nachricht an sich')); 
	$itm->appendChild($dat);    

	$dat = $xml->createElement('link',
	htmlentities('http://www.test.de'));
	$itm->appendChild($dat);

	$dat = $xml->createElement('pubDate',
	utf8_encode('Datum der Nachricht')); 
	$itm->appendChild($dat);

	$dat = $xml->createElement('guid',
	htmlentities('Einzigartige ID')); 
	$itm->appendChild($dat);
}

echo $xml->saveXML();

?>