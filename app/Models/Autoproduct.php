<?php

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Autoproduct extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
            'autoproduct_assetID',
            'autoproduct_newassetID',
            'autoproduct_brand',
            'autoproduct_datein',
            'autoproduct_transfer',
            'autoproduct_reser',
            'autoproduct_origin',
            'autoproduct_sdvin',
            'autoproduct_sdvout',
            'autoproduct_station',
            'autoproduct_requestor',
            'autoproduct_project',
            'autoproduct_dateout',
            'autoproduct_dateoffshore',
            'autoproduct_tfoffshore',
            'autoproduct_curloc',
            'autoproduct_stockin',
            'autoproduct_stockout',
            'autoproduct_docin',
            'autoproduct_docout',
            'autoproduct_dateout',
            'autoproduct_stockqty',
            'autoproduct_uom',
            'autoproduct_targetpdn',
            'autoproduct_csrelease',
            'autoproduct_csnumber',
            'autoproduct_cenumber',
            'autoproduct_ronumber',
            'autoproduct_startdate',
            'autoproduct_enddate',
            'autoproduct_remark',
            'autoproduct_image',
            'autoproduct_code',
            'autoproduct_status',

    ];

    public $sortable = [
            'autoproduct_assetID',
            'autoproduct_newassetID',
            'autoproduct_brand',
            'autoproduct_datein',
            'autoproduct_transfer',
            'autoproduct_reser',
            'autoproduct_origin',
            'autoproduct_sdvin',
            'autoproduct_sdvout',
            'autoproduct_station',
            'autoproduct_requestor',
            'autoproduct_project',
            'autoproduct_dateout',
            'autoproduct_dateoffshore',
            'autoproduct_tfoffshore',
            'autoproduct_curloc',
            'autoproduct_stockin',
            'autoproduct_stockout',
            'autoproduct_docin',
            'autoproduct_docout',
            'autoproduct_dateout',
            'autoproduct_stockqty',
            'autoproduct_uom',
            'autoproduct_targetpdn',
            'autoproduct_csrelease',
            'autoproduct_csnumber',
            'autoproduct_cenumber',
            'autoproduct_ronumber',
            'autoproduct_startdate',
            'autoproduct_enddate',
            'autoproduct_remark',
            'autoproduct_status',

    ];

    protected $guarded = [
        'id',
    ];

    protected $with = [

    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('autoproduct_brand', 'like', '%' . $search . '%');
        });
    }
}

