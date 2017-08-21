<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class IoExcel
{
    private $_reader = NULL;

    //构造函数
    public function __construct()
    {

    }

    /**
     * XLSX 处理后导入到数据库
     */
     public function xlsxToDb($file_path){


         /** Include PHPExcel_IOFactory */
         require_once dirname(__FILE__) . '/Classes/PHPExcel/IOFactory.php';
         $this->_reader = PHPExcel_IOFactory::createReader('Excel2007');

         //$res = $this->read(dirname(__FILE__) .'/test.xlsx');
         $res = $this->read($file_path);
        //$res = $this->read($savePath . $file_name);
//         echo '<pre>';
//         var_dump($res);
//         echo '</pre>';
         return $res;
     }

    /**
     * XLS 处理后导入到数据库
     */
    public function xlsToDb($file_path){
        /** Include PHPExcel_IOFactory */
        require_once dirname(__FILE__) . '/Classes/PHPExcel/IOFactory.php';
        $this->_reader = PHPExcel_IOFactory::createReader('Excel5');

        //$res = $this->read(dirname(__FILE__) .'/test2.xls');
        $res = $this->read($file_path);
        //$res = $this->read(dirname(__FILE__) .'/customs.xls');
        //$res = $this->read($savePath . $file_name);
//        echo '<pre>';
//        var_dump($res);
//        echo '</pre>';
        return $res;
    }

    /**
     * 数据库数据处理后导出为XLSX文件
     */
    public function dbToXlsx($filename='test',$datas= array()){
        $filename = '备案商品表';
        $datas =  array(
            array('name'=>'张三','age'=>29),
            array('name'=>'李四','age'=>26),
        );

        /** Include PHPExcel */
        require_once dirname(__FILE__) . '/Classes/PHPExcel.php';

        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();

        // Set document properties
        $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
            ->setLastModifiedBy("Maarten Balliauw")
            ->setTitle("Office 2007 XLSX Test Document")
            ->setSubject("Office 2007 XLSX Test Document")
            ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("Test result file");


        // Add some data
        $letters = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ');
        for ($i=1; $i<=count($datas); $i++) {
            $tmp = array_values($datas[$i-1]);
            for ($j=0; $j<count($tmp); $j++) {
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueExplicit($letters[$j].$i, " ".$tmp[$j], PHPExcel_Cell_DataType::TYPE_STRING2);
            }
        }


        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('Simple');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        //exit;
        return true;
    }



    /**
     * 数据库数据处理后导出为 XLS 文件
     */
    public function dbToXls($filename='test',$datas= array()){
        $filename = '备案商品表';
        $datas =  array(
            array('name'=>'张三','age'=>29),
            array('name'=>'李四','age'=>26),
        );

        /** Include PHPExcel */
        require_once dirname(__FILE__) . '/Classes/PHPExcel.php';


        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();

        // Set document properties
        $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
            ->setLastModifiedBy("Maarten Balliauw")
            ->setTitle("Office 2007 XLSX Test Document")
            ->setSubject("Office 2007 XLSX Test Document")
            ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("Test result file");


        // Add some data
        $letters = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ');
        for ($i=1; $i<=count($datas); $i++) {
            $tmp = array_values($datas[$i-1]);
            for ($j=0; $j<count($tmp); $j++) {
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letters[$j].$i, " ".$tmp[$j], PHPExcel_Cell_DataType::TYPE_STRING2);
            }
        }

        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('Simple');


        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);


        // Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        return true;
    }



    public function savexls2($filename = 'test', $datas = array()) {
        $datas = array('name'=>'张三','age'=>29);
        require_once dirname(__FILE__) . '/Classes/PHPExcel.php';


        $letters = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ');
        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();

        // Set document properties
        $objPHPExcel
            ->getProperties()
            ->setCreator("cofco-dealer-system")
            ->setLastModifiedBy("cofco-dealer-system")
            ->setTitle("Office 2007 XLSX Test Document")
            ->setSubject("Office 2007 XLSX Test Document")
            ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("Test result file");

        for ($i=1; $i<=count($datas); $i++) {
            $tmp = array_values($datas[$i-1]);
            for ($j=0; $j<count($tmp); $j++) {
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueExplicit($letters[$j].$i, " ".$tmp[$j], PHPExcel_Cell_DataType::TYPE_STRING2);
            }
        }

        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle($filename);

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        // Redirect output to a client web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        return true;
    }

    private function read($filename){
        $this->_reader->setReadDataOnly(true);
        $objPHPExcel = $this->_reader->load($filename);
        $objWorksheet = $objPHPExcel->getActiveSheet();
        $highestRow = $objWorksheet->getHighestRow();
        $highestColumn = $objWorksheet->getHighestColumn();
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
        $excelData = array();
        for ($row = 1; $row <= $highestRow; $row++) {
            for ($col = 0,$currentColumn='A'; $col < $highestColumnIndex; $col++,$currentColumn++) {
                 //第四行为日期需要特殊处理下
                //$excelData[$row][] = gmdate("Y-m-d H:i:s", PHPExcel_Shared_Date::ExcelToPHP($objWorksheet->getCellByColumnAndRow($col, $row)->getValue()));

                //$excelData[$row][] =$objWorksheet->getCellByColumnAndRow($col, $row)->getValue();

              $excelData[$row][] = (string)$objWorksheet->getCell($currentColumn.$row)->getCalculatedValue();


            }
        }



        return $excelData;
    }

}