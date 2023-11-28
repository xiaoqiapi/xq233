<?php
$msg = $_GET['msg'];//需要搜图的内容
if($msg==""||$msg==null){echo "抱歉，msg参数不存在！".$hh."此为必填项。";exit();}
$type = $_GET['type'];//需要搜图的官网(目前有百度、搜狗、360)(默认搜狗)
if($type=="baidu"||$type=="bd"||$type=="百度"){
$Api='https://image.baidu.com/search/acjson?tn=resultjson_com&logid='.mt_rand().time().'&ipn=rj&ct=201326592&is=&fp=result&queryWord='.urlencode($msg).'&cl=2&lm=-1&ie=utf-8&oe=utf-8&adpicid=&st=&z=&ic=&hd=&latest=&copyright=&word='.urlencode($msg).'&s=&se=&tab=&width=&height=&face=&istype=&qc=&nc=1&fr=&expermode=&force=&pn='.mt_rand(0,30).'&rn=10&gsm=5a&'.time().'=';
$data=curl($Api);
$data=json_decode($data,true);
$queryExt=$data['queryExt'];
$sj=mt_rand(0,count($data['data']));
$picUrl=$data['data'][$sj]['thumbURL'];
echo $picUrl;
}
if($type=="360"){
$url = 'http://image.so.com/i?q='.$_GET['msg'];
$content = file_get_contents($url);
preg_match_all('/"thumb":"[^,]*,/', $content, $result);
$rep = array('"thumb":"','",','\\');
$str = rand(0,count($result[0])-1);
$str = str_replace($rep, '', $result[0][$str]);
echo $str;
}else{
$msg = $_GET['msg'];//需要搜图的内容
$Api='https://pic.sogou.com/napi/pc/searchList?mode=1&start='.mt_rand(0,50).'&xml_len=48&query='.urlencode($msg);
$data=curl($Api);
$data=json_decode($data,true);
$data=$data['data']['items'];
$sj=mt_rand(0,count($data));
$title=$data[$sj]['title'];
$picUrl=$data[$sj]['picUrl'];
echo $picUrl;
}
?>
