<?php

$id_provinsi = $_POST['id_provinsi'];

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=" . $id_provinsi,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "key: dab349f28c445d0813c331e7d0668bc4"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    // echo $response;
    // membuat array response
    $array_response = json_decode($response, true);
    $data_distrik = $array_response["rajaongkir"]["results"];

    // echo "<pre>";
    // print_r($data_distrik);
    // echo "</pre>";
    echo "<option>Pilih Kota/Kabupaten</option>";

    foreach ($data_distrik as $key => $value) {
        echo "<option 
        id_distrik='" . $value["city_id"] . "'
        nama_provinsi='" . $value["province"] . "'
        nama_distrik='" . $value["city_name"] . "'
        type_distrik='" . $value["type"] . "'
        kode_pos='" . $value["postal_code"] . "'
        >";
        echo $value["type"] . " ";
        echo $value["city_name"];
        echo "</option>";
    }
}
