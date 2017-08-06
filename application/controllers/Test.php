<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
		// Set Property
		$this->Title = 'Test menu';
		$this->Menu = array(
			array('text'=>'test','link'=>'#'),
			array('text'=>'Test Datatable with Bootstrap 3','link'=>'datatable'),
			array('text'=>'Test Set CI Session','link'=>'test_session/set_session'),
			array('text'=>'Test Get CI Session','link'=>'test_session/get_session'),
			array('text'=>'Destroy CI Session','link'=>'test_session/destroy')
		);
    }

	public function index()
	{
		echo $this->Title;
		
		echo '<html>';
		echo '<ul>';
		foreach($this->Menu as $value){
			echo '<li><a href="'.base_url().$value['link'].'" target="_blank">'.$value['text'].'</a></li>';
		}
		echo '</ul>';
		echo '</html>';
	}

	public function pdf()
    {
        $mpdf = new mPDF(
            'th',
            'A4',
            9,
            '',
            10 ,
            0.5 ,
            30,
            0.5,
            5,
            5, 'P');
        $mpdf->SetHTMLHeader ('<img src="'.base_url('/asset/image/cover2.png').'"/>');
        $mpdf->WriteHTML('<table>');
        $mpdf->WriteHTML('<tr>');
        $mpdf->WriteHTML('<td width="90px">First name</td><td>: </td><td width="190px" align="center"><strong>จิราภรณ์</strong></td><td width="82px">Last name</td><td>: </td><td width="160px" align="center"><strong>กอชื่นจิตร</strong></td><td>Sex</td><td>: </td><td width="60px" align="center"><strong>หญิง</strong></td><td>Ethnicity</td><td>: </td><td width="40px" align="center"><strong>ไทย</strong></td>');
        $mpdf->WriteHTML('</tr>');
        $mpdf->WriteHTML('<tr>');
        $mpdf->WriteHTML('<td>ID/Passport No.</td><td>: </td><td align="center"><strong>x-xxxx-xxxxx-xx-x</strong></td><td>Date of birth</td><td>: </td><td align="center"><strong>27/04/1992</strong></td></td><td>Age</td><td>: </td><td width="70px" align="center"><strong>25</strong> years</td><td></td><td></td><td align="center">');
        $mpdf->WriteHTML('</tr>');
        $mpdf->WriteHTML('<tr>');
        $mpdf->WriteHTML('<td>E-Mail</td><td>: </td><td align="center"><strong>bleach_oui@homail.com</strong></td><td>Phone</td><td>: </td><td align="center"><strong>087-5992377</strong></td><td></td><td></td><td></td><td></td><td></td><td><strong></strong></td>');
        $mpdf->WriteHTML('</tr>');
        $mpdf->WriteHTML('<tr>');
        $mpdf->WriteHTML('<td>Received date</td><td>: </td><td align="center"><strong>12/07/2017</strong></td><td>Reported date</td><td>: </td><td align="center"><strong>12/07/2017</strong></td><td></td><td></td><td></td><td></td><td></td><td><strong></strong></td>');
        $mpdf->WriteHTML('</tr>');
        $mpdf->WriteHTML('<tr>');
        $mpdf->WriteHTML('<td>Hospital/clinic</td><td>: </td><td align="center"><strong>โรงพยาบาลศริราช</strong></td><td>Physician</td><td>: </td><td colspan="7"> <strong>ศ.ดร.นพ. วิปร วิประกษิต</strong></td>');
        $mpdf->WriteHTML('</tr>');
        $mpdf->WriteHTML('</table>');
        $mpdf->SetHTMLFooter('<table><tr><td width="500px"></td><td><img src="'.base_url('/asset/image/footer2.png').'"/></td></tr></table>');
        $mpdf->Output();
    }
}
