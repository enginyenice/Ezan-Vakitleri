<?php

function  ulkeCek()
{
    $handle = curl_init();

    $url = "https://ezanvakti.herokuapp.com/ulkeler";

    // Set the url
    curl_setopt($handle, CURLOPT_URL, $url);
    // Set the result output to be a string.
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);

    $output = curl_exec($handle);

    curl_close($handle);
    return json_decode($output);
}

if (!empty($_GET)) {
    $statu = $_GET['statu'];
    $code  = $_GET['code'];
    if ($statu == "ulke") {
        $handle = curl_init();

        $url = "http://ezanvakti.herokuapp.com/sehirler?ulke={$code}";

        // Set the url
        curl_setopt($handle, CURLOPT_URL, $url);
        // Set the result output to be a string.
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);

        $output = curl_exec($handle);

        curl_close($handle);
        if ($output == "Too many requests, please try again later.") {
            $output = "Lütfen Bekleyiniz..!";
        }
        echo $output;
    }
    if ($statu == "sehir") {
        $handle = curl_init();

        $url = "https://ezanvakti.herokuapp.com/ilceler?sehir={$code}";

        // Set the url
        curl_setopt($handle, CURLOPT_URL, $url);
        // Set the result output to be a string.
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);

        $output = curl_exec($handle);

        curl_close($handle);
        if ($output == "Too many requests, please try again later.") {
            $output = "Lütfen Bekleyiniz..!";
        }
        echo $output;
    }
    if ($statu == "ilce") {
        $handle = curl_init();
        
        $url = "https://ezanvakti.herokuapp.com/vakitler?ilce={$code}";

        // Set the url
        curl_setopt($handle, CURLOPT_URL, $url);
        // Set the result output to be a string.
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);

        $output = curl_exec($handle);

        curl_close($handle);
        if ($output == "Too many requests, please try again later.") {
            $output = "Lütfen Bekleyiniz..!";
        }
        echo $output;
    }
}
