<?php
    $time_start = time();

    $stream = $_GET[ 'stream' ];

    $url= 'https://stream.urbanspaceradio.com:8443/info.xsl';
    $arrContextOptions=array(
        "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
        ),
    );

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $input_json = curl_exec($ch);
    curl_close($ch);

    //$input_json = file_get_contents($url, false, stream_context_create($arrContextOptions));
    //$input_json = file_get_contents( "https://stream.urbanspaceradio.com:8443/info.xsl" );
    //echo $input_json;
    $data = json_decode( $input_json, true );
    $splittedTitle = mb_convert_encoding($data[$stream]['title'], "CP1251", "UTF-8");
    $arrayTitle = explode( " - ", $splittedTitle, 2 );
    $output_json = json_encode(array( 'artist' => $arrayTitle[0], 'title' => $arrayTitle[1], 'status' => 'current' ));
    //var_dump(array( 'artist' => $arrayTitle[0], 'title' => $arrayTitle[1] ));
    echo "[" . $output_json . "]";

    $time_end = time();
    echo $time_end - $time_start;
?>
