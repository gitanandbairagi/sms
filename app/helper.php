<?php

// Return url of current page for both http and https
if (!function_exists('actual_link')) {
    function actual_link() {
        return  (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    }
}
// Return unique password encrypted by password_hash() method of php
if (!function_exists('generate_password')) {
    function generate_password($length = 8) {
        $str = 'abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ123456789!@#$%?+';
        $password = "";
        while ($length != 0) {
            $index = rand(0, strlen($str) - 1);
            $password .= $str[$index];
            $length -= 1;
        }
        return $password;
    }
}
// Return time ago from given timestamp
if (!function_exists('time_ago')) {
    function time_ago($time) {
        $difference = time() - $time;

        if ($difference < 1) {
            return "less than 1 second ago";
        }

        $condition = [
            12 * 30 * 24 * 60 * 60 => 'year',
            30 * 24 * 60 * 60 => 'month',
            24 * 60 * 60 => 'day',
            60 * 60 => 'hour',
            60 => 'minute',
            1 => 'second',
        ];

        foreach ($condition as $secs => $str) {
            $d = $difference / $secs;
            if( $d >= 1 )
            {
                $t = round( $d );
                return 'about ' . $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' ago';
            }
        }
    }
}
// Return formatted int and float according to indian currency system
if (!function_exists('money_format_india')) {
    function money_format_india($num){
        $nums = explode(".",$num);
        if(count($nums)>2){
            return "0";
        }else{
        if(count($nums)==1){
            $nums[1]="00";
        }
        $num = $nums[0];
        $explrestunits = "" ;
        if(strlen($num)>3){
            $lastthree = substr($num, strlen($num)-3, strlen($num));
            $restunits = substr($num, 0, strlen($num)-3); 
            $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; 
            $expunit = str_split($restunits, 2);
            for($i=0; $i<sizeof($expunit); $i++){

                if($i==0)
                {
                    $explrestunits .= (int)$expunit[$i].","; 
                }else{
                    $explrestunits .= $expunit[$i].",";
                }
            }
            $thecash = $explrestunits.$lastthree;
        } else {
            $thecash = $num;
        }
        return $thecash.".".$nums[1]; 
        }
    }
}