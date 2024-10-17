<?php

namespace App\Implementations;

use App\Interfaces\Model;
use App\Models\ProductTransaction;

class ProductTransactionImplementation implements Model
{
    private $productTransaction;

    public function __construct()
    {
        $this->productTransaction = new ProductTransaction();
    }

    public function resolveCriteria($data = [])
    {
        $query = ProductTransaction::query();

        if (array_key_exists('columns', $data)) {
            $query = $query->select($data['columns']);
        } elseif (array_key_exists('raw_columns', $data)) {
            $query = $query->selectRaw($data['raw_columns']);
        } else {
            $query = $query->select("*");
        }

        if (array_key_exists('transaction_type', $data)) {
            $query = $query->where('transaction_type', $data['transaction_type']);
        }
        if (array_key_exists('product_id', $data)) {
            $query = $query->where('product_id', $data['product_id']);
        }
        if (array_key_exists('location_id', $data)) {
            $query = $query->where('location_id', $data['location_id']);
        }
        if (array_key_exists('user_id', $data)) {
            $query = $query->where('user_id', $data['user_id']);
        }
        if (array_key_exists('quantity', $data)) {
            $query = $query->where('quantity', $data['quantity']);
        }
        if (array_key_exists('notes', $data)) {
            $query = $query->where('notes', 'like', '%' . $data['notes'] . '%');
        }
        if (array_key_exists('created_at', $data)) {
            $query = $query->whereDate('created_at', $data['created_at']);
        }
        if (array_key_exists('orderBy', $data)) {
            $query = $query->orderBy($data['orderBy'], 'DESC');
        } else {
            $query = $query->orderBy('id', 'DESC');
        }

        return $query;
    }

    public function getOne($id)
    {
        return ProductTransaction::findOrFail($id);
    }

    public function getList($data)
    {
        return $this->resolveCriteria($data)->get();
    }

    public function getPaginatedList($data, $perPage)
    {
        return $this->resolveCriteria($data)->paginate($perPage);
    }

    public function Create($data = [])
    {
        $this->mapDataModel($data);
        $this->productTransaction->save();
        return $this->productTransaction;
    }

    public function Update($data = [], $id)
    {
        $this->productTransaction = $this->getOne($id);
        $this->mapDataModel($data);
        $this->productTransaction->save();
        return $this->productTransaction;
    }

    public function Delete($id)
    {
        $record = $this->getOne($id);
        $record->delete();
    }

    public function mapDataModel($data)
    {
        $attributes = [
            'transaction_type',
            'product_id',
            'location_id',
            'user_id',
            'quantity',
            'notes',
        ];

        foreach ($attributes as $val) {
            if (array_key_exists($val, $data)) {
                $this->productTransaction->$val = $data[$val];
            }
        }
    }
}