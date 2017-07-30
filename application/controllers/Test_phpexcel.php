<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_phpexcel extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        /** Include PHPExcel */
        include APPPATH . 'third_party\PHPExcel\PHPExcel.php';
    }

    public function index()
    {
        define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

        // Create new PHPExcel object
        echo date('H:i:s') , " Create new PHPExcel object" , EOL;
        $objPHPExcel = new PHPExcel();

        // Set document properties
        echo date('H:i:s') , " Set document properties" , EOL;
        $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
            ->setLastModifiedBy("Maarten Balliauw")
            ->setTitle("PHPExcel Test Document")
            ->setSubject("PHPExcel Test Document")
            ->setDescription("Test document for PHPExcel, generated using PHP classes.")
            ->setKeywords("office PHPExcel php")
            ->setCategory("Test result file");

        // Add some data
        echo date('H:i:s') , " Add some data" , EOL;
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Hello Fern')
            ->setCellValue('B2', 'world!')
            ->setCellValue('C1', 'Hello')
            ->setCellValue('D2', 'world!');

        // Miscellaneous glyphs, UTF-8
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A4', 'Miscellaneous glyphs')
            ->setCellValue('A5', 'éàèùâêîôûëïüÿäöüç');

        $objPHPExcel->getActiveSheet()->setCellValue('A8',"Hello\nWorld");
        $objPHPExcel->getActiveSheet()->getRowDimension(8)->setRowHeight(-1);
        $objPHPExcel->getActiveSheet()->getStyle('A8')->getAlignment()->setWrapText(true);

        $value = "-ValueA\n-Value B\n-Value C";
        $objPHPExcel->getActiveSheet()->setCellValue('A10', $value);
        $objPHPExcel->getActiveSheet()->getRowDimension(10)->setRowHeight(-1);
        $objPHPExcel->getActiveSheet()->getStyle('A10')->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A10')->setQuotePrefix(true);

        // Rename worksheet
        echo date('H:i:s') , " Rename worksheet" , EOL;
        $objPHPExcel->getActiveSheet()->setTitle('Simple');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        // Save Excel 2007 file
        echo date('H:i:s') , " Write to Excel2007 format" , EOL;
        $callStartTime = microtime(true);

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('./exports/test.xlsx');
        $callEndTime = microtime(true);
        $callTime = $callEndTime - $callStartTime;

        echo date('H:i:s') , " File written to " , str_replace('.php', '.xlsx', pathinfo(__FILE__, PATHINFO_BASENAME)) , EOL;
        echo 'Call time to write Workbook was ' , sprintf('%.4f',$callTime) , " seconds" , EOL;
        // Echo memory usage
        echo date('H:i:s') , ' Current memory usage: ' , (memory_get_usage(true) / 1024 / 1024) , " MB" , EOL;

        // Echo memory peak usage
        echo date('H:i:s') , " Peak memory usage: " , (memory_get_peak_usage(true) / 1024 / 1024) , " MB" , EOL;

        // Echo done
        echo date('H:i:s') , " Done writing files" , EOL;
        echo 'Files have been created in ' , getcwd() , EOL;
    }

    public function export_data()
    {
        $data = array(
            'columns'=>array(
                'a'=>'A',
                'b'=>'B'
            ),
            'rows'=>array(
                array('AA', 'BB'),
                array('AAA', 'BBB'),
                array('CCC', 'DDD'),
            )
        );

        $excel = $this->create();
        $excel->setActiveSheetIndex(0);
        $excel = $this->writeColumns($excel,$data);
        $excel = $this->writeRows($excel,$data);
        $this->save($excel);


    }

    private function create()
    {
        // Create new PHPExcel object
        //echo date('H:i:s') , " Create new PHPExcel object" , EOL;
        $objPHPExcel = new PHPExcel();

        // Set document properties
        //echo date('H:i:s') , " Set document properties" , EOL;
        $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
            ->setLastModifiedBy("Maarten Balliauw")
            ->setTitle("PHPExcel Test Document")
            ->setSubject("PHPExcel Test Document")
            ->setDescription("Test document for PHPExcel, generated using PHP classes.")
            ->setKeywords("office PHPExcel php")
            ->setCategory("Test result file");

        return $objPHPExcel;
    }

    private function writeColumns($excel,$data)
    {
        $row = 1;
        foreach($data['columns'] as $key=>$value){
            $excel->getActiveSheet()->setCellValue($key.$row, $value);
        }
        return $excel;
    }

    private function writeRows($excel,$data)
    {
        $row = 2;
        foreach($data['rows'] as $value){
            $column = 0;
            foreach($data['columns'] as $columns_key=>$columns_value){
                $excel->getActiveSheet()->setCellValue($columns_key.$row, $value[$column++]);
            }
            $row++;
        }
        return $excel;
    }

    private function save($excel)
    {
        $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $objWriter->save('./exports/test.xlsx');
    }
}
