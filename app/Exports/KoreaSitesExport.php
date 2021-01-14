<?php

namespace App\Exports;

use App\KoreaSite;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KoreaSitesExport implements FromCollection,WithHeadings
{

	public function headings():array {

		return [
			'name', 
			'description', 
			'address', 
			'parking info', 
			'public facility', 
			'accomodation', 
			'sports facility', 
			'entertainment facility', 
			'support facility'
		];
	}
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect(KoreaSite::getSites());
    }
}
