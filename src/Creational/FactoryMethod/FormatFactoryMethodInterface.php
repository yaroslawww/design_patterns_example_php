<?php

namespace DesignPatterns\Creational\FactoryMethod;


interface FormatFactoryMethodInterface
{

	public function convert( $format = 'json' ) : string ;

}