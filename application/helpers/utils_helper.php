<?php
date_default_timezone_set('Asia/Jakarta');

/**
 * Returns an encrypted & utf8-encoded
 */
function encrypt($pure_string, $encryption_key) {
    $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, $encryption_key, utf8_encode($pure_string), MCRYPT_MODE_ECB, $iv);
    return $encrypted_string;
}

/**
 * Returns decrypted original string
 */
function decrypt($encrypted_string, $encryption_key) {
    $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, $encryption_key, $encrypted_string, MCRYPT_MODE_ECB, $iv);
    return $decrypted_string;
}
function seo_friendly_url($string){

    $string = str_replace(',', '', $string);
    $string = str_replace(array('[\', \']'), '', $string);
    $string = preg_replace('/\[.*\]/U', '', $string);
    $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
    $string = htmlentities($string, ENT_COMPAT, 'utf-8');
    $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );
    $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $string);
    return strtolower(trim($string, '-'));
}
function convert_bulan($tgl)
{
  $tgl = str_replace("January","JAN",$tgl);
  $tgl = str_replace("February","FEB",$tgl);
  $tgl = str_replace("March","MAR",$tgl);
  $tgl = str_replace("April","APR",$tgl);
  $tgl = str_replace("May","MEI",$tgl);
  $tgl = str_replace("June","JUN",$tgl);
  $tgl = str_replace("July","JUL",$tgl);
  $tgl = str_replace("August","AGS",$tgl);
  $tgl = str_replace("September","SEP",$tgl);
  $tgl = str_replace("September","OKT",$tgl);
  $tgl = str_replace("November","NOV",$tgl);
  $tgl = str_replace("December","DES",$tgl);
  return $tgl;
}
function converttgl($tgl)
{
  $tgl = str_replace("Sunday","Minggu",$tgl);
  $tgl = str_replace("Monday","Senin",$tgl);
  $tgl = str_replace("Tuesday","Selasa",$tgl);
  $tgl = str_replace("Wednesday","Rabu",$tgl);
  $tgl = str_replace("Thursday","Kamis",$tgl);
  $tgl = str_replace("Friday","Jum'at",$tgl);
  $tgl = str_replace("Saturday","Sabtu",$tgl);

  $tgl = str_replace("January","Januari",$tgl);
  $tgl = str_replace("February","Februari",$tgl);
  $tgl = str_replace("March","Maret",$tgl);
  $tgl = str_replace("April","April",$tgl);
  $tgl = str_replace("May","Mei",$tgl);
  $tgl = str_replace("June","Juni",$tgl);
  $tgl = str_replace("July","Juli",$tgl);
  $tgl = str_replace("August","Agustus",$tgl);
  $tgl = str_replace("September","September",$tgl);
  $tgl = str_replace("October","Oktober",$tgl);
  $tgl = str_replace("November","November",$tgl);
  $tgl = str_replace("December","Desember",$tgl);
  return $tgl;
}
function backbulan($tgl)
{
  $tgl = str_replace("Januari","January",$tgl);
  $tgl = str_replace("Februari","February",$tgl);
  $tgl = str_replace("Maret","March",$tgl);
  $tgl = str_replace("April","April",$tgl);
  $tgl = str_replace("Mei","May",$tgl);
  $tgl = str_replace("Juni","June",$tgl);
  $tgl = str_replace("Juli","July",$tgl);
  $tgl = str_replace("Agustus","August",$tgl);
  $tgl = str_replace("September","September",$tgl);
  $tgl = str_replace("Oktober","October",$tgl);
  $tgl = str_replace("November","November",$tgl);
  $tgl = str_replace("Desember","December",$tgl);
  return $tgl;
}
function buatkode($nomor_terakhir, $kunci, $jumlah_karakter = 0)
{
    /* mencari nomor baru dengan memecah nomor terakhir dan menambahkan 1
    string nomor baru dibawah ini harus dengan format XXX000000
    untuk penggunaan dalam format lain anda harus menyesuaikan sendiri */
    $nomor_baru = intval(substr($nomor_terakhir, strlen($kunci))) + 1;
//    menambahkan nol didepan nomor baru sesuai panjang jumlah karakter
    $nomor_baru_plus_nol = str_pad($nomor_baru, $jumlah_karakter, "0", STR_PAD_LEFT);
//    menyusun kunci dan nomor baru
    $kode = $kunci . $nomor_baru_plus_nol;
    return $kode;
}

 ?>
