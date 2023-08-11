<?php

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
            'product_assetID',
            'product_newassetID',
            'product_equip',
            'product_type',
            'product_end',
            'product_size',
            'product_rating',
            'product_brand',
            'product_valvemodel',
            'product_serial',
            'product_condi',
            'product_actbrand',
            'product_acttype',
            'product_actsize',
            'product_fail',
            'product_actcond',
            'product_posbrand',
            'product_posmodel',
            'product_inputsignal',
            'product_poscond',
            'product_other',
            'product_datein',
            'product_transfer',
            'product_reser',
            'product_origin',
            'product_sdvin',
            'product_sdvout',
            'product_station',
            'product_requestor',
            'product_project',
            'product_dateout',
            'product_dateoffshore',
            'product_tfoffshore',
            'product_curloc',
            'product_stockin',
            'product_stockout',
            'product_docin',
            'product_docout',
            'product_dateout',
            'product_stockqty',
            'product_uom',
            'product_targetpdn',
            'product_csrelease',
            'product_csnumber',
            'product_cenumber',
            'product_ronumber',
            'product_startdate',
            'product_enddate',
            'product_price',
            'product_remark',
            'product_image',
            'product_code',
    ];

    public $sortable = [
            'product_assetID',
            'product_newassetID',
            'product_equip',
            'product_type',
            'product_end',
            'product_size',
            'product_rating',
            'product_brand',
            'product_valvemodel',
            'product_serial',
            'product_condi',
            'product_actbrand',
            'product_acttype',
            'product_actsize',
            'product_fail',
            'product_actcond',
            'product_posbrand',
            'product_posmodel',
            'product_inputsignal',
            'product_poscond',
            'product_other',
            'product_datein',
            'product_transfer',
            'product_reser',
            'product_origin',
            'product_sdvin',
            'product_sdvout',
            'product_station',
            'product_requestor',
            'product_project',
            'product_dateout',
            'product_dateoffshore',
            'product_tfoffshore',
            'product_curloc',
            'product_stockin',
            'product_stockout',
            'product_docin',
            'product_docout',
            'product_dateout',
            'product_stockqty',
            'product_uom',
            'product_targetpdn',
            'product_csrelease',
            'product_csnumber',
            'product_cenumber',
            'product_ronumber',
            'product_startdate',
            'product_enddate',
            'product_price',
            'product_remark',
    ];

    protected $guarded = [
        'id',
    ];

    // protected $with = [
    //     // 'unit',
    //     'end',
    //     'size',
    //     'rating',
    //     'valvebrand',
    //     'condi',
    //     'actbrand',
    //     'acttype',
    //     'actsize',
    //     'fail',
    //     'actcond',
    //     'posbrand',
    //     'posmodel',
    //     'poscond',
    //     'uom'
    // ];

    // // public function unit(){
    // //     return $this->belongsTo(Unit::class, 'unit_id');
    // // }
    // public function end(){
    //     return $this->belongsTo(End::class, 'end_id');
    // }
    // public function size(){
    //     return $this->belongsTo(Size::class, 'size_id');
    // }
    // public function rating(){
    //     return $this->belongsTo(Rating::class, 'rating_id');
    // }
    // public function valvebrand(){
    //     return $this->belongsTo(Valvebrand::class, 'brand_id');
    // }
    // public function condi(){
    //     return $this->belongsTo(Condi::class, 'condi_id');
    // }
    // public function actbrand(){
    //     return $this->belongsTo(Actbrand::class, 'actbrand_id');
    // }
    // public function acttype(){
    //     return $this->belongsTo(Acttype::class, 'acttype_id');
    // }
    // public function actsize(){
    //     return $this->belongsTo(Actsize::class, 'actsize_id');
    // }
    // public function fail(){
    //     return $this->belongsTo(Fail::class, 'fail_id');
    // }
    // public function actcond(){
    //     return $this->belongsTo(Actcond::class, 'actcond_id');
    // }
    // public function posbrand(){
    //     return $this->belongsTo(Posbrand::class, 'posbrand_id');
    // }
    // public function posmodel(){
    //     return $this->belongsTo(Posmodel::class, 'posmodel_id');
    // }
    // public function poscond(){
    //     return $this->belongsTo(Poscond::class, 'poscond_id');
    // }
    // public function uom(){
    //     return $this->belongsTo(Uom::class, 'uom_id');
    // }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('product_type', 'like', '%' . $search . '%');
        });
    }
}
