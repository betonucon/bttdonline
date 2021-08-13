<?php
if (file_exists('config.php')) include_once ("config.php");

function intervalCalc($jam1, $jam2)
{
    $t1	= strtotime($jam1);
	$t2	= strtotime($jam2);
	//$now = time();
    $interval_secs = $t2  - $t1;
    
    if ($interval_secs > 86400){ 
        $interval = (($interval_secs - ($interval_secs%86400))/86400);
        
        $interval.= " days ago";
    }
    elseif ($interval_secs > 3600)
    {
        $interval = ($interval_secs - ($interval_secs%3600)/3600);
        
        $interval.= " hours ago";
    }
    elseif ($interval_secs > 60)
    {
        $interval = ($interval_secs - ($interval_secs%60)/60);
        
        $interval.= " minutes ago";
    }
    
    return  $interval;
    
}

function using_ie(){
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $ub = False;
    if(preg_match('/MSIE/i',$u_agent))
    {
        $ub = True;
    }
   
    return $ub;
} 


function bedawaktu($jam1, $jam2){
	//$t1 = strtotime('11/11/2010 10:00');
	//$t2 = strtotime('11/11/2010 14:00');
	$t1	= strtotime($jam1);
	$t2	= strtotime($jam2);

	$delta_T = ($t2 - $t1);

	//$days = round(($delta_T % 604800) / 86400, 2); 
	$hours = number_format((($delta_T % 604800) % 86400) / 3600); 
	$minutes = number_format(((($delta_T % 604800) % 86400) % 3600) / 60); 
	$seconds = number_format((((($delta_T % 604800) % 86400) % 3600) % 60));

	$hours = str_repeat('0',2-strlen($hours)).$hours;
	$minutes = str_repeat('0',2-strlen($minutes)).$minutes;
	//return $hours.' Jam '.$minutes.' Mnt';
	return $hours.':'.$minutes;//.' Jam '.$minutes.' Mnt';
}

function _bln($bul){
	$b=array(
		"01"=>"Januari", "02"=>"Februari", "03"=>"Maret", "04"=>"April", "05"=>"Mei", "06"=>"Juni",
		"07"=>"Juli", "08"=>"Agustus", "09"=>"September", "10"=>"Oktober", "11"=>"November", "12"=>"Desember"
	);
	return $b[$bul];
}

function nama_bulan($bul){
	$b=array(
		"1"=>"Januari", "2"=>"Februari", "3"=>"Maret", "4"=>"April", "5"=>"Mei", "6"=>"Juni",
		"7"=>"Juli", "8"=>"Agustus", "9"=>"September", "10"=>"Oktober", "11"=>"November", "12"=>"Desember"
	);
	return $b[$bul];
}

function tahun($tahun){
	$tahun=date('Y');
}

function unformatCurrency_1($nilai){
	if($nilai==''){
		$value = "";
	}
	else{
		$nil=explode('.', $nilai);
		for($i=0;$i<=count($nil)-1;$i++){
			if ($i!=count($nil)-1) {
				$value .=$nil[$i];
			}else{
				$v=explode(',', $nil[$i]);
				$value .=$v[0].'.'.$v[1];
			}
		}
	}
	return $value;
}

function no_daftar(){
	$abj='ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	for($i=0;$i<=32;$i++){
		if (strlen($no)<4) {
			$no .=$abj[rand(0,strlen($abj))];
		}
	}
	$ang=substr(rand(100,999999),1,3);
	return $no.$ang;
}

function  read_textarea($text,$numb)
{
	$text = str_replace("\r", "", $text);//to process the windows new line
	$arrtext = explode("\n", $text);// create array of keywords
	switch($numb){
		case 'angka':
			foreach($arrtext as $keyword){
				$resl .= ++$i.'.&nbsp;'.$keyword.'<br />';//process the keywords as you like
			}
			break;
		case 'costome':
			foreach($arrtext as $keyword){
				$resl .= $keyword.chr(13);//process the keywords as you like
			}
			break;
		default:
			foreach($arrtext as $keyword){
				$resl .= $keyword.'<br />';//process the keywords as you like
			}
	} // switch

	return
		$resl;
}

function bulan ($tgl)
{
 if (empty($tgl))
        return null;

    $tg = explode("-", $tgl);
    return
    date("d-F-Y", mktime(0, 0, 0, $tg[1], $tg[2], $tg[0]));
}

function pilih($data, $value){

		if ($data == $value)
			return 'checked';
		return;

	}

function _selected($x, $y){
		return ($x==$y)?'selected':'';
}

function _convertmysql($tgl){
		$tg=explode('.',$tgl);
		return $tg[2].'-'.$tg[1].'-'.$tg[0];
}

function _checked($x, $y){
		return ($x==$y)?'checked':'';
	}

function _convertTgl($tgl){
		$tg=explode('-',$tgl);
		return $tg[2].'-'.$tg[1].'-'.$tg[0];
}

function backtgl($tgl){
		$tg=explode('-',$tgl);
		return $tg[0].'-'.$tg[1].'-'.$tg[2];
}

function _convertTglSAP($tgl){
		$tg=explode('-',$tgl);
		return $tg[2].''.$tg[1].''.$tg[0];
}

function reservstat($st){
	switch ($st){
		case '0' : return 'Open';
		case '1' : return 'Released';
		case '2' : return 'Canceled';
		case '3' : return 'Failed';
		case '4' : return 'Wait For PK';
	}
}

function _convertDate($date)
{
    if (empty($date))
        return null;

    $date = explode("-", $date);
    return
    $date[2] . '-' . $date[1] . '-' . $date[0];
}


function arrayCombine($a = array(), $b = array())
{
    foreach($a as $key => $value) {
        $c[$value] = $b[$key];
    }
    return $c;
}

function connect()
{
    
    mysqli_connect(hostname, username, password, dbname);
} //function connect

function _auth($nama, $satu, $dua)
{
    if (($_SESSION["level"] == $satu) OR ($_SESSION["level"] == $dua)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function _authree($nama, $satu, $dua, $tiga)
{
    if (($_SESSION["level"] == $satu) OR ($_SESSION["level"] == $dua) OR ($_SESSION["level"] == $tiga)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function _auth4($nama, $satu, $dua, $tiga, $empat)
{
    if (($_SESSION["level"] == $satu) OR ($_SESSION["level"] == $dua) OR ($_SESSION["level"] == $tiga) OR ($_SESSION["level"] == $empat)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

/**
 *
 * @access public
 * @return void
 */
function alerte()
{
    ob_start('ob_tidyhandler');
    echo '<script language="JavaScript">
									window.location=\'' . $_ENV['HTTP_REFERER'] . '\'
									window.alert(\'Anda tidak berhak melakukan operasi ini !\');
								</script>';
    ob_end_flush();
}

function showHead()
{
    return '
<link href="themes/' . theme . '/styles/style.css" rel="stylesheet" type="text/css">
<script src="includes/js/TreeView/ua.js" type="text/javascript"></script>
<script src="includes/js/TreeView/ftiens4.js" type="text/javascript"></script>
<script src="includes/js/TreeView/links.js" type="text/javascript"></script>

';
}

function createPageNavigations($file = '', $total = 0, $psDeh = 10 , $anchor = '', $perPage = 12)
{
    $tmp = '<table align="center" cellpadding="0" cellspacing="0" border="0">
			<tr><td>';
    $perPage == 0 ? $rowPage = rowsPerPage : $rowPage = $perPage;
    $pages = '';
    $m = 0;
    strpos($file, '?') ? $file = explode('?', $file) : $file[0] = $file;

    $_REQUEST['x'] ? $pageNow = $_REQUEST['x'] : $pageNow = 1;
    $_REQUEST['sp'] ? $ps = $_REQUEST['sp'] : $ps = 1;
    $anchor == '' ? $anchor = '' : $anchor = '#' . $anchor;

    if ($ps == 1) {
        $prev = '';
        $end = '<a href="' . $file[0] . '?sp=' . ($ps + 1) . '&x=11' . $anchor . '">' . _NEXT . ' </a>';
    } else {
        $prev = '<span style="border: 1px solid #000000;">&nbsp;<a href="' . $file[0] . '?sp=1&x=1&' . $file[1] . $anchor . '">1&nbsp;</span> ... </a>&nbsp;
				<span style="border: 1px solid #000000;">&nbsp;<a href="' . $file[0] . '?sp=' . ($ps-1) . '&x=' . (($ps-1) * $psDeh - $psDeh) . '&' . $file[1] . $anchor . '">' . _PREV . '</a>';
    }

    if ($ps < ceil($total / $rowPage / $psDeh)) {
        $end = '<a href="' . $file[0] . '?sp=' . ($ps + 1) . '&x=' . ($ps * $psDeh) . '&' . $file[1] . $anchor . '">' . _NEXT . '</a>...
				 <span style="border: 1px solid #000000;">&nbsp;<a href="' . $file[0] . '?sp=' . (ceil($total / $rowPage / $psDeh)) . '&x=' . (ceil($total / $rowPage)) . '&' . $file[1] . $anchor . '">' . ceil($total / $rowPage) . '</a>&nbsp;</span>';
    } else {
        $end = '';
    }

    for($i = ($ps-1) * 10 ; $i <= (($ps-1) * 10) + 10 && $i <= ceil($total / $rowPage); $i++) {
        if ($i <> 0) {
            if ($i == $pageNow) {
                $pages .= '<span style="border: 1px solid #000000;background-color: #FF0000; font-weight: bold;color: #FFFFFF;">&nbsp;' . $i . '&nbsp;</span> &bull; ';
            } else {
                $pages .= '<span style="border: 1px solid #000000;">&nbsp;<a href="' . $file[0] . '?x=' . $i . '&sp=' . $ps . '&' . $file[1] . $anchor . '">' . $i . '</a>&nbsp;</span> &bull; ';
            }
        }
    } // for
    // initialization gitu loh
    $tmp .= $prev . $pages . $end;
    $tmp .= '</td></tr></table>';
    return $tmp;
}


function rowClass($i = 0)
{
    $i % 2 == 1 ? $clash = "#cccccc" : $clash = "#666666";

    return $clash;
}

function rowClassx($i = 0)
{
    $i % 2 == 1 ? $clash = "#cccccc" : $clash = "#BBBEEE";

    return $clash;
}



function generateTable($head = array(), $content)
{
    $_temp = '<table border="0" style="border: solid 1px #DEDEDE" cellspacing="1" cellpadding="3" width="100%" bgcolor="#0066FF">';
    // head section
    $_temp .= '<tr>';
    foreach($head as $key => $value) {
        if (is_array($value)) {
            $_temp .= '<th width="' . $value['width'] . '" align="' . $value['align'] . '">' . $value['value'] . '</th>';
        } else {
            $_temp .= '<th>' . $value . '</th>';
        }
    }
    $_temp .= '</tr>';
    // Tbody section
    if (is_array($content)) {
        foreach($content as $key => $value) {
            if ($value['special'] == 1) {
                $bg = 'style="background-color: #95CAFF"';
            } elseif (++$i % 2) {
                $bg = 'style="background-color: #EEEEEE"';
            } else {
                $bg = 'style="background-color: #DEDEDE"';
            }
            $_temp .= '<tr ' . $bg . '>';
            foreach($head as $field => $fetched) {
                if (is_array($fetched)) {
                    $add = 'align=' . $fetched['align'];
                } else {
                    $add = '';
                }

                $_temp .= '<td ' . $add . '>' . $value['field'][$field] . '</td>';
            }
            $_temp .= '</tr>';
        }
    } else {
        $_temp .= '<tr><td colspan="' . count($head) . '" style="background-color:#EE9999" align="center">' . _NO_DATA . '</td></tr>';
    }
    $_temp .= '</table>';

    return $_temp;
}

function createTab($data)
{
    $temp .= '<div class="tab-page" id="content-pane">
							<script type="text/javascript">
							   var tabPane1 = new WebFXTabPane( document.getElementById( "content-pane" ), 1 )
							</script>';
    $i = 1;
    foreach($data as $head => $content) {
        $temp .= '<div class="tab-page" id="page' . $i . '">
									<h2 class="tab">' . $head . '</h2>
									<script type="text/javascript">
									  tabPane1.addTabPage( document.getElementById( "page' . $i . '" ) );
								 	</script>
									' . $content . '
									</div>';
        $i++;
    }

    $temp .= '</div>';
    return $temp;
}

function initCalendar(){
        	$teks = <<<HEREDOC
    			<style type="text/css">@import url("javascript/jscalendar/calendar.css");</style>
    			<script src="javascript/jscalendar/calendar.js" type="text/javascript"></script>
    			<script src="javascript/jscalendar/lang/calendar-id.js" type="text/javascript"></script>
    			<script src="javascript/jscalendar/calendar-setup.js" type="text/javascript"></script>
HEREDOC;
       return $teks;
    }

function calendarBox($id = 'tanggal', $button = 'trigger', $default = '', $str = '<img border="0" src="image/b_calendar.png" width="10" height="10">', $act=''){
          $teks = '';
	      $teks .= "\t<input type=\"text\" id=\"$id\" name=\"$id\" \"$act\" value=\"$default\" size=\"14\"  />\n";
	      $teks .= "\t<button id=\"$button\">$str</button>\n";
	      $teks .= "\t<script type=\"text/javascript\">\n";
	      $teks .= "\t\tCalendar.setup({inputField: \"$id\", ifFormat: \"%d-%m-%Y\", button: \"$button\"});\n";
	      $teks .= "\t</script>\n";
	      return $teks;
}
function is_valid_email_address($email_address)
{
  if (ereg("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,6})$",$email_address) )
  {
    return TRUE;
  }
  else
  {
    return FALSE;
  }
}

function checkEmail($email){
  return preg_match('/^\S+@[\w\d.-]{2,}\.[\w]{2,6}$/iU', $email) ? TRUE : FALSE;
}

?>