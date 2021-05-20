<?php
$url = "https://data.bmkg.go.id/DataMKG/MEWS/DigitalForecast/DigitalForecast-JawaTimur.xml";
$data = simplexml_load_file($url) or die("Gagal mengakses!");


$cuaca = [];
$cuaca["0"] = "Cerah";
$cuaca["1"] = "Cerah Berawan";
$cuaca["2"] = "Cerah Berawan";
$cuaca["3"] = "Berawan";
$cuaca["4"] = "Berawan Tebal";
$cuaca["5"] = "Udara Kabur";
$cuaca["10"] = "Asap";
$cuaca["45"] = "Kabut";
$cuaca["60"] = "Hujan Ringan";
$cuaca["61"] = "Hujan Sedang";
$cuaca["63"] = "Hujan Lebat";
$cuaca["80"] = "Hujan Lokal";
$cuaca["95"] = "Hujan Petir";
$cuaca["97"] = "Hujan Petir";

for ($x = 0; $x < count($data->forecast->area)-1; $x++) {
	echo $data->forecast->area[$x]->name[1];
	echo " Provinsi ".$data->forecast->area[$x]->attributes()["domain"]."\n";
	
	for ($y = 0; $y < count($data->forecast->area[$x]->parameter[6]->timerange); $y++) {
		$kodecuaca = (int)$data->forecast->area[$x]->parameter[6]->timerange[$y]->value;
		$kode = (string)$kodecuaca;
		$waktu = date('l, d F Y H:i:s', strtotime($data->forecast->area[$x]->parameter[6]->timerange[$y]->attributes()["datetime"]))." WIB = ";
		echo $waktu.$cuaca[$kode]."\n";
	}
	echo "\n\n";
}

?>
