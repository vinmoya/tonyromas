<?php
namespace App\Classes;

trait RandomCode
{
	public function Generate()
	{
		$string = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $length=4; 
        $chain1 = ""; 
        $chain2 = ""; 
        for($i=0;$i<$length;$i++)
        {
            /*Extraemos 1 caracter de los caracteres entre el rango 0 a Numero de letras que tiene la cadena */
            $chain1 .= substr($string,rand(0,strlen($string)),1); 
            $chain2 .= substr($string,rand(0,strlen($string)),1); 
        }
		return $chain1.'-'.$chain2;
	}
}
