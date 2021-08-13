<?php
include_once('config.php');
include_once('functions.php');
connect();

// if ( stristr($_SERVER['HTTP_ACCEPT'],"application/xml")) {
//   		header("Content-type: application/xml"); } else {
//   		header("Content-type: text/xml");
// }
echo $_SERVER['HTTP_ACCEPT'];

function object2array($object) {
    if (is_object($object)) {
        foreach ($object as $key => $value) {
            $array[$key] = $value;
        }
    }
    else {
        $array = $object;
    }
    return $array;
} 
 		
 

function SI_REPORT_PPN($data) {
	$datanya = object2Array($data);
	
	// foreach ($data as $key => $value) {
	// 	if (is_object($data)){
			
	// 	}elseif(is_array($data)){
	// 		foreach ($data as $key => $value) {
	// 			if (is_object($value)){
	// 				$mst	= getmaster($value);
	// 				$hsl 	= mysql_query($mst);	
	// 				$hsl 	= mysql_query('INSERT INTO log_data (tgl_trans,log_dt) VALUES ("'.date('YmdHis').'","Object=>'.$mst.'")');
	// 			}elseif(is_array($value)){
	// 				$jml = sizeof($value);
	// 				for ($i=0;$i<=$jml-1;$i++){
	// 					$mst	= getmaster($value[$i]);
	// 					$hsl 	= mysql_query($mst);	
	// 					$hsl 	= mysql_query('INSERT INTO log_data (tgl_trans,log_dt) VALUES ("'.date('YmdHis').'","Array=>'.$mst.'")');
	// 				}
	// 			}else{
	// 				$hsl 	= mysql_query('INSERT INTO log_data (log_dt) VALUES ("Non->'.$myv.'")');
	// 			}
	// 		}
			
	// 	}else{
	// 		$myv	= print_r($data, TRUE);
	// 		$hsl 	= mysql_query('INSERT INTO log_data (log_dt) VALUES ("NON =>'.$myv.'")');
	// 	}
	// }
	
	return (array(response => "Received in Web : ".$datanya));
}

$server = new SoapServer("SI_REPORT_PPN.wsdl");
$server->addFunction("SI_REPORT_PPN");
$server->handle();

?>

