<?php

require_once SIAM_DIR . '/libs/PHPExcel.php';

$tahuns = SiamTahunRepo::all();
$mutus = SiamMutuRepo::all();

$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("Afief Yona Ramadhana")
->setLastModifiedBy("Sistem Audit Mutu Internal")
->setTitle("Sistem Audit Mutu Internal")
->setSubject("Mutu Program Studi")
->setDescription("Sistem Audit Mutu Internal")
->setKeywords("siam sami sistem audit mutu prodi program studi")
->setCategory("audit");

$sheet = $objPHPExcel->getActiveSheet();
$sheet->setTitle('Mutu Prodi');

$alphas = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');

/* header */
$header = array('', 'Item Sasaran');
$header = array_merge($header, $tahuns);
$header[] = 'Keterangan';

function maxColumn ($alphas, $header) {
  return $alphas[count($header)-1];
}

$sheet->mergeCells('A1:'.maxColumn($alphas, $header).'1');
$sheet->setCellValueByColumnAndRow(0, 1, "Sistem Audit Mutu Internal");

$sheet->getStyle('A1:'.maxColumn($alphas, $header).'1')->applyFromArray( array(
  'alignment' => array(
    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
  ),
  'font'  => array(
    'bold'    => true,
    'size'    => 15
  )
));

$sheet->fromArray(
  array($header),  
  NULL,        
  'A3'
);

$sheet->getStyle('A3:'.maxColumn($alphas, $header).'3')->applyFromArray( array(
  'alignment' => array(
    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
  ),
  'font'  => array(
    'bold'    => true,
    'size'    => 12
  )
));

/* aspek loop */
$prevRow = 4;
foreach ($mutus as $k => $aspek) {

  /* aspek title */
  $sheet->mergeCells('A'.$prevRow.':'.maxColumn($alphas, $header).$prevRow);
  $sheet->setCellValueByColumnAndRow(0, $prevRow, $aspek['text']);
  $sheet->getStyle('A'.$prevRow.':'.maxColumn($alphas, $header).$prevRow)->applyFromArray( array(
    'font'  => array(
      'bold'    => true,
      'size'    => 12
    )
  ));
  $sheet->getRowDimension($prevRow)->setRowHeight(30);

  $prevRow += 1;

  /* aspek contents */
  $bulks = array();
  foreach ($aspek['list'] as $key => $mutu) {
    $nr = array($key+1, $mutu['text']);
    foreach ($tahuns as $tahun) {
      $nr[] = $mutu['sasaran'][$tahun];
    }
    $nr[] = $mutu['keterangan'];
    $bulks[] = $nr;
  }
  $sheet->fromArray(
    $bulks,  
    NULL,        
    'A'.$prevRow
  );
  $sheet->getStyle('C'.$prevRow.':'.$alphas[count($tahuns)+2].($prevRow+count($aspek['list'])))->applyFromArray( array(
  'alignment' => array(
    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
    'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
  )));

  $prevRow += count($aspek['list']);
}

$sheet->getStyle('A3:' . maxColumn($alphas, $header) . ($prevRow-1))->applyFromArray(array(
  'borders' => array(
    'allborders' => array(
      'style' => PHPExcel_Style_Border::BORDER_THIN
    )
  )
));

$sheet->getColumnDimension('A')->setWidth(10);
$sheet->getColumnDimension('B')->setWidth(50);
foreach ($tahuns as $k => $tahun) {
  $sheet->getColumnDimension($alphas[$k+2])->setWidth(10);
}
$sheet->getColumnDimension($alphas[count($tahuns)+2])->setWidth(50);

$sheet->getStyle('B3:B'. ($prevRow-1))->getAlignment()->setWrapText(true); 
$sheet->getStyle($alphas[count($tahuns)+2].'3:'.$alphas[count($tahuns)+2]. ($prevRow-1))->getAlignment()->setWrapText(true); 
$sheet->setShowGridlines(false);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="audit-mutu-prodi.xlsx"');
$objWriter->save('php://output');
//$objWriter->save(SIAM_DIR . '/files/auditmutu-' . time() . '.xlsx');