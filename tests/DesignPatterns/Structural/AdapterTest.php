<?php

namespace Tests\DesignPatterns\Structural;


use DesignPatterns\Structural\Adapter\PdfAdapter;
use Dompdf\Dompdf;
use Mpdf\Mpdf;
use PHPUnit\Framework\TestCase;

class AdapterTest extends TestCase
{

	protected $html = '<h1>Hello World</h1><br><p>Some PDF content</p>';

	/**
	 * There example of our old code for create pdf file
	 *
	 * @throws \Mpdf\MpdfException
	 */
	public function testOldPdfCreation()
	{
		$filename = 'temp/old_creator.pdf';

		$pdf_creator = new mPDF();

		$pdf_creator->WriteHTML($this->html);

		$pdf_creator->Output($filename, 'F');

		$this->assertFileExists($filename);
	}

	/**
	 *H ere is how the code looked if we rewrote it for a new library
	 */
	public function testNewPdfCreation()
	{
		$filename = 'temp/new_creator.pdf';

		$pdf_creator = new Dompdf();

		$pdf_creator->loadHtml($this->html);
		$pdf_creator->render();

		file_put_contents($filename, $pdf_creator->output());

		$this->assertFileExists($filename);
	}

	/**
	 * There example of our new code for create pdf file and using adapter (Calling methods is identical to testOldPdfCreation.)
	 */
	public function testAdapterPdfCreation()
	{
		$filename = 'temp/adapter_creator.pdf';

		$pdf_creator = new PdfAdapter();

		$pdf_creator->WriteHTML($this->html);

		$pdf_creator->Output($filename, 'F');

		$this->assertFileExists($filename);
	}

}