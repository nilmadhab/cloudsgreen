<?php
function db_connect(){
	#Add your localhost database parameters in this function
	$result=mysql_connect('localhost', 'root', '25011994')or die("cannot connect");
	if (!$result) {
		return false;
	}
	if (!mysql_select_db('cloudsgreen',$result)){
		return false;
	}
	return $result;
}
function mysql_verify_query($query) {
    $conn = db_connect();
	$args  = func_get_args();
	$query = array_shift($args);
	$query = str_replace("?", "%s", $query);
	$args  = array_map('mysql_real_escape_string', $args);
	array_unshift($args,$query);
	$query = call_user_func_array('sprintf',$args);
	$result = mysql_query($query) ;
	 $ret['result']=$result;
	  if($result){
	    $ret['status']=true;
	    return $ret;
	  }else{
	  	$ret['query']=$query;
	  	$ret['error']=mysql_error();
	  	$ret['errno']=mysql_errno();
	  	$ret['status']=false;
	  	return $ret;
	  }
}
?>