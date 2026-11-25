<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home');


Route::view('/pemetaan-usaha', 'tim.pemetaan-usaha');
Route::view('/kewirausahaan', 'tim.kewirausahaan');
Route::view('/kurasi-usaha', 'tim.kurasi-usaha');
Route::view('/kelembagaan-kemitraan-usaha', 'tim.kelembagaan-kemitraan-usaha');
Route::view('/literasi-keuangan', 'tim.literasi-keuangan');
Route::view('/perizinan-investasi', 'tim.perizinan-investasi');
Route::view('/tata-usaha', 'tim.tata-usaha');


