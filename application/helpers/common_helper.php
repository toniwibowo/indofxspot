<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
    function sensorKata($kata)
    {
        $kataArray = str_split($kata);
        $kataJumlah = count($kataArray);

        $kataSensor = [];

        for ($i=0; $i < $kataJumlah ; $i++) {
            $kataSensor[$i] = $kataArray[$i]; 
            if ($i > 0 && $i <= ($kataJumlah - 4) ) {
                $kataSensor[$i] = '*';
            }
        }

        return implode('', $kataSensor);
    }
?>