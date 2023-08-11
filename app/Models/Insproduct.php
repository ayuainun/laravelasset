<?php

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Insproduct extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
        'insproduct_assetID',
        'insproduct_newassetID',
        'insproduct_instype',
        'insproduct_insbrand',
        // 'insproduct_serial',
        'insproduct_transfer',
        'insproduct_reser',
        'insproduct_origin',
        'insproduct_sdvin',
        'insproduct_sdvout',
        'insproduct_station',
        'insproduct_requestor',
        'insproduct_project',
        'insproduct_datein',
        'insproduct_dateout',
        'insproduct_dateoffshore',
        'insproduct_tfoffshore',
        'insproduct_curloc',
        'insproduct_targetpdn',
        'insproduct_stockin',
        'insproduct_stockout',
        'insproduct_docin',
        'insproduct_docout',
        'insproduct_stockqty',
        'insproduct_uom',
        'insproduct_csrelease',
        'insproduct_csnumber',
        'insproduct_cenumber',
        'insproduct_ronumber',
        'insproduct_startdate',
        'insproduct_enddate',
        'insproduct_price',
        'insproduct_remark',
        'insproduct_image',
        'insproduct_code',
    ];

    public $sortable = [
        'insproduct_assetID',
        'insproduct_newassetID',
        'insproduct_instype',
        'insproduct_insbrand',
        // 'insproduct_serial',
        'insproduct_transfer',
        'insproduct_reser',
        'insproduct_origin',
        'insproduct_sdvin',
        'insproduct_sdvout',
        'insproduct_station',
        'insproduct_requestor',
        'insproduct_project',
        'insproduct_datein',
        'insproduct_dateout',
        'insproduct_dateoffshore',
        'insproduct_tfoffshore',
        'insproduct_curloc',
        'insproduct_targetpdn',
        'insproduct_stockin',
        'insproduct_stockout',
        'insproduct_docin',
        'insproduct_docout',
        'insproduct_stockqty',
        'insproduct_uom',
        'insproduct_csrelease',
        'insproduct_csnumber',
        'insproduct_cenumber',
        'insproduct_ronumber',
        'insproduct_startdate',
        'insproduct_enddate',
        'insproduct_price',
        'insproduct_remark',
    ];

    protected $guarded = [
        'id',
    ];

    protected $with = [

    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('insproduct_instype', 'like', '%' . $search . '%');
        });
    }
}
