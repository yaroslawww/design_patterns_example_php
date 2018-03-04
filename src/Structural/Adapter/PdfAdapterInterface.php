<?php

namespace DesignPatterns\Structural\Adapter;


interface PdfAdapterInterface
{

	public function WriteHTML( string $html ): void;

	public function Output( $name = '', $dest = '' ): void;

}