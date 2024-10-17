<?php

namespace App\Implementations;

use App\Interfaces\Model;
use Modules\Kitchen\App\Models\Product;

class ProductImplementation implements Model
{
    private $product;

    function __construct()
    {
        $this->product = new Product();
    }
    public function resolveCriteria($data = [])
    {
       // dd(1);
        $query = Product::Query();

        if (array_key_exists('columns', $data)) {
            $query = $query->select($data['columns']);
        } elseif (array_key_exists('raw_columns', $data)) {
            $query = $query->selectRaw($data['raw_columns']);
        } else {
            $query = $query->select("*");
        }
        if (array_key_exists('keywords', $data)) {
            return $query->where('name', 'like', '%' . $data['keywords'] . '%');
        }
        if (array_key_exists('name', $data)) {
            $query = $query->where('name', $data['name']);
        }
        if (array_key_exists('status', $data)) {
            $query = $query->where('status', $data['status']);
        }
        if (array_key_exists('qr_code', $data)) {
            $query = $query->where('qr_code', $data['qr_code']);
        }
        if (array_key_exists('location_id', $data)) {
            $query = $query->where('location_id', $data['location_id']);
        }
        if (array_key_exists('sub_location_id', $data)) {
            $query = $query->where('sub_location_id', $data['sub_location_id']);
        }
        if (array_key_exists('id', $data)) {
            $query = $query->where('id', $data['id']);
        }
        if (array_key_exists('ingredients', $data)) {
            $query = $query->where('ingredients', $data['ingredients']);
        }
        if (array_key_exists('quantity', $data)) {
            $query = $query->where('quantity', $data['quantity']);
        }
        if (array_key_exists('alert_quantity', $data)) {
            $query = $query->where('alert_quantity', $data['alert_quantity']);
        }
        if (array_key_exists('expiry_date', $data)) {
            $query = $query->where('expiry_date', $data['expiry_date']);
        }
        if (array_key_exists('production_date', $data)) {
            $query = $query->where('production_date', $data['production_date']);
        }

        if (array_key_exists('orderBy', $data)) {
            $query = $query->orderBy($data['orderBy'], 'DESC');
        } else {
            $query = $query->orderBy('id', 'DESC');
        }
// dd($query);
        return $query;

    }

    public function getOne($id)
    {
        $product = Product::findOrFail($id);
        return $product;
    }
    public function getList($data)
    {
        $list = $this->resolveCriteria($data)->get();
        return $list;
    }
    public function getPaginatedList($data, $perPage)
    {
        $list = $this->resolveCriteria($data)->paginate($perPage);
        return $list;
    }
    public function Create($data = [])
    {

        $this->mapDataModel($data);

        $this->product->save();

        return $this->product;

    }
    public function Update($data = [], $id)
    {
        $this->product = $this->getOne($id);

        $this->mapDataModel($data);

        $this->product->save();

        return $this->product;
    }
    public function Delete($id)
    {
        $record = $this->getOne($id);

        $record->delete();
    }

    public function mapDataModel($data)
    {
        $attribute = [
            'id',
            'location_id',
            'sub_location_id',
            'name',
            'ingredients',
            'status',
            'qr_code',
            'quantity',
            'alert_quantity',
            'expiry_date',
            'production_date',
            'created_at',
            'created_at',
            'updated_at',
            'deleted_at',
            'created_by'
            ,
            'updated_by'
            ,
            'deleted_by'
        ];
        foreach ($attribute as $val) {
            if (array_key_exists($val, $data)) {
                $this->product->$val = $data[$val];
            }
        }
    }


}
