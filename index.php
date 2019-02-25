<?php
/**
 * Created by PhpStorm.
 * User: hongyan
 * Date: 2019/1/18
 * Time: 18:05
 */

    $url ='http://www.chinamarketradio.cn/api/Getprofile/index?sn=221.5.0.46';
    $fp= fopen($url,'r');
    $result = "";
    $header= stream_get_meta_data($fp);//获取报头信息
    while(!feof($fp)) {
        $result .= fgets($fp, 1024);
    }
    fclose($fp);


    $proArr = json_decode($result,true);
    $baseArr = $proArr["base"];
    $ipStr = $baseArr[0]["host"][0]["ip"];
    $pathStr = $baseArr[0]["host"][0]["source"][0]["path"];
    $audioArr = $baseArr[0]["host"][0]["source"][0]["audio"];
    $showArr = [];
    $i=0;

    foreach ($audioArr as $k=>$v){
        $timeArr = explode("-",$v["time"]);
        $ve = subSecond($timeArr[0]);
        $startStr = subSecond($timeArr[0]);
        $endStr = subSecond($timeArr[1]);

        foreach ($v["list"] as $ke=>$va){
            $ListNum = count($v["list"]);
            if( $ke < $ListNum){
                if (array_key_exists("start",$va) && array_key_exists("start",$va)){
                    $dura =$va["end"] -$va["start"];
                }else if(array_key_exists("start",$va)){
                    $dura = $va["duration"] - $va["start"];
                }else if( array_key_exists("end",$va)){
                    $dura =$va["end"] - 0;
                }else{
                    $dura = $va["duration"];
                }
                $va["src"] = "http://" .$ipStr.$pathStr.$va['fn'];
                $showArr[$ve][$ke] =[
                    "start"=> $startStr,
                    "end" => $startStr + $dura,
                    "data" => $va
                ];
                $startStr = $startStr + $dura;
                $i++;
            }
        }
    }

    foreach ($showArr as $key=>$value){
        $key1 = gmstrftime('%H:%M:%S', $key);
        foreach ($value as $ke=>$va){
            $showArr1[$key1][$ke]["start"] =gmstrftime('%H:%M:%S', $va["start"]);
            $showArr1[$key1][$ke]["end"] =gmstrftime('%H:%M:%S', $va["end"]);
            $showArr1[$key1][$ke]["data"] =$va["data"];
        }

    }
    echo  json_encode($showArr1);

    function subSecond($time){
        $rearr =explode(":",$time);
        $Second = $rearr[0] * 3600 + $rearr[1] * 60 + $rearr[2];
        return $Second;
    }
