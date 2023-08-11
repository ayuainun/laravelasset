<?php

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Repairproduct extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
            'repairproduct_assetID',
            'repairproduct_newassetID',
            'repairproduct_equip',
            'repairproduct_unit',
            'repairproduct_end',
            'repairproduct_size',
            'repairproduct_rating',
            'repairproduct_brand',
            'repairproduct_valvemodel',
            'repairproduct_serial',
            'repairproduct_condi',
            'repairproduct_actbrand',
            'repairproduct_acttype',
            'repairproduct_actsize',
            'repairproduct_fail',
            'repairproduct_actcond',
            'repairproduct_posbrand',
            'repairproduct_posmodel',
            'repairproduct_inputsignal',
            'repairproduct_poscond',
            'repairproduct_other',
            'repairproduct_datein',
            'repairproduct_transfer',
            'repairproduct_reser',
            'repairproduct_origin',
            'repairproduct_sdvin',
            'repairproduct_sdvout',
            'repairproduct_station',
            'repairproduct_requestor',
            'repairproduct_project',
            'repairproduct_dateout',
            'repairproduct_dateoffshore',
            'repairproduct_tfoffshore',
            'repairproduct_curloc',
            'repairproduct_stockin',
            'repairproduct_stockout',
            'repairproduct_docin',
            'repairproduct_docout',
            'repairproduct_dateout',
            'repairproduct_stockqty',
            'repairproduct_uom',
            'repairproduct_targetpdn',
            'repairproduct_csrelease',
            'repairproduct_csnumber',
            'repairproduct_cenumber',
            'repairproduct_ronumber',
            'repairproduct_startdate',
            'repairproduct_enddate',
            'repairproduct_price',
            'repairproduct_remark',
            'repairproduct_image',
            'repairproduct_code',
    ];

    public $sortable = [
            'repairproduct_assetID',
            'repairproduct_newassetID',
            'repairproduct_equip',
            'repairproduct_unit',
            'repairproduct_end',
            'repairproduct_size',
            'repairproduct_rating',
            'repairproduct_brand',
            'repairproduct_valvemodel',
            'repairproduct_serial',
            'repairproduct_condi',
            'repairproduct_actbrand',
            'repairproduct_acttype',
            'repairproduct_actsize',
            'repairproduct_fail',
            'repairproduct_actcond',
            'repairproduct_posbrand',
            'repairproduct_posmodel',
            'repairproduct_inputsignal',
            'repairproduct_poscond',
            'repairproduct_other',
            'repairproduct_datein',
            'repairproduct_transfer',
            'repairproduct_reser',
            'repairproduct_origin',
            'repairproduct_sdvin',
            'repairproduct_sdvout',
            'repairproduct_station',
            'repairproduct_requestor',
            'repairproduct_project',
            'repairproduct_dateout',
            'repairproduct_dateoffshore',
            'repairproduct_tfoffshore',
            'repairproduct_curloc',
            'repairproduct_stockin',
            'repairproduct_stockout',
            'repairproduct_docin',
            'repairproduct_docout',
            'repairproduct_dateout',
            'repairproduct_stockqty',
            'repairproduct_uom',
            'repairproduct_targetpdn',
            'repairproduct_csrelease',
            'repairproduct_csnumber',
            'repairproduct_cenumber',
            'repairproduct_ronumber',
            'repairproduct_startdate',
            'repairproduct_enddate',
            'repairproduct_price',
            'repairproduct_remark',
    ];

    protected $guarded = [
        'id',
    ];

    protected $with = [
        
    ];
    
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('repairproduct_unit', 'like', '%' . $search . '%');
        });
    }
}
