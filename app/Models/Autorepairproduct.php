<?php

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Autorepairproduct extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
            'autorepairproduct_assetID',
            'autorepairproduct_newassetID',
            'autorepairproduct_autobrand',
            'autorepairproduct_datein',
            'autorepairproduct_transfer',
            'autorepairproduct_reser',
            'autorepairproduct_origin',
            'autorepairproduct_sdvin',
            'autorepairproduct_sdvout',
            'autorepairproduct_station',
            'autorepairproduct_requestor',
            'autorepairproduct_project',
            'autorepairproduct_dateout',
            'autorepairproduct_dateoffshore',
            'autorepairproduct_tfoffshore',
            'autorepairproduct_curloc',
            'autorepairproduct_stockin',
            'autorepairproduct_stockout',
            'autorepairproduct_docin',
            'autorepairproduct_docout',
            'autorepairproduct_dateout',
            'autorepairproduct_stockqty',
            'autorepairproduct_uom',
            'autorepairproduct_targetpdn',
            'autorepairproduct_csrelease',
            'autorepairproduct_csnumber',
            'autorepairproduct_cenumber',
            'autorepairproduct_ronumber',
            'autorepairproduct_startdate',
            'autorepairproduct_enddate',
            'autorepairproduct_remark',
            'autorepairproduct_image',
            'autorepairproduct_code',
    ];

    public $sortable = [
            'autorepairproduct_assetID',
            'autorepairproduct_newassetID',
            'autorepairproduct_autobrand',
            'autorepairproduct_datein',
            'autorepairproduct_transfer',
            'autorepairproduct_reser',
            'autorepairproduct_origin',
            'autorepairproduct_sdvin',
            'autorepairproduct_sdvout',
            'autorepairproduct_station',
            'autorepairproduct_requestor',
            'autorepairproduct_project',
            'autorepairproduct_dateout',
            'autorepairproduct_dateoffshore',
            'autorepairproduct_tfoffshore',
            'autorepairproduct_curloc',
            'autorepairproduct_stockin',
            'autorepairproduct_stockout',
            'autorepairproduct_docin',
            'autorepairproduct_docout',
            'autorepairproduct_dateout',
            'autorepairproduct_stockqty',
            'autorepairproduct_uom',
            'autorepairproduct_targetpdn',
            'autorepairproduct_csrelease',
            'autorepairproduct_csnumber',
            'autorepairproduct_cenumber',
            'autorepairproduct_ronumber',
            'autorepairproduct_startdate',
            'autorepairproduct_enddate',
            'autorepairproduct_remark',
    ];

    protected $guarded = [
        'id',
    ];

    protected $with = [

    ];


    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('autorepairproduct_autobrand', 'like', '%' . $search . '%');
        });
    }
}
