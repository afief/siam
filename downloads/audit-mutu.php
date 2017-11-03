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
$header = array(array('', 'Item Sasaran'), array('',''));
foreach ($tahuns as $tahun) {
  $header[0][] = $tahun;
  $header[0][] = '';
  $header[0][] = '';

  $header[1][] = 'Sasaran';
  $header[1][] = 'Capaian';
  $header[1][] = 'Audit';
}
$header[0][] = 'Keterangan';
$header[1][] = '';

function maxColumn ($alphas, $header) {
  return $alphas[count($header[0])-1];
}

$sheet->mergeCells('A1:'.maxColumn($alphas, $header).'1');
$sheet->mergeCells('A2:'.maxColumn($alphas, $header).'2');
$sheet->setCellValueByColumnAndRow(0, 1, "Sistem Audit Mutu Internal");
$sheet->setCellValueByColumnAndRow(0, 2, "Hasil Audit Mutu");

$sheet->getStyle('A1:'.maxColumn($alphas, $header).'2')->applyFromArray( array(
  'alignment' => array(
    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
  ),
  'font'  => array(
    'bold'    => true,
    'size'    => 15
  )
));

/* table header */
$sheet->mergeCells('A4:A5');
$sheet->mergeCells('B4:B5');
foreach ($tahuns as $k => $tahun) {
  $sheet->mergeCells($alphas[($k*3+2)].'4:'.$alphas[($k*3+2)+2].'4');
}

$sheet->fromArray(
  $header,  
  NULL,        
  'A4'
);

$sheet->getStyle('A4:'.maxColumn($alphas, $header).'5')->applyFromArray( array(
  'alignment' => array(
    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
  ),
  'font'  => array(
    'bold'    => true,
    'size'    => 12
  )
));

/* aspek loop */
$prevRow = 6;
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
      $nr[] = $mutu['capaian'][$tahun];
      $nr[] = $mutu['audit'][$tahun];
    }
    $nr[] = $mutu['keterangan'];
    $bulks[] = $nr;
  }
  $sheet->fromArray(
    $bulks,  
    NULL,        
    'A'.$prevRow
  );
  $sheet->getStyle('C'.$prevRow.':'.$alphas[count($tahuns)*3+1].($prevRow+count($aspek['list'])))->applyFromArray( array(
  'alignment' => array(
    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
    'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
  )));

  $prevRow += count($aspek['list']);
}

$sheet->getStyle('A4:' . maxColumn($alphas, $header) . ($prevRow-1))->applyFromArray(array(
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
$sheet->getColumnDimension($alphas[count($tahuns)*3+2])->setWidth(50);

$sheet->getStyle('B3:B'. ($prevRow-1))->getAlignment()->setWrapText(true); 
$sheet->getStyle($alphas[count($tahuns)*3+2].'3:'.$alphas[count($tahuns)*3+2]. ($prevRow-1))->getAlignment()->setWrapText(true); 
$sheet->setShowGridlines(false);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="hasil-audit-mutu-prodi.xlsx"');
$objWriter->save('php://output');
//$objWriter->save(SIAM_DIR . '/files/auditmutu-' . time() . '.xlsx');