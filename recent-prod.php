<?php
  date_default_timezone_set("America/Mazatlan");
  /*
   * Select Barco Name
   */
  $total = 0; $total2 = 0; $total3 = 0; $total4 = 0; $total5 = 0; $total6 = 0;
  $output = '';
  $barco = db_select('node', 'bnode2');
  
  $barco->addField('bnode2', 'nid', 'barNID');
  $barco->addField('bnode2', 'title', 'barName');
  
  /*
   * Select Barco Target ID
   */
  
  $barTID = db_select('field_data_field_barco_viaje', 'b');
  $barTID->join($barco, 'barJoin', 'barJoin.barNID = b.field_barco_viaje_target_id');
  
  $barTID->addField('b', 'entity_id', 'barEID');
  $barTID->addField('b', 'field_barco_viaje_target_id', 'barTID');
  $barTID->addField('barJoin', 'barName', 'barName');
  
  /*
   * Select Captura
   */
  
  $captura = db_select('field_data_field_total_capt_diario', 'c');
  
  $captura->addField('c', 'entity_id', 'capEID');
  $captura->addField('c', 'field_total_capt_diario_value', 'captVal');
  
  /*
   * Select Ubicacion
   */
  $ubicacion = db_select('field_data_field_ubicacion_diario', 'u');
  
  $ubicacion->addField('u', 'entity_id', 'ubiEID');
  $ubicacion->addField('u', 'field_ubicacion_diario_value', 'ubiVal');
  
  /*
   * Select Fecha
   */
  $fecha = db_select('field_data_field_fecha_diario', 'f');
  
  $fecha->addField('f', 'entity_id', 'fechaEID');
  $fecha->addField('f', 'field_fecha_diario_value', 'fechaVal');
  
  /*
   * Select Reporte Ejecutivo
   */
  
  $repoEjec = db_select('field_data_field_reporte_ejec_altamar_diari', 're');
  
  $repoEjec->addField('re', 'entity_id', 'repoEID');
  $repoEjec->addField('re', 'field_reporte_ejec_altamar_diari_value', 'repoVal');
  
  /*
   * Select Captura from the last 6 days
   */
  $query6 = db_select('node', 'n6');
  $query6->leftJoin($fecha, 'fJoin6', 'fJoin6.fechaEID = n6.nid');
  $query6->leftJoin($ubicacion, 'uJoin6', 'uJoin6.ubiEID = n6.nid');
  $query6->leftJoin($captura, 'cJoin6', 'cJoin6.capEID = n6.nid');
  $query6->leftJoin($barTID, 'bTIDJoin6', 'bTIDJoin6.barEID = n6.nid');
  
  $query6->leftJoin($repoEjec, 'repoJoin6', 'repoJoin6.repoEID = n6.nid');
  $query6->addField('repoJoin6', 'repoVal', 'Repo6');
  
  $query6->addField('n6', 'title', 'Reporte6');
  $query6->addField('fJoin6', 'fechaVal', 'Fecha6');
  $query6->addField('uJoin6', 'ubiVal', 'Ubicacion6');
  $query6->addField('cJoin6', 'captVal', 'Captura6');
  $query6->addField('bTIDJoin6', 'barName', 'Barco6');
  
  
  $query6->condition('n6.type', 'reporte_diario', '=');
  $query6->condition('uJoin6.ubiVal', 'Altamar', '=');
  $query6->where('fechaVal = DATE_SUB(CURRENT_DATE, INTERVAL 7 DAY)');
  
  $query6->orderBy('Barco6');
  $exeResults6 = $query6->execute();
  $results6 = $exeResults6->fetchAll();
  
  /*
   * Select Captura from the last 5 days
   */
  $query = db_select('node', 'n');
  $query->leftJoin($fecha, 'fJoin', 'fJoin.fechaEID = n.nid');
  $query->leftJoin($ubicacion, 'uJoin', 'uJoin.ubiEID = n.nid');
  $query->leftJoin($captura, 'cJoin', 'cJoin.capEID = n.nid');
  $query->leftJoin($barTID, 'bTIDJoin', 'bTIDJoin.barEID = n.nid');
  
  $query->leftJoin($repoEjec, 'repoJoin', 'repoJoin.repoEID = n.nid');
  $query->addField('repoJoin', 'repoVal', 'Repo');
  
  $query->addField('n', 'title', 'Reporte');
  $query->addField('fJoin', 'fechaVal', 'Fecha');
  $query->addField('uJoin', 'ubiVal', 'Ubicacion');
  $query->addField('cJoin', 'captVal', 'Captura');
  $query->addField('bTIDJoin', 'barName', 'Barco');
  
  $query->condition('n.type', 'reporte_diario', '=');
  $query->condition('uJoin.ubiVal', 'Altamar', '=');
  $query->where('fechaVal = DATE_SUB(CURRENT_DATE, INTERVAL 5 DAY)');
  
  $query->orderBy('Barco');
  $exeResults = $query->execute();
  $results = $exeResults->fetchAll();
  
  /*
   * Select Captura from the last 4 days
   */
  $query2 = db_select('node', 'n2');
  $query2->leftJoin($fecha, 'fJoin2', 'fJoin2.fechaEID = n2.nid');
  $query2->leftJoin($ubicacion, 'uJoin2', 'uJoin2.ubiEID = n2.nid');
  $query2->leftJoin($captura, 'cJoin2', 'cJoin2.capEID = n2.nid');
  $query2->leftJoin($barTID, 'bTIDJoin2', 'bTIDJoin2.barEID = n2.nid');
  
  $query2->leftJoin($repoEjec, 'repoJoin2', 'repoJoin2.repoEID = n2.nid');
  $query2->addField('repoJoin2', 'repoVal', 'Repo2');
  
  $query2->addField('n2', 'title', 'Reporte2');
  $query2->addField('fJoin2', 'fechaVal', 'Fecha2');
  $query2->addField('uJoin2', 'ubiVal', 'Ubicacion2');
  $query2->addField('cJoin2', 'captVal', 'Captura2');
  $query2->addField('bTIDJoin2', 'barName', 'Barco2');
  
  $query2->condition('n2.type', 'reporte_diario', '=');
  $query2->condition('uJoin2.ubiVal', 'Altamar', '=');
  $query2->where('fechaVal = DATE_SUB(CURRENT_DATE, INTERVAL 4 DAY)');
  
  $query2->orderBy('Barco2');
  $exeResults2 = $query2->execute();
  $results2 = $exeResults2->fetchAll();
  
  /*
   * Select Captura from the last 3 days
   */
  $query3 = db_select('node', 'n3');
  $query3->leftJoin($fecha, 'fJoin3', 'fJoin3.fechaEID = n3.nid');
  $query3->leftJoin($ubicacion, 'uJoin3', 'uJoin3.ubiEID = n3.nid');
  $query3->leftJoin($captura, 'cJoin3', 'cJoin3.capEID = n3.nid');
  $query3->leftJoin($barTID, 'bTIDJoin3', 'bTIDJoin3.barEID = n3.nid');
  
  $query3->leftJoin($repoEjec, 'repoJoin3', 'repoJoin3.repoEID = n3.nid');
  $query3->addField('repoJoin3', 'repoVal', 'Repo3');
  
  $query3->addField('n3', 'title', 'Reporte3');
  $query3->addField('fJoin3', 'fechaVal', 'Fecha3');
  $query3->addField('uJoin3', 'ubiVal', 'Ubicacion3');
  $query3->addField('cJoin3', 'captVal', 'Captura3');
  $query3->addField('bTIDJoin3', 'barName', 'Barco3');
  
  $query3->condition('n3.type', 'reporte_diario', '=');
  $query3->condition('uJoin3.ubiVal', 'Altamar', '=');
  $query3->where('fechaVal = DATE_SUB(CURRENT_DATE, INTERVAL 3 DAY)');
  
  $query3->orderBy('Barco3');
  $exeResults3 = $query3->execute();
  $results3 = $exeResults3->fetchAll();
  
  /*
   * Select Captura from the last 2 days
   */
  $query4 = db_select('node', 'n4');
  $query4->leftJoin($fecha, 'fJoin4', 'fJoin4.fechaEID = n4.nid');
  $query4->leftJoin($ubicacion, 'uJoin4', 'uJoin4.ubiEID = n4.nid');
  $query4->leftJoin($captura, 'cJoin4', 'cJoin4.capEID = n4.nid');
  $query4->leftJoin($barTID, 'bTIDJoin4', 'bTIDJoin4.barEID = n4.nid');
  
  $query4->leftJoin($repoEjec, 'repoJoin4', 'repoJoin4.repoEID = n4.nid');
  $query4->addField('repoJoin4', 'repoVal', 'Repo4');
  
  $query4->addField('n4', 'title', 'Reporte4');
  $query4->addField('fJoin4', 'fechaVal', 'Fecha4');
  $query4->addField('uJoin4', 'ubiVal', 'Ubicacion4');
  $query4->addField('cJoin4', 'captVal', 'Captura4');
  $query4->addField('bTIDJoin4', 'barName', 'Barco4');
  
  $query4->condition('n4.type', 'reporte_diario', '=');
  $query4->condition('uJoin4.ubiVal', 'Altamar', '=');
  $query4->where('fechaVal = DATE_SUB(CURRENT_DATE, INTERVAL 2 DAY)');

  $query4->orderBy('Barco4');
  $exeResults4 = $query4->execute();
  $results4 = $exeResults4->fetchAll();
  
  /*
   * Select Captura from the last 1 days
   */
  $query5 = db_select('node', 'n5');
  $query5->leftJoin($fecha, 'fJoin5', 'fJoin5.fechaEID = n5.nid');
  $query5->leftJoin($ubicacion, 'uJoin5', 'uJoin5.ubiEID = n5.nid');
  $query5->leftJoin($captura, 'cJoin5', 'cJoin5.capEID = n5.nid');
  $query5->leftJoin($barTID, 'bTIDJoin5', 'bTIDJoin5.barEID = n5.nid');
  
  $query5->leftJoin($repoEjec, 'repoJoin5', 'repoJoin5.repoEID = n5.nid');
  $query5->addField('repoJoin5', 'repoVal', 'Repo5');
  
  $query5->addField('n5', 'title', 'Reporte5');
  $query5->addField('fJoin5', 'fechaVal', 'Fecha5');
  $query5->addField('uJoin5', 'ubiVal', 'Ubicacion5');
  $query5->addField('cJoin5', 'captVal', 'Captura5');
  $query5->addField('bTIDJoin5', 'barName', 'Barco5');
  
  $query5->condition('n5.type', 'reporte_diario', '=');
  $query5->condition('uJoin5.ubiVal', 'Altamar', '=');
  $query5->where('fechaVal = DATE_SUB(CURRENT_DATE, INTERVAL 1 DAY)');

  $query5->orderBy('Barco5');
  $exeResults5 = $query5->execute();
  $results5 = $exeResults5->fetchAll();
  
  /*
   * Row
   */
  $output .= '<div class="row">';
  
  //$output .= '</div>'; // End of col-lg-2
  
  /*
   * Bootstrap Panel
   */
  
  /*
   * Day 1
   */
  $output .= '<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">';
  $date5 = date('Y-m-d', strtotime("-1 days"));
  $date5_2 = date('d-m-Y', strtotime("-1 days"));
  $output .= '<div class="panel panel-info">';
  $output .= '<div class="panel-heading"><a href="/reportes/diario-ejecutivo/?date='. $date5 .'">'. $date5_2 .'</a></div>';
  $output .= '<div class="panel-body">';
  $output .= '<table class="table table-responsive table-hover">';
  $output .= '<tr>';
  
  $output .= '<td>';
  $output .= 'Barco';
  $output .= '</td>';
  $output .= '<td>';
  $output .= 'Total';
  $output .= '</td>';
  
  $output .= '</tr>';
  
  foreach ($results5 as $result5) {
    $total5 += $result5->Captura5;
    $output .= '<tr>';
    
    $output .= '<td data-toggle="tooltip" data-placement="top" title = "' . $result5->Repo5 . '">';
    $output .= $result5->Barco5;
    $output .= '</td>';
    $output .= '<td>';
    $output .= $result5->Captura5;
    $output .= '</td>';
    
    $output .= '</tr>';
  }
  
  $output .= "<tr><td>Total :</td><td>$total5</td></tr>";
  $output .= '</table>';
  
  $output .= '</div>'; // End of Panel Body
  $output .= '</div>'; // End of Panel
  $output .= '</div>'; // End of col-lg-2
  // End of Day 1
  
  /*
   * Day 2
   */
  $output .= '<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">';
  $date5 = date('Y-m-d', strtotime("-2 days"));
  $date5_2 = date('d-m-Y', strtotime("-2 days"));
  $output .= '<div class="panel panel-info">';
  $output .= '<div class="panel-heading"><a href="/reportes/diario-ejecutivo/?date='. $date5 .'">'. $date5_2 .'</a></div>';
  $output .= '<div class="panel-body">';
  $output .= '<table class="table table-responsive table-hover">';
  $output .= '<tr>';
  
  $output .= '<td>';
  $output .= 'Barco';
  $output .= '</td>';
  $output .= '<td>';
  $output .= 'Total';
  $output .= '</td>';
  
  $output .= '</tr>';
  
  foreach ($results4 as $result4) {
    $total4 += $result4->Captura4;
    $output .= '<tr>';
    
    $output .= '<td data-toggle="tooltip" data-placement="top" title = "' . $result4->Repo4 . '">';
    $output .= $result4->Barco4;
    $output .= '</td>';
    $output .= '<td>';
    $output .= $result4->Captura4;
    $output .= '</td>';
  
    $output .= '</tr>';
  }
  
  $output .= "<tr><td>Total :</td><td>" . number_format($total4, 2) . "</td></tr>";
  $output .= '</table>';
  
  $output .= '</div>'; // End of Panel Body
  $output .= '</div>'; // End of Panel
  $output .= '</div>'; // End of col-lg-2
  // End of Day 2
  
  /*
   * Day 3
   */
  $output .= '<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">';
  $date5 = date('Y-m-d', strtotime("-3 days"));
  $date5_2 = date('d-m-Y', strtotime("-3 days"));
  $output .= '<div class="panel panel-info">';
  $output .= '<div class="panel-heading"><a href="/reportes/diario-ejecutivo/?date='. $date5 .'">'. $date5_2 .'</a></div>';
  $output .= '<div class="panel-body">';
  $output .= '<table class="table table-responsive table-hover">';
  $output .= '<tr>';
  
  $output .= '<td>';
  $output .= 'Barco';
  $output .= '</td>';
  $output .= '<td>';
  $output .= 'Total';
  $output .= '</td>';
  
  $output .= '</tr>';
  
  foreach ($results3 as $result3) {
    $total3 += $result3->Captura3;
    $output .= '<tr>';
    
    $output .= '<td data-toggle="tooltip" data-placement="top" title = "' . $result3->Repo3 . '">';
    $output .= $result3->Barco3;
    $output .= '</td>';
    $output .= '<td>';
    $output .= $result3->Captura3;
    $output .= '</td>';
    
    $output .= '</tr>';
  }
  
  $output .= "<tr><td>Total :</td><td>" . number_format($total3, 2) . "</td></tr>";
  $output .= '</table>';
  
  $output .= '</div>'; // End of Panel Body
  $output .= '</div>'; // End of Panel
  $output .= '</div>'; // End of col-lg-2
  // End of Day 3
  
  /*
   * Day 4
   */
  $output .= '<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">';
  $date5 = date('Y-m-d', strtotime("-4 days"));
  $date5_2 = date('d-m-Y', strtotime("-4 days"));
  $output .= '<div class="panel panel-info">';
  $output .= '<div class="panel-heading"><a href="/reportes/diario-ejecutivo/?date='. $date5 .'">'. $date5_2 .'</a></div>';
  $output .= '<div class="panel-body">';
  $output .= '<table class="table table-responsive table-hover">';
  $output .= '<tr>';
  
  $output .= '<td>';
  $output .= 'Barco';
  $output .= '</td>';
  $output .= '<td>';
  $output .= 'Total';
  $output .= '</td>';
  
  
  $output .= '</tr>';
  
  foreach ($results2 as $result2) {
    $total2 += $result2->Captura2;
    $output .= '<tr>';
    
    $output .= '<td data-toggle="tooltip" data-placement="top" title = "' . $result2->Repo2 . '">';
    $output .= $result2->Barco2;
    $output .= '</td>';
    $output .= '<td>';
    $output .= $result2->Captura2;
    $output .= '</td>';
    
    $output .= '</tr>';
  }
  
  $output .= "<tr><td>Total :</td><td>" . number_format($total2, 2) . "</td></tr>";
  $output .= '</table>';
  
  $output .= '</div>'; // End of Panel Body
  $output .= '</div>'; // End of Panel
  $output .= '</div>'; // End of col-lg-2
  // End of Day 4
  
  /*
   * Day 5
   */
  $output .= '<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">';
  $date5 = date('Y-m-d', strtotime("-5 days"));
  $date5_2 = date('d-m-Y', strtotime("-5 days"));
  $output .= '<div class="panel panel-info">';
  $output .= '<div class="panel-heading"><a href="/reportes/diario-ejecutivo/?date='. $date5 .'">'. $date5_2 .'</a></div>';
  $output .= '<div class="panel-body">';
  $output .= '<table class="table table-responsive table-hover">';
  $output .= '<tr>';
  
  $output .= '<td>';
  $output .= 'Barco';
  $output .= '</td>';
  $output .= '<td>';
  $output .= 'Total';
  $output .= '</td>';
  
  $output .= '</tr>';
  
  foreach ($results as $result) {
    $total += $result->Captura;
    $output .= '<tr>';
    
    $output .= '<td data-toggle="tooltip" data-placement="top" title = "' . $result->Repo . '">';
    $output .= $result->Barco;
    $output .= '</td>';
    $output .= '<td>';
    $output .= $result->Captura;
    $output .= '</td>';
    
    $output .= '</tr>';
  }
  
  $output .= "<tr><td>Total :</td><td>" . number_format($total, 2) . "</td></tr>";
  $output .= '</table>';
  
  $output .= '</div>'; // End of Panel Body
  $output .= '</div>'; // End of Panel
  $output .= '</div>'; // End of col-lg-2
  // End of Day 5
  
  /*
   * Day 6
   */
  $output .= '<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">';
  $date5 = date('Y-m-d', strtotime("-6 days"));
  $date5_2 = date('d-m-Y', strtotime("-6 days"));
  $output .= '<div class="panel panel-info">';
  $output .= '<div class="panel-heading"><a href="/reportes/diario-ejecutivo/?date='. $date5 .'">'. $date5_2 .'</a></div>';
  $output .= '<div class="panel-body">';
  $output .= '<table class="table table-responsive table-hover">';
  $output .= '<tr>';
  
  $output .= '<td>';
  $output .= 'Barco';
  $output .= '</td>';
  $output .= '<td>';
  $output .= 'Total';
  $output .= '</td>';
  
  $output .= '</tr>';
  
  foreach ($results6 as $result6) {
    $total6 += $result6->Captura6;
    $output .= '<tr>';
    
    $output .= '<td data-toggle="tooltip" data-placement="top" title = "' . $result6->Repo6 . '">';
    $output .= $result6->Barco6;
    $output .= '</td>';
    $output .= '<td>';
    $output .= $result6->Captura6;
    $output .= '</td>';
    
    $output .= '</tr>';
  }
  
  $output .= "<tr><td>Total :</td><td>" . number_format($total6, 2) . "</td></tr>";
  $output .= '</table>';
  
  $output .= '</div>'; // End of Panel Body
  $output .= '</div>'; // End of Panel
  $output .= '</div>'; // End of col-lg-2
  // End of Day 6
  
  
  $output .= '</div>'; // End of Row
  
  return $output;
?>
