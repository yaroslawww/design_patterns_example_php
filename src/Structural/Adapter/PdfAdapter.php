<?php

namespace DesignPatterns\Structural\Adapter;


use Dompdf\Dompdf;

class PdfAdapter implements PdfAdapterInterface
{

	const FILE = 'F';
	const DOWNLOAD = 'D';
	const STRING_RETURN = 'S';
	const INLINE = 'I';

	protected $pdf_creator;

	/**
	 * PdfAdapter constructor.
	 */
	public function __construct()
	{
		$this->pdf_creator = new Dompdf();
	}

	public function WriteHTML( string $html ): void
	{
		$this->pdf_creator->loadHtml($html);
	}

	public function Output( $name = '', $dest = '' ): void
	{
		$dest = strtoupper($dest);
		if(empty($dest)) {
			$dest = self::FILE;
		}
		if(empty($name)) {
			$name = 'adapter.pdf';
		}

		switch ( $dest ) {
			case self::FILE:
				$this->pdf_creator->render();
				file_put_contents($name, $this->pdf_creator->output());
				break;
			case self::INLINE:
			case self::DOWNLOAD:
			case self::STRING_RETURN:
			default:
				//other implementation
				break;
		}
	}
}