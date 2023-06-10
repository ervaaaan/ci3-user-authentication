<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author		Jack Devians
 * @copyright	Merlinbox Digital Solution
 * @link		https://merlinbox.com
*/

require_once APPPATH.'third_party/vendor/autoload.php';

class Applib {

    private static $db;

    function __construct() {
        $this->ci =& get_instance();
        $this->ci->load->database();

        self::$db = &get_instance()->db;
    }

    //Create PDF
    public function create_pdf($pdf) {
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->curlAllowUnsafeSslRequests = true;
        $mpdf->SetDisplayMode('fullpage');
        if(isset($pdf['title'])) { $mpdf->SetTitle($pdf['title']); }
        if(isset($pdf['author'])) { $mpdf->SetAuthor($pdf['author']); }
        if(isset($pdf['creator'])) { $mpdf->SetCreator($pdf['creator']); }
        if($pdf['badge'] == 'TRUE') {
            $mpdf->SetWatermarkImage(base_url('assets/img/logona.png'), 0.1, array(50,50), array(80,75));
            // $mpdf->showWatermarkImage = TRUE;
            $mpdf->showWatermarkImage = FALSE;
        } else {
            $mpdf->showWatermarkImage = FALSE;
        }
        $mpdf->WriteHTML($pdf['html']);
        if(isset($pdf['attach'])) {
            $mpdf->Output('./assets/tmp/'.$pdf['filename'],'F');
            return base_url().'assets/tmp/'.$pdf['filename'];
        } else {
            $mpdf->Output($pdf['filename'],'I');
            exit;
        }
    }

    //Create Landscape PDF
    public function create_lpdf($pdf) {
        $mpdf = new \Mpdf\Mpdf(['format' => 'A4-L']);
        $mpdf->curlAllowUnsafeSslRequests = true;
        $mpdf->SetDisplayMode('fullpage');
        if(isset($pdf['title'])) { $mpdf->SetTitle($pdf['title']); }
        if(isset($pdf['author'])) { $mpdf->SetAuthor($pdf['author']); }
        if(isset($pdf['creator'])) { $mpdf->SetCreator($pdf['creator']); }
        if($pdf['badge'] == 'TRUE') {
            $mpdf->SetWatermarkImage(base_url('assets/img/logona.png'), 0.1, array(50,50), array(120,75));
            $mpdf->showWatermarkImage = TRUE;
        } else {
            $mpdf->showWatermarkImage = FALSE;
        }
        $mpdf->WriteHTML($pdf['html']);
        if(isset($pdf['attach'])) {
            $mpdf->Output('./assets/tmp/'.$pdf['filename'],'F');
            return base_url().'assets/tmp/'.$pdf['filename'];
        } else {
            $mpdf->Output($pdf['filename'],'I');
            exit;
        }
    }

}

/* End of file Applib.php */