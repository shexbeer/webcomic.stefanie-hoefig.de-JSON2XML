<?php
require_once("url.php");

header('Content-Type: application/rss+xml');

$content = file_get_contents($url);
$json = json_decode($content);
#var_dump($json);

$xml = new DOMDocument('1.0', 'UTF-8');
$xml->formatOutput = true;

$roo = $xml->createElement('rss');
$roo->setAttribute('version', '2.0');
$roo->setAttribute("xmlns:atom","http://www.w3.org/2005/Atom");
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

$hea = $xml->createElement("link", htmlentities("http://webcomic.stefanie-hoefig.de"));
$cha->appendChild($hea);

$hea = $xml->createElement("atom:link");
$hea->setAttribute("href",  htmlentities("http://shexbeer.square7.ch/json2rss.php"));
$hea->setAttribute("rel", "self");
$hea->setAttribute("type", "application/rss+xml");
$cha->appendChild($hea);


$hea = $xml->createElement('lastBuildDate',
utf8_encode(date("D, j M Y H:i:s ").'GMT'));
$cha->appendChild($hea);

foreach ($json as $key => $value) {
	$itm = $xml->createElement('item');
    $cha->appendChild($itm);

	$dat = $xml->createElement('title',
	$value->headline); 
	$itm->appendChild($dat);


	$dat = $xml->createElement('description',
	utf8_encode('Neues Kapitel in Manga '+$value->manga+" von "+$value->author+" gepostet.")); 
	$itm->appendChild($dat);    

	$dat = $xml->createElement('link',
	htmlentities($value->url));
	$itm->appendChild($dat);

	$dat = $xml->createElement('pubDate',
	utf8_encode($value->date)); 
	$itm->appendChild($dat);

	$dat = $xml->createElement('guid',
	$value->id); 
	$itm->appendChild($dat);
}

echo $xml->saveXML();

?>