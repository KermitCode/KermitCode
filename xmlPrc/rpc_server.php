<?php
/**
* 函数：提供给RPC客户端调用的函数
* 参数：
* $method 客户端需要调用的函数
* $params 客户端需要调用的函数的参数数组
* 返回：返回指定调用结果
*/

date_default_timezone_set('PRC');
function rpc_server_func($method, $params) {

	$parameter = $params[0];
	if ($parameter == "get"){
	$return = "This data by get method";
	}else{
	$return = "Not specify method or params";
	}
	return $return;
	
}

//产生一个XML-RPC的服务器端
$xmlrpc_server=xmlrpc_server_create();

//注册一个服务器端调用的方法rpc_server，实际指向的是rpc_server_func函数
xmlrpc_server_register_method($xmlrpc_server,"rpc_server","rpc_server_func");

//接受客户端POST过来的XML数据
$request=file_get_contents('php://input');

$fp=fopen('a.txt','wb');
fwrite($fp,var_export($request,true));
fclose($fp);

//$request = $HTTP_RAW_POST_DATA;

// 执行调用客户端的XML请求后获取执行结果
$xmlrpc_response = xmlrpc_server_call_method($xmlrpc_server, $request, null);

//把函数处理后的结果XML进行输出
header("Content-Type: text/xml");
echo $xmlrpc_response;

//销毁XML-RPC服务器端资源
xmlrpc_server_destroy($xmlrpc_server);

?>