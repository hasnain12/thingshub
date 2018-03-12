<?php
header('Content-Type: application/csv');
   header('Content-Disposition: attachment; filename="fieldData.csv";');

 include("dbConnection/connect.php");
require_once 'Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel(); 
if(isset($_GET['download'])){
	$cols=['Time','ChannelId','Reading','Field'];
	// die($_GET['fields']);
	$fieldss=isset($_GET['fields'])?" and field_id in (".$_GET['fields'].") group by field_id":" group by field_id";
	 $query = mysqli_query($conn,'SELECT field_id FROM `field-data` where channelId='.$_GET['c_id'].$fieldss) or die(mysqli_error($conn));
	 // $query = mysqli_query($conn,'SELECT timeStamp,channelId,reading,field_id FROM `field-data`where channelId='.$_GET['c_id']) or die(mysqli_error($conn));
	$titles=array();
	$rows = mysqli_fetch_all($query);
		foreach($rows as $row){
		 $query2 = mysqli_query($conn,'SELECT title,field_id FROM `fieldattr` where field_id='.$row[0]." and channel_id=".$_GET['c_id']) or die(mysqli_error($conn));
			$title=mysqli_fetch_row($query2);
			$titles[]=$title;
		}
		// $rowss=array_merge($cols,$rows);
		$sheet = 0;
		// print_r($titles);die;
		
foreach($titles as $value){
    if($sheet > 0){
        $objPHPExcel->createSheet();
        $sheett = $objPHPExcel->setActiveSheetIndex($sheet);
        $sheett->setTitle("$value[0]");
		$objPHPExcel->getActiveSheet()->setCellValue("A1", $cols[0])
                              ->setCellValue("B1",$cols[1])
                              ->setCellValue("C1",$cols[2])
                              ->setCellValue("D1",$cols[3]);
		$unix_condition="";
	 if(isset($_GET['start'])){
		  $start=(int)mysqli_real_escape_string($conn,$_GET['start']);
		$end=(int)mysqli_real_escape_string($conn,$_GET['end']);
		  	$unix_condition=" and UNIX_TIMESTAMP(timeStamp) between $start and $end ";
		 }
		 $query22 = mysqli_query($conn,'SELECT timeStamp,channelId,reading,field_id FROM `field-data`where channelId='.$_GET['c_id']." and field_id=".$value[1].$unix_condition) or die(mysqli_error($conn));
			$rowss = mysqli_fetch_all($query22);
	
			for($i=0;$i<count($rowss);$i++){
			$sheetIndex=$i+2;
			$objPHPExcel->getActiveSheet()->setCellValue("A$sheetIndex", $rowss[$i][0])
                              ->setCellValue("B$sheetIndex",$rowss[$i][1])
                              ->setCellValue("C$sheetIndex",$rowss[$i][2])
                              ->setCellValue("D$sheetIndex",$rowss[$i][3]);

		}
		
        //Do you want something more here
    }else{
        $objPHPExcel->setActiveSheetIndex(0)->setTitle($value[0]);
		// $sheet->setTitle("$value[0]");
		$objPHPExcel->getActiveSheet()->setCellValue("A1", "$cols[0]")
                              ->setCellValue("B1","$cols[1]")
                              ->setCellValue("C1","$cols[2]")
                              ->setCellValue("D1","$cols[3]");
		 $query22 = mysqli_query($conn,'SELECT timeStamp,channelId,reading,field_id FROM `field-data`where channelId='.$_GET['c_id']." and field_id=".$value[1]) or die(mysqli_error($conn));
			$rowss = mysqli_fetch_all($query22);
	
			for($i=0;$i<count($rowss);$i++){
			$sheetIndex=$i+2;
			$objPHPExcel->getActiveSheet()->setCellValue("A$sheetIndex", $rowss[$i][0])
                              ->setCellValue("B$sheetIndex",$rowss[$i][1])
                              ->setCellValue("C$sheetIndex",$rowss[$i][2])
                              ->setCellValue("D$sheetIndex",$rowss[$i][3]);

		}
		
	}
    $sheet++;
}  


$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
$objWriter->save('php://output');
}
?>