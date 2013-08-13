<php

$url = "http://free-ec2.scraperwiki.com/cs23iya/b4059ff5f0d743e/sql?q=select+*+from+webcomic"

$content = file_get_contents($url);

$json = json_decode($content);

var_dump($json);


?>