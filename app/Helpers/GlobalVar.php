<?php
namespace App\Helpers;
class GlobalVar
{
    public static $SAVE_SUCCESS_MESSAGE     = 'Data berhasil disimpan !';
    public static $SAVE_FAILED_MESSAGE      = 'Data gagal disimpan !';
    public static $UPDATE_SUCCESS_MESSAGE   = 'Data berhasil diedit !';
    public static $UPDATE_FAILED_MESSAGE    = 'Data gagal diedit !';
    public static $DELETE_SUCCESS_MESSAGE   = 'Data berhasil dihapus !';
    public static $DELETE_FAILED_MESSAGE    = 'Data gagal dihapus !';
    public static $VALIDATE_FAILED          = [
        'success'    => false,
        'message'    => 'Validasi gagal. Cek kembali form anda !'
    ];
    public static $EMAIL_EXIST = [
        'success'   => false,
        'message'   => 'Email sudah terdaftar, Mohon gunakan email yang lain !'
    ];
    public static $EMAIL_NOT_EXIST = [
        'success'   => false,
        'message'   => 'Email belum terdaftar, Mohon mendaftarkan akun lebih dulu!'
    ];
    public static $VALIDATE_USER          = [
        'success'    => false,
        'message'    => 'Validasi user gagal. Cek kembali form anda !'
    ];
    public static $VALIDATE_IMAGE_FAILED  = [
        'success'    => false,
        'message'    => 'Validasi image gagal. Cek kembali extension dan ukuran file anda !'
    ];
    public static $WRONG_DATE_FORMAT =[
        'success'   => false,
        'message'   => 'Format tanggal salah !'
    ];
    public static $DATA_NOT_FOUND          = [
        'success'   => false,
        'message'   => 'Data tidak ada !'
    ];
    public static $SAVE_SUCCESS     = [
        'success'   => true,
        'message'   => 'Data berhasil disimpan !'
    ];
    public static $SAVE_FAILED      = [
        'success'   => true,
        'message'   => 'Data  disimpan !'
    ];
    public static $EDIT_SUCCESS     = [
        'success'   => true,
        'message'   => 'Data berhasil diedit !'
    ];
    public static $DELETE_SUCCESS     = [
        'success'   => true,
        'message'   => 'Data berhasil dihapus !'
    ];
    public static $FAILED_SAVE_FILE     = [
        'success'   => false    ,
        'message'   => 'File gagal disimpan atau file tidak ada !'
    ];
}