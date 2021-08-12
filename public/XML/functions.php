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

function connect()
{
    $konesksi = @mysqli_connect(hostname, username, password) or die ("Can't connect to database" . mysqli_error());
    mysqli_select_db($konesksi,dbname);
}

?>