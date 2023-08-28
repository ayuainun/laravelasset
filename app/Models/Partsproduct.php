<?php

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Partsproduct extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
        'partsproduct_assetID',
        'partsproduct_newassetID',
        'partsproduct_desc',
        'partsproduct_partnumber',
        // 'partsproduct_serial',
        'partsproduct_transfer',
        'partsproduct_reser',
        'partsproduct_origin',
        'partsproduct_sdvin',
        'partsproduct_sdvout',
        'partsproduct_station',
        'partsproduct_requestor',
        'partsproduct_project',
        'partsproduct_datein',
        'partsproduct_dateout',
        'partsproduct_dateoffshore',
        'partsproduct_tfoffshore',
        'partsproduct_curloc',
        'partsproduct_targetpdn',
        'partsproduct_stockin',
        'partsproduct_stockout',
        'partsproduct_docin',
        'partsproduct_docout',
        'partsproduct_stockqty',
        'partsproduct_uom',
        'partsproduct_csrelease',
        'partsproduct_csnumber',
        'partsproduct_cenumber',
        'partsproduct_ronumber',
        'partsproduct_startdate',
        'partsproduct_enddate',
        'partsproduct_price',
        'partsproduct_remark',
        'partsproduct_image',
        'partsproduct_code',
        'partsproduct_status',

    ];

    public $sortable = [
        'partsproduct_assetID',
        'partsproduct_newassetID',
        'partsproduct_desc',
        'partsproduct_partnumber',
        // 'partsproduct_serial',
        'partsproduct_transfer',
        'partsproduct_reser',
        'partsproduct_origin',
        'partsproduct_sdvin',
        'partsproduct_sdvout',
        'partsproduct_station',
        'partsproduct_requestor',
        'partsproduct_project',
        'partsproduct_datein',
        'partsproduct_dateout',
        'partsproduct_dateoffshore',
        'partsproduct_tfoffshore',
        'partsproduct_curloc',
        'partsproduct_targetpdn',
        'partsproduct_stockin',
        'partsproduct_stockout',
        'partsproduct_docin',
        'partsproduct_docout',
        'partsproduct_stockqty',
        'partsproduct_uom',
        'partsproduct_csrelease',
        'partsproduct_csnumber',
        'partsproduct_cenumber',
        'partsproduct_ronumber',
        'partsproduct_startdate',
        'partsproduct_enddate',
        'partsproduct_price',
        'partsproduct_remark',
        'partsproduct_status',

    ];

    protected $guarded = [
        'id',
    ];

    protected $with = [

    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('partsproduct_newassetID', 'like', '%' . $search . '%');
        });
    }
}
