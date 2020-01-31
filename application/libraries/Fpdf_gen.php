<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
/**
* Name:  FPDF
*
* Author: Jd Fiscus
* 	 	  jdfiscus@gmail.com
*         @iamfiscus
*
*
* Origin API Class: http://www.fpdf.org/
*
* Location: http://github.com/iamfiscus/Codeigniter-FPDF/
*
* Created:  06.22.2010
*
* Description:  This is a Codeigniter library which allows you to generate a PDF with the FPDF library
*
*/

class Fpdf_gen {

	public function __construct() {

		include_once APPPATH . '/third_party/fpdf/fpdf.php';

	}

}
