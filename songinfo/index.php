<?php

    $stream = $_GET[ 'stream' ];

    $input_json = file_get_contents( "http://stream.urbanspaceradio.com:8000/info.xsl" );
    $data = json_decode( $input_json, true );
    $splittedTitle = mb_convert_encoding($data[$stream]['title'], "CP1251", "UTF-8");
    $arrayTitle = explode( " - ", $splittedTitle, 2 );
    $output_json = json_encode(array( 'artist' => $arrayTitle[0], 'title' => $arrayTitle[1], 'status' => 'current' ));
    //var_dump(array( 'artist' => $arrayTitle[0], 'title' => $arrayTitle[1] ));
    echo "[" . $output_json . "]";

?>