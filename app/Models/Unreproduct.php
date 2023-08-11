<?php

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unreproduct extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
        'unreproduct_assetID',
        'unreproduct_newassetID',
        'unreproduct_desc',
        // 'unreproduct_serial',
        'unreproduct_transfer',
        'unreproduct_reser',
        'unreproduct_origin',
        'unreproduct_sdvin',
        'unreproduct_sdvout',
        'unreproduct_station',
        'unreproduct_requestor',
        'unreproduct_project',
        'unreproduct_datein',
        'unreproduct_dateout',
        'unreproduct_dateoffshore',
        'unreproduct_tfoffshore',
        'unreproduct_curloc',
        'unreproduct_targetpdn',
        'unreproduct_stockin',
        'unreproduct_stockout',
        'unreproduct_docin',
        'unreproduct_docout',
        'unreproduct_stockqty',
        'unreproduct_uom',
        'unreproduct_csrelease',
        'unreproduct_csnumber',
        'unreproduct_cenumber',
        'unreproduct_ronumber',
        'unreproduct_startdate',
        'unreproduct_enddate',
        'unreproduct_price',
        'unreproduct_remark',
        'unreproduct_image',
        'unreproduct_code',
    ];

    public $sortable = [
        'unreproduct_assetID',
        'unreproduct_newassetID',
        'unreproduct_desc',
        // 'unreproduct_serial',
        'unreproduct_transfer',
        'unreproduct_reser',
        'unreproduct_origin',
        'unreproduct_sdvin',
        'unreproduct_sdvout',
        'unreproduct_station',
        'unreproduct_requestor',
        'unreproduct_project',
        'unreproduct_datein',
        'unreproduct_dateout',
        'unreproduct_dateoffshore',
        'unreproduct_tfoffshore',
        'unreproduct_curloc',
        'unreproduct_targetpdn',
        'unreproduct_stockin',
        'unreproduct_stockout',
        'unreproduct_docin',
        'unreproduct_docout',
        'unreproduct_stockqty',
        'unreproduct_uom',
        'unreproduct_csrelease',
        'unreproduct_csnumber',
        'unreproduct_cenumber',
        'unreproduct_ronumber',
        'unreproduct_startdate',
        'unreproduct_enddate',
        'unreproduct_price',
        'unreproduct_remark',
    ];

    protected $guarded = [
        'id',
    ];

    protected $with = [

    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('unreproduct_newassetID', 'like', '%' . $search . '%');
        });
    }
}
