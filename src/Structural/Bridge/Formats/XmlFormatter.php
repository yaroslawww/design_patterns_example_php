<?php

namespace DesignPatterns\Structural\Bridge\Formats;


use SimpleXMLElement;

class XmlFormatter implements FormatterInterface
{

	/**
	 * Generate content for file
	 *
	 * @param array $data
	 *
	 * @return string
	 */
	public function convert( array $data ): string
	{
		//creating object of SimpleXMLElement
		$xml_user_info = new SimpleXMLElement("<?xml version=\"1.0\"?><user_info></user_info>");

		//function call to convert array to xml
		$this->array_to_xml($data, $xml_user_info);

		return (string) $xml_user_info->asXML();
	}

	function array_to_xml( $array, SimpleXMLElement &$xml_user_info )
	{
		foreach ( $array as $key => $value ) {
			if(is_array($value)) {
				if(!is_numeric($key)) {
					$subnode = $xml_user_info->addChild("$key");
					$this->array_to_xml($value, $subnode);
				} else {
					$subnode = $xml_user_info->addChild("item$key");
					$this->array_to_xml($value, $subnode);
				}
			} else {
				$xml_user_info->addChild("$key", htmlspecialchars("$value"));
			}
		}
	}
}