<?php
namespace App\Classes;
use Excel;

trait DownloadReport
{
	public function Report($name, $data)
	{
		return Excel::create($name, function($excel) {
            $excel->sheet('mySheet', function($sheet) use ($data)
                {
                    $sheet->fromArray($data);
                });
            })->download('csv');
	}
}
