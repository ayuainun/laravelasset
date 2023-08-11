<?php

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Insrepairproduct extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
        'insrepairproduct_assetID',
        'insrepairproduct_newassetID',
        'insrepairproduct_instype',
        'insrepairproduct_insbrand',
        // 'insrepairproduct_serial',
        'insrepairproduct_transfer',
        'insrepairproduct_reser',
        'insrepairproduct_origin',
        'insrepairproduct_sdvin',
        'insrepairproduct_sdvout',
        'insrepairproduct_station',
        'insrepairproduct_requestor',
        'insrepairproduct_project',
        'insrepairproduct_datein',
        'insrepairproduct_dateout',
        'insrepairproduct_dateoffshore',
        'insrepairproduct_tfoffshore',
        'insrepairproduct_curloc',
        'insrepairproduct_targetpdn',
        'insrepairproduct_stockin',
        'insrepairproduct_stockout',
        'insrepairproduct_docin',
        'insrepairproduct_docout',
        'insrepairproduct_stockqty',
        'insrepairproduct_uom',
        'insrepairproduct_csrelease',
        'insrepairproduct_csnumber',
        'insrepairproduct_cenumber',
        'insrepairproduct_ronumber',
        'insrepairproduct_startdate',
        'insrepairproduct_enddate',
        'insrepairproduct_price',
        'insrepairproduct_remark',
        'insrepairproduct_image',
        'insrepairproduct_code',
    ];

    public $sortable = [
        'insrepairproduct_assetID',
        'insrepairproduct_newassetID',
        'insrepairproduct_instype',
        'insrepairproduct_insbrand',
        // 'insrepairproduct_serial',
        'insrepairproduct_transfer',
        'insrepairproduct_reser',
        'insrepairproduct_origin',
        'insrepairproduct_sdvin',
        'insrepairproduct_sdvout',
        'insrepairproduct_station',
        'insrepairproduct_requestor',
        'insrepairproduct_project',
        'insrepairproduct_datein',
        'insrepairproduct_dateout',
        'insrepairproduct_dateoffshore',
        'insrepairproduct_tfoffshore',
        'insrepairproduct_curloc',
        'insrepairproduct_targetpdn',
        'insrepairproduct_stockin',
        'insrepairproduct_stockout',
        'insrepairproduct_docin',
        'insrepairproduct_docout',
        'insrepairproduct_stockqty',
        'insrepairproduct_uom',
        'insrepairproduct_csrelease',
        'insrepairproduct_csnumber',
        'insrepairproduct_cenumber',
        'insrepairproduct_ronumber',
        'insrepairproduct_startdate',
        'insrepairproduct_enddate',
        'insrepairproduct_price',
        'insrepairproduct_remark',
    ];

    protected $guarded = [
        'id',
    ];

    protected $with = [

    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('insrepairproduct_instype', 'like', '%' . $search . '%');
        });
    }
}
