<?php



function exportExcel($expTitle,$expCellName,$expTableData){
        $xlsTitle = iconv('utf-8', 'gb2312', $expTitle);//文件名称
        $fileName = $_SESSION['loginAccount'].date('_YmdHis');//or $xlsTitle 文件名称可根据自己情况设定
        $cellNum = count($expCellName);
        $dataNum = count($expTableData);
        vendor("PHPExcel.PHPExcel");
        $objPHPExcel = new PHPExcel();
        $cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(55);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25);
        //设置行高度
        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(22);

        $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);

        $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $objPHPExcel->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('D')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('F')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('G')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('H')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('I')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


        $objPHPExcel->getActiveSheet(0)->mergeCells('A1:'.$cellName[$cellNum-1].'1');//合并单元格
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $expTitle.'  Export time:'.date('Y-m-d H:i:s'));
        for($i=0;$i<$cellNum;$i++){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i].'2', $expCellName[$i][1]);
        }
          // Miscellaneous glyphs, UTF-8
        for($i=0;$i<$dataNum;$i++){
          for($j=0;$j<$cellNum;$j++){
            $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j].($i+3), $expTableData[$i][$expCellName[$j][0]]);
          }
        }

        header('pragma:public');
        header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
        header("Content-Disposition:attachment;filename=$fileName.xls");//attachment新窗口打印inline本窗口打印
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
    }

    function importExecl($file){
         // 判断文件是什么格式
            $type = pathinfo($file);
            $type = strtolower($type["extension"]);

            if($type=='xlsx'){
                $type="Excel2007";
            }else{
                $type="Excel5";
            }
            ini_set('max_execution_time', '0');
            Vendor('PHPExcel.PHPExcel');
            // 判断使用哪种格式
             require_once './ThinkPHP/Library/Vendor/PHPExcel/PHPExcel/IOFactory.php';
            $objReader = \PHPExcel_IOFactory::createReader($type);
            $objPHPExcel = $objReader->load($file);
            $sheet = $objPHPExcel->getSheet(0);
            // 取得总行数
            $highestRow = $sheet->getHighestRow();
            // 取得总列数
            $highestColumn = $sheet->getHighestColumn();
            //循环读取excel文件,读取一条,插入一条
            $data=array();
            //从第一行开始读取数据
            for($j=1;$j<=$highestRow;$j++){
                //从A列读取数据
                for($k='A';$k<=$highestColumn;$k++){
                    // 读取单元格
                    // $data[$j][]=$objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue();
                    if($k=='C'){//指定H列为时间所在列
                      $data[$j][]  = gmdate("Y-m-d H:i:s", PHPExcel_Shared_Date::ExcelToPHP($objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue()));
                      
                    }
                    else if($k=='D'){
                         $data[$j][]  = gmdate("Y-m-d H:i:s", PHPExcel_Shared_Date::ExcelToPHP($objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue()));
                   
                    }else{
                         $data[$j][] = $objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue();
                    }  

                    // if($k=='E'){//指定H列为时间所在列
                    //     $data[$j][]  = gmdate("Y-m-d H:i:s", PHPExcel_Shared_Date::ExcelToPHP($objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue()));
                    // }else{
                    //      $data[$j][] = $objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue();
                    // }                  
                    
                }
            }
            return $data;
    }
    
    // 自定义冒泡算法，减去数据库多重查询带来的负载
    // $data     需要运算的二维数组  
    // $ziduan   需要排序的二维数组的key,默认为数据库的ID
    // $where    字符串,传值参数示例  istj,1   
    // $where1[0]为分割后的第一个参数为数据内的key,
    // $where1[1]为分割后的第二个参数为表达式
    // $where1[2]为分割后的第二个参数为参数
    function MaxMain($data,$ziduan='id',$where=""){
        $score=$data;
        $len=count($score);
        if(!empty($where)){
            $where1=explode(",",$where);
            for($j=0;$j<$len-1;$j++){
                for($i=0;$i<$len-$j-1;$i++){
                       if($score[$i][$ziduan]<$score[$i+1][$ziduan] && $score[$i][$where1[0]].$where1[1].$where1[2]){
                            $max=$score[$i+1];
                            $score[$i+1]=$score[$i];
                            $score[$i]=$max;
                        }
                }
                
            }
         }else{
            for($j=0;$j<$len-1;$j++){
                for($i=0;$i<$len-$j-1;$i++){
                    if($score[$i][$ziduan]<$score[$i+1][$ziduan]){
                    $max=$score[$i+1];
                    $score[$i+1]=$score[$i];
                    $score[$i]=$max;
                    }
                }
            }
         }
        return $score;
    }
function is_weixin(){ 
    if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {
            return true;
    }   
    return false;
}
