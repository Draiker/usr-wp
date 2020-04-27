<?php

    $stream = $_GET[ 'stream' ];

    $url= 'https://stream.urbanspaceradio.com:8443/info.xsl';
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    $input_json = curl_exec($ch);
    curl_close($ch);

    $data = json_decode( $input_json, true );
    $splittedTitle = mb_convert_encoding($data[$stream]['title'], "CP1251", "UTF-8");
    $arrayTitle = explode( " - ", $splittedTitle, 2 );
    $output_json = json_encode(array( 'artist' => $arrayTitle[0], 'title' => $arrayTitle[1], 'status' => 'current' ));
    echo "[" . $output_json . "]";

?>
