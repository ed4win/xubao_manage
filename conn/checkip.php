<?php

/**
 * �����ʵ�ip�Ƿ�Ϊ�涨�������ip
 * Enter description here ...
 */
function check_ip(){
	$ALLOWED_IP=array('192.168.2.*','127.0.0.1','192.168.2.49');
	$IP=getIP();
	$check_ip_arr= explode('.',$IP);//Ҫ����ip��ֳ�����
	#����IP
	if(!in_array($IP,$ALLOWED_IP)) {
		foreach ($ALLOWED_IP as $val){
		    if(strpos($val,'*')!==false){//������*�������
		    	 $arr=array();//
		    	 $arr=explode('.', $val);
		    	 $bl=true;//���ڼ�¼ѭ��������Ƿ���ƥ��ɹ���
		    	 for($i=0;$i<4;$i++){
		    	 	if($arr[$i]!='*'){//������*  ��Ҫ������⣬���Ϊ*����������Ͳ����
		    	 		if($arr[$i]!=$check_ip_arr[$i]){
		    	 			$bl=false;
		    	 			break;//��ֹ��鱾��ip ���������һ��ip
		    	 		}
		    	 	}
		    	 }//end for 
		    	 if($bl){//�����true���ҵ���һ��ƥ��ɹ��ľͷ���
		    	 	echo $IP;
		    	 	return;
		    	 	die;
		    	 }
		    }
		}//end foreach
		header('HTTP/1.1 403 Forbidden');
		echo "Access forbidden";
		die;
	}
}


/**
* ��÷��ʵ�IP
 * Enter description here ...
*/
function getIP() {
	return isset($_SERVER["HTTP_X_FORWARDED_FOR"])?$_SERVER["HTTP_X_FORWARDED_FOR"]
	:(isset($_SERVER["HTTP_CLIENT_IP"])?$_SERVER["HTTP_CLIENT_IP"]
	:$_SERVER["REMOTE_ADDR"]);
}

//$IP = getip();
//echo $IP;

?>