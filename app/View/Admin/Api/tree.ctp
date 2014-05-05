<?php
$xmlDoc = new DOMDocument();
$root = $xmlDoc->appendChild($xmlDoc->createElement("nodes"));
if (is_array($data))
{
	foreach ($data as $key => $value)
	{
		$xmlNode = $root->appendChild($xmlDoc->createElement('node'));
		$xmlNode->appendChild($xmlDoc->createElement('id', $value['id']));
		$xmlNode->appendChild($xmlDoc->createElement('text', $value['text']));
		if (isset($value['cls'])) $xmlNode->appendChild($xmlDoc->createElement('cls', $value['cls']));
		if (isset($value['leaf'])) $xmlNode->appendChild($xmlDoc->createElement('leaf', $value['leaf']));
		if (isset($value['expanded'])) $xmlNode->appendChild($xmlDoc->createElement('expanded', $value['expanded']));
	}
}
$xmlDoc->formatOutput = true;
echo $xmlDoc->saveXml();

