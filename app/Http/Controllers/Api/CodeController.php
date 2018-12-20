<?php

namespace App\Http\Controllers\Api;
use App\Code;
use App\ActivateCode;
use App\RedeemCode;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class CodeController extends Controller
{
/////////////////////////////////////////Activate codes////////////////////////////////////
    public function activateCode()
    {
        if (!empty(request('command')))
        {
            $codes[] = request('codes');
            foreach ($codes as $key => $value) 
            {
                $searchCode = Code::where('code', $value)->get(); //Consultamos que los codigos existan
                if (isset($searchCode) == FALSE) //Si, no existe, retornamos error
                {
                    return response()->json(['code' => '3', 'message' => 'Código inexistente!!'], 200);
                }
                else //Si existen, evaluamos
                {
                    foreach ($searchCode as $file) //Recorremos la busqueda para ir actualizando
                    {
                        if ($file->state == "") //Verificamos si el código esta vacio
                        {
                            $activateCode = Code::find($file->id);
                            $activateCode->state = "ACTIVO";
                            if ($activateCode->save()) 
                            { //Guardamos el nuevo estado y verificamos
                                $response = new ActivateCode;
                                $response->code_id = $file->id;
                                $response->user_id = request('user');
                                $response->activation_date = Carbon::today()->toDateString();
                                $response->command_activation = request('command');
                                $response->save();
                                $activatedCodes[] = $activateCode->code.': Activado Correctamente!!'."\n";
                            }
                        }
                        else //Si el  estado es distinto de vaio, no se activa el codigo
                        {
                            $codesNotActivated[] = $file->code.': No Activado!!'."\n";
                        }
                    }//Finaliza el recorrido de la variable $searchCode
                }//Cierra el IF que evalua si el codigo existe
            }//Cierra el foreach que evalua los codigos recibidos
            if (!empty($activatedCodes) AND (!empty($codesNotActivated))) //Evaluamos codigos activos y no activos
            {
                $activated = implode("", $activatedCodes);
                $notActivated = implode("", $codesNotActivated);
                $codess = $activated.' '.$notActivated;
                return response()->json(['code' => '3', 'message' => $codess], 200);
            }
            elseif( (!empty($activatedCodes)) AND (empty($codesNotActivated)) ) //Evaluamos si existe codigo no activo
            {
                $codess = implode("", $activatedCodes);
                return response()->json(['code' => '1', 'message' => $codess], 200);
            }
            else //Retornamos olo codigos no activados 
            {
                $codess = implode("", $codesNotActivated);
                return response()->json(['code' => '2', 'message' => $codess], 200);
            }
        }//Cierra el if que evalua command
        else //Devolvemos codigo de comanda no exite; 1
        {
            return response()->json(['code' => '2', 'message' => 'Campo comanda obligatorio'], 200);
        }
    }
//////////////////////////////////////State Code//////////////////////////////////////////////////
    public function stateCode()
    {
        if (!empty(request('codes'))) //Evaluamos si viene alguna variable vacia
        {
            $searchCode = Code::where('code', request('codes'))->get(); //Consultamos que los codigos existan
            if (!empty($searchCode)) //Si, no existe, retornamos error
            {
                foreach ($searchCode as $file) 
                {
                    switch ($file->state) 
                    {
                        case "ACTIVO":
                            $activated = ActivateCode::where('code_id', $file->id)->get();
                                foreach ($activated as $row) {
                                    $codess = (request('codes')).': Activado el dia: '.date('d-m-Y', strtotime($row->activation_date));
                                }
                                return response()->json(['code' => '3', 'message' => $codess], 200);
                            break;

                        case "CANJEADO":
                            $redeemed = RedeemCode::where('code_id', $file->id)->get();
                                foreach ($redeemed as $row) {
                                    $codess = (request('codes')).': Canjeado el dia: '.date('d-m-Y', strtotime($row->activation_date));
                                }
                                return response()->json(['code' => '3', 'message' => $codess], 200);
                            break;

                        case "ANULADO":
                            $codess = (request('codes')).': Anulado el dia '.$file->annulation_date;
                            return response()->json(['code' => '3', 'message' => $codess], 200);
                            break;

                        case "EXPIRO":
                            $codess = (request('codes')).': Expiró el dia '.$file->expiration_date;
                            return response()->json(['code' => '3', 'message' => $codess], 200);
                            break;

                        default:
                            return response()->json(['code' => '3', 'message' => 'El código se encuentra sin procesar.']);
                            break;
                    }
                }
            }
            else
            {
                return response()->json(['code' => '3', 'message' => 'El código consultado no se encuentra registrado.'], 200);
            }
        }
        else////////////////////////Si existe alguna variable vacia, retornamos codigo
        { 
            return response()->json(['code' => '2', 'message' => 'Falta el campo código.'], 200);
        }
    }   
    ///////////////////////Redemption Code///////////////////////////
    public function codeExchange()
    {
        if( (empty(request('codes'))) OR (empty(request('user'))) OR (empty(request('command'))) ) //Validamos que las variables vengan cargadas
        {
            return response()->json(['code' => '3', 'message' => 'Los campos códigos y o comanda, son obligatorios, asegurese de rellenar ambos.'], 200);
        }
        else
        {
            $codesReceived[] = request('codes');// Pasamos a varible interna los codigos cargados
            foreach ($codesReceived as $key => $value) 
            {
                $searchCode = Code::where('code', $value)->get(); //Consultamos que los codigos existan
                if (empty($searchCode)) //Verificamos que los codigos existan dentro de la base datos
                {
                    return response()->json(['code' => '3', 'message' => 'Código inexistente!!'], 200);
                }
                else
                {
                    foreach ($searchCode as $row) //Recorremos la consulta donde consultamos los codigos 
                    {
                        if ($row->state == "ACTIVO") //Verificamos si el codigo está activo
                        {
                            $redeemCode = Code::find($row->id);
                            $redeemCode->state = "CANJEADO";
                            if ($redeemCode->save()) 
                            { //Guardamos el nuevo estado y verificamos
                                $response = new RedeemCode;
                                $response->code_id = $row->id;
                                $response->user_id = request('user');
                                $response->redemption_date = Carbon::today()->toDateString();
                                $response->exchange_command = request('command');
                                $response->save();
                                $redeemCodes[] = $redeemCode->code.': Canjeado Correctamente!!'."\n";
                            }
                        }
                        else
                        {
                            $codeNotRedeemed[] = $row->code.': No canjeado!!'."\n";
                        }
                    }
                }//Cerramos el ciclo donde se verifica si existe el codigo
            }//Cerramos el ciclo donde recorremos los codigos enviados
           if ( (!empty($redeemCodes)) AND (!empty($codeNotRedeemed)) ) 
           {
                $redeemed = implode("", $redeemCodes);
                $notRedeemed = implode("", $codeNotRedeemed);
                $codess = $redeemed.' '.$notRedeemed;
                return response()->json(['code' => '3', 'message' => $codess], 200);
           } 
           elseif( (!empty($redeemCodes)) AND (empty($codeNotRedeemed)) )
           {
                $codess = implode("", $redeemCodes);
                return response()->json(['code' => '1', 'message' => $codess], 200);
           }
           else
           {
                $codess = implode("", $codeNotRedeemed);
                return response()->json(['code' => '2', 'message' => $codess], 200);
           }
        }//Cerramos el ciclo donde evaluamos si falta alguna información en las variables
    }    
}
