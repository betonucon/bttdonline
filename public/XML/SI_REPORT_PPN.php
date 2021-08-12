<?php
include_once('config.php');
include_once('functions.php');

	if ( stristr(@$_SERVER["HTTP_ACCEPT"],"application/xml")) {
		header("Content-type: application/xml, utf-8"); } else {
		header("Content-type: text/xml");
	}

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
 		
	function subCode($string, $param){
		switch($param){
			case 1: $kd = substr($string, 0, 2);break;
			case 2: $kd = substr($string, 2, 1).".";break;
			case 3: $kd = substr($string, 3, 3)."-";break;
			case 4: $kd = substr($string, 6, 2).".";break;
			case 5: $kd = substr($string, 8, 8);break;
		}
	  return $kd;
	}

	function getCode($kode){
		for($i=1;$i<=strlen($kode);$i++){
			$cd .= subCode($kode, $i);
		}		
	 	return $cd;
	}	 

    function getmaster($isi){
    	foreach ($isi as $key1 => $value1) { 
     		$field .= $key1.","; 
            if ($key1=='LIFNR'){
               $val .="'".substr($value1,4)."'".","; 
            }else{
                $val .=  "'".$value1."'".",";
            } 
        }
        $date1 = date('Ymd');	
    	$date1 = ('2012-12-12');
    	$date = new DateTime($date1);
    	$date->add(new DateInterval('P6D'));
    	$date2 = $date->format('Ymd');
    	
    	$field 	= substr($field,0,strlen($field)-1);
    	$val 	= substr($val,0,strlen($val)-1);
     
    	$sql_m 	= "INSERT INTO bttd_ppn ($field) VALUES ($val);"; 
    	return $sql_m;
    }  

	function SI_REPORT_PPN($data) {
		$data = object2Array($data);
		
		foreach ($data as $key => $value) {
			if (is_object($data)){
				
			}elseif(is_array($data)){
				foreach ($data as $key => $value) {
					
						$mst	= getmaster($value);
						$hsl 	= mysqli_query($koneksi,$mst);	
						
					
				}
				
			}else{
				$myv	= print_r($data, TRUE);
				// $hsl 	= mysql_query('INSERT INTO log_data (log_dt) VALUES ("NON =>'.$myv.'")');
			}
		}
		return (array(response => "Received in Web : $v".$vmard));
	}

	$server = new SoapServer("SI_REPORT_PPN.wsdl");
	echo $server->addFunction("SI_REPORT_PPN");
	$server->handle();

?>

