# Prakiraan Cuaca Jawa Timur BMKG PHP-CLI
Sumber data dari https://data.bmkg.go.id/prakiraan-cuaca/

### Parameter (key)
** Waktu dalam UTC-YYYYMMDDHHmmss (key id: timerange)
** Cuaca berupa kode cuaca (key id: weather)
** Suhu Udara dalam °C dan °F (key id: t)
** Suhu Udara Minimum dalam °C dan °F (key id: tmin)
** Suhu Udara Maksimum dalam °C dan °F (key id: tmax)
** Kelembapan Udara dalam % (key id: hu)
** Kelembapan Udara Minimum dalam % (key id: humin)
** Kelembapan Udara Maksimum dalam % (key id: humax)
** Kecepatan Angin dalam knot, mph, kph, dan ms (key id: ws)
** Arah Angin dalam derajat, CARD, dan SEXA (key id: wd)

### Kode Cuaca
** 0 : Cerah / Clear Skies
** 1 : Cerah Berawan / Partly Cloudy
** 2 : Cerah Berawan / Partly Cloudy
** 3 : Berawan / Mostly Cloudy
** 4 : Berawan Tebal / Overcast
** 5 : Udara Kabur / Haze
** 10 : Asap / Smoke
** 45 : Kabut / Fog
** 60 : Hujan Ringan / Light Rain
** 61 : Hujan Sedang / Rain
** 63 : Hujan Lebat / Heavy Rain
** 80 : Hujan Lokal / Isolated Shower
** 95 : Hujan Petir / Severe Thunderstorm
** 97 : Hujan Petir / Severe Thunderstorm

### Kode Arah Angin (CARD) (dibaca: dari arah ...)
** N (North)
** NNE (North-Northeast)
** NE (Northeast)
** ENE (East-Northeast)
** E (East)
** ESE (East-Southeast)
** SE (Southeast)
** SSE (South-Southeast)
** S (South)
** SSW (South-Southwest)
** SW (Southwest)
** WSW (West-Southwest)
** W (West)
** WNW (West-Northwest)
** NW (Northwest)
** NNW (North-Northwest)
** VARIABLE (berubah-ubah)

Perlu pengembangan lebih lanjut
```php
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
```
