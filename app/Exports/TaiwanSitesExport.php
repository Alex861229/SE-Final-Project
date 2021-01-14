<?php

namespace App\Exports;

use App\TaiwanSite;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TaiwanSitesExport implements FromCollection,WithHeadings
{

	public function headings():array {

		return [
			'name', 
			'description', 
			'address', 
			'parking info', 
			'ticket info'
		];
	}
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect(TaiwanSite::getSites());
    }
}
