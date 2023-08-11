<?php

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bulkproduct extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
        'bulkproduct_assetID',
        'bulkproduct_newassetID',
        'bulkproduct_bulktype',
        // 'bulkproduct_serial',
        'bulkproduct_transfer',
        'bulkproduct_reser',
        'bulkproduct_origin',
        'bulkproduct_sdvin',
        'bulkproduct_sdvout',
        'bulkproduct_station',
        'bulkproduct_requestor',
        'bulkproduct_project',
        'bulkproduct_datein',
        'bulkproduct_dateout',
        'bulkproduct_dateoffshore',
        'bulkproduct_tfoffshore',
        'bulkproduct_curloc',
        'bulkproduct_targetpdn',
        'bulkproduct_stockin',
        'bulkproduct_stockout',
        'bulkproduct_docin',
        'bulkproduct_docout',
        'bulkproduct_stockqty',
        'bulkproduct_uom',
        'bulkproduct_csrelease',
        'bulkproduct_csnumber',
        'bulkproduct_cenumber',
        'bulkproduct_ronumber',
        'bulkproduct_startdate',
        'bulkproduct_enddate',
        'bulkproduct_price',
        'bulkproduct_remark',
        'bulkproduct_image',
        'bulkproduct_code',
    ];

    public $sortable = [
        'bulkproduct_assetID',
        'bulkproduct_newassetID',
        'bulkproduct_bulktype',
        // 'bulkproduct_serial',
        'bulkproduct_transfer',
        'bulkproduct_reser',
        'bulkproduct_origin',
        'bulkproduct_sdvin',
        'bulkproduct_sdvout',
        'bulkproduct_station',
        'bulkproduct_requestor',
        'bulkproduct_project',
        'bulkproduct_datein',
        'bulkproduct_dateout',
        'bulkproduct_dateoffshore',
        'bulkproduct_tfoffshore',
        'bulkproduct_curloc',
        'bulkproduct_targetpdn',
        'bulkproduct_stockin',
        'bulkproduct_stockout',
        'bulkproduct_docin',
        'bulkproduct_docout',
        'bulkproduct_stockqty',
        'bulkproduct_uom',
        'bulkproduct_csrelease',
        'bulkproduct_csnumber',
        'bulkproduct_cenumber',
        'bulkproduct_ronumber',
        'bulkproduct_startdate',
        'bulkproduct_enddate',
        'bulkproduct_price',
        'bulkproduct_remark',
    ];

    protected $guarded = [
        'id',
    ];

    protected $with = [

    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('bulkproduct_bulktype', 'like', '%' . $search . '%');
        });
    }
}
