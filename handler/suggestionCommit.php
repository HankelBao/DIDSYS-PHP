<?php
$suggestion = $_POST['suggestionForm'];

$suggestionsXml = simplexml_load_file("suggestions.xml");
$suggestionsXml->addChild("suggestion",$suggestion);

$save_xml = $suggestionsXml->asXML();
$file = fopen("suggestions.xml","w");
fwrite($file,$save_xml);
fclose($file);
?>
