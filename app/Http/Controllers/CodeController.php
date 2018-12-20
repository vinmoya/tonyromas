<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Filesystem\Filesystem;
use App\Http\Requests\CodeRequest;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use App\Classes\RandomCode;
use App\Classes\DownloadReport;
use App\Code;
use App\User;
use App\ActivateCode;
use App\Restaurant;
use Session;
use File;
use Image;
use Excel;

class CodeController extends Controller
{
    use RandomCode;

    public function __construct()
    {
        $this->middleware('auth');
    }

    private $options = [
        'route' => 'codes',
        'route-views' => 'modules.codes.'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $codes = Code::leftJoin('activate_code', 'codes.id', 'activate_code.code_id')
                    ->leftJoin('redeem_code', 'codes.id', 'redeem_code.code_id')
                    ->orderBy('codes.id', 'DESC')
                    ->get();
        //dd($codes);
        return view($this->options['route-views']."index")
                            ->with('options', $this->options)
                            ->with('array', $codes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->options['route-views']."save")
                            ->with('options', $this->options)
                            ->with('typeForm', 'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CodeRequest $request)
    {
         File::delete(File::glob('codes/last/*.png'));
        ////////////////////////////////////////////////////////////////////////
        $var = 1;
        while ( $var <= $request->quantity) {

            $code                    = new Code;
            $code->code              = $this->Generate();
            $code->value             = $request->input('value');
            if($request->activate_codes == 'SI') { $code->state = "ACTIVO"; }
            $code->creation_date     = date('Y-m-d');
            $code->campaign = $request->input('campaign');
            $code->expiration_date   = $request->input('expire');
            
            if($code->save()) {

                if($request->activate_codes == 'SI') { 

                    $active = new ActivateCode;
                    $active->code_id = $code->id;
                    //$active->user_id = ;
                    $active->activation_date = date('Y-m-d'); 
                    $active->command_activation = "No Necesaria"; 
                    $active->save();
                }

                $url = 'http://www.codigos-qr.com/barcode/barcode.processor.php?encode=CODE128&bdata='.$code->code.'&height=40&scale=2&showData=1&Genrate=';

                $curlCh = curl_init();
                curl_setopt($curlCh, CURLOPT_URL, $url);
                curl_setopt($curlCh, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curlCh, CURLOPT_SSLVERSION,3);
                $curlData = curl_exec ($curlCh);
                curl_close ($curlCh);
                $historical = "codes/historical/$code->code.png";
                $last = "codes/last/$code->code.png";
                $file1 = fopen($historical, "w+");
                $file2 = fopen($last, "w+");
                fputs($file1, $curlData);
                fputs($file2, $curlData);
                fclose($file1);
                fclose($file2);
            }
            $var++;
        }
        /////////////////-------------Download Codes------------////////////////
        $zipper = new \Chumper\Zipper\Zipper;
        $files = glob(public_path('codes/last/*'));
        $zipper->make(base_path('public/barcodes.zip'))->add($files);
        $zipper->close();
        $fileurl = public_path('barcodes.zip');
        if (file_exists($fileurl)) {
            return response()->download($fileurl, 'barcodes.zip', array('Content-Type: application/octet-stream','Content-Length: '. filesize($fileurl)))->deleteFileAfterSend(true);
                
                Session::flash('save', 'Código(s) generado(s)!!');
                return redirect('dashboard/'.$this->options['route']);
        }
        ///////////////////////////////////////////////////////////////////////
    }

    public function downloadCodes()
    {
        $zipper = new \Chumper\Zipper\Zipper;
        $files = glob(public_path('codes/last/*'));
        $zipper->make(base_path('public/barcodes.zip'))->add($files);
        $zipper->close();
        $fileurl = public_path('barcodes.zip');
        if (file_exists($fileurl)) {
            return response()->download($fileurl, 'barcodes.zip', array('Content-Type: application/octet-stream','Content-Length: '. filesize($fileurl)))->deleteFileAfterSend(true);
        }
    }

    public function exportCSV()
    {
        $codes = Code::all();
        Excel::create('Plantilla-anular-codigos', function($excel) {
            $excel->sheet('Datos', function($sheet) {
                //Header
                //$sheet->mergeCells( 'A1:I1');
                //$sheet->row(1, ['Para anular codigos, ingrese el mismo debajo del item "Codigo", en forma de columna, dentro de las comillas.']);
                $sheet->row(1, ['Codigo']);
                $sheet->row(2, ['']);

                //Data
                $data = [];
                /*foreach ($codes as $code) {
                    $row = [];
                    $row[0] = $code->code;
                    //$row[1] = $code->expiration_date;
                    //$row[2] = $code->creation_date;
                    $data[] = $row;
                }*/
                $sheet->fromArray();
            });
        })->export('csv');
    }

    ///////////////////////////////Import CSV//////////////////////////
    public function importCSV(Request $request)
    {
        if(Input::hasFile('codes'))
        {
            $path = Input::file('codes')->getRealPath();
            $data = Excel::load($path, function($reader) {})->get();

            if(!empty($data) && $data->count())
            {
                foreach ($data as $key => $value) {
                    //dd($data);
                    $codes = Code::where('code', $value->codigo)->get();
                    if(isset($codes) == FALSE)
                    {
                        Session::flash('error', 'Verifique que sus códigos sean correctos!!');
                        return redirect('dashboard/'.$this->options['route']);
                    }
                    else
                    {
                        foreach ($codes as $file) 
                        {
                            if ( ($file->state == "ACTIVO") OR ($file->state == "") ) {
                                $canceledCodes[] = $file->code;
                                $response = Code::find($file->id);
                                $response->state = "ANULADO";
                                $response->annulation_date = Carbon::today()->toDateString();
                                $response->save();
                            }
                            else {
                                    $notCancelledCodes[] = $file->code;
                            }
                        }
                    }
                }
            }
            else {
                Session::flash('error', 'El documento no puede ser procesado, ya que esta en blanco!!');
                return redirect('dashboard/'.$this->options['route']);
            }
        }
        if (!empty($notCancelledCodes)) {
            Excel::create('Codigos-no-anulados', function($excel) use ($notCancelledCodes) {
                $excel->sheet('NoAnulados', function($sheet) use ($notCancelledCodes) {
                $sheet->row(1, ['No se han podido anular los siguientes codigos, ya que su estado es distinto a activos o ya han sido procesados.']);
                    $data = [];
                    foreach ($notCancelledCodes as $code) {
                        $row = [];
                        $row[0] = $code;
                        $data[] = $row;
                    }
                    $sheet->fromArray($data);
                });
            })->export('csv');
        }
        else 
        {
            Excel::create('Códigos-anulados', function($excel) {
            $excel->sheet('Codigos-anulados', function($sheet) {
                $sheet->row(1, ['Coodigos anulados sastisfactoriamente!!']);
                $sheet->fromArray();
            });
        })->export('csv');
        }
    }

    ///////////////////Export Coupon/////////////////////
    public function downloadCoupon()
    {
        $array = Code::leftJoin('activate_code', 'codes.id', 'activate_code.code_id')
                     ->leftJoin('redeem_code', 'codes.id', 'redeem_code.code_id')
                     ->leftJoin('users', 'activate_code.user_id', 'users.id')
                     ->leftJoin('restaurants', 'users.restaurant_id', 'restaurants.id')
                    ->get();
        //dd($array);
        Excel::create('Exportar Datos Códigos', function($excel) use ($array) {
            $excel->sheet('Datos', function($sheet) use ($array) {
                // Header
                //$sheet->mergeCells('A1:J1');
                //$sheet->row(1, ['Detalles de cupones generados']);
                $sheet->row(1, ['Codigo', 'Estado', 'Lugar de Emision', 'Lugar Activacion', 'Fecha de Ativacion', 'Comanda de Activacion', 'Fecha de Canjeo', 'Comanda de Canjeo', 'Fecha de Creacion', 'Valor', 'Restaurant Activ.', 'Restaurant Canjeo']);
                //Data
                foreach ($array as $codes) {
                    $row = [];
                    $row[0] = $codes->code;
                    $row[1] = $codes->state;
                    if ((!empty($codes->campaign)) AND ($codes->state == "ACTIVO") ) { $row[2] = $codes->campaign; } else { $row[2] = "Interno"; }
                    if (!empty($codes->campaign)) { $row[3] = $codes->state; } else { $row[3] = "Interno"; }
                    $row[4] = $codes->activation_date;
                    $row[5] = $codes->command_activation;
                    $row[6] = $codes->redemption_date;
                    $row[7] = $codes->exchange_command;
                    $row[8] = $codes->creation_date;
                    $row[9] = $codes->value;
                    $row[10] = $codes->name;
                    $row[11] = $codes->name;
                    $sheet->appendRow($row);
                }
            });
        })->export('xls');

    }
}