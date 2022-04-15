<?php

namespace Uwaiscode\Laravelterbilang;

use Exception;

class Converter
{
    public static function getConversion($nominal)
    {
        if (strpos($nominal, '.') > 0) {
            $nilai = static::konversi(strstr($nominal, '.', true));
            $koma = static::tkoma(strstr($nominal, '.'));
        } else {
            $nilai = static::konversi($nominal);
            $koma = "";
        }
        return $nilai . " " . $koma;
    }

    public static function konversi($number)
    {
        $number = str_replace('.', '', $number);
        if (!is_numeric($number))
            throw new Exception("Nilai haruslah berupa angka");
        $base = array('Nol', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan');
        $numeric = array('1000000000000000', '1000000000000', '1000000000000', 1000000000, 1000000, 1000, 100, 10, 1);
        $unit = array('Kuadriliun', 'Triliun', 'Biliun', 'Milyar', 'Juta', 'Ribu', 'Ratus', 'Puluh', '');
        $str = null;
        $i = 0;
        if ($number == 0) {
            $str = 'nol';
        } else {
            while ($number != 0) {
                $count = (int) ($number / $numeric[$i]);
                if ($count >= 10) {
                    $str .= static::konversi($count) . ' ' . $unit[$i] . ' ';
                } elseif ($count > 0 && $count < 10) {
                    $str .= $base[$count] . ' ' . $unit[$i] . ' ';
                }
                $number -= $numeric[$i] * $count;
                $i++;
            }
            $str = preg_replace('/Satu Puluh (\w+)/i', '\1 Belas', $str);
            $str = preg_replace('/Satu Ribu/', 'Seribu\1', $str);
            $str = preg_replace('/Satu Ratus/', 'Seratus\1', $str);
            $str = preg_replace('/Satu Puluh/', 'Sepuluh\1', $str);
            $str = preg_replace('/Satu Belas/', 'Sebelas\1', $str);
            $str = preg_replace('/\s{2,}/', ' ', trim($str));
        }
        return $str;
    }

    public static function tkoma($nominal)
    {
        $base = array('Nol', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan');

        $temp = "Koma";
        $pjg = strlen($nominal);
        $pos = 1;
        while ($pos < $pjg) {
            $x = substr($nominal, $pos, 1);
            $pos++;
            $temp .= " " . $base[$x];
        }
        return $temp;
    }
}