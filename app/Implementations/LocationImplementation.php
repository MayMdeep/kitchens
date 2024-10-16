<?php

namespace App\Implementations;

use App\Interfaces\Model;
use Modules\Kitchen\App\Models\Location;

class LocationImplementation implements Model
{
    private $location;

    function __construct()
    {
        $this->location = new Location();
    }
    public function resolveCriteria($data = [])
    {
        $query = Location::Query();

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
        if (array_key_exists('kitchen_id', $data)) {
            $query = $query->where('kitchen_id', $data['kitchen_id']);
        }
        if (array_key_exists('id', $data)) {
            $query = $query->where('id', $data['id']);
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
        $location = Location::findOrFail($id);
        return $location;
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

        $this->location->save();

        return $this->location;

    }
    public function Update($data = [], $id)
    {
        $this->location = $this->getOne($id);

        $this->mapDataModel($data);

        $this->location->save();

        return $this->location;
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
            'kitchen_id',
            'name',
            'status',
            'qr_code',
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
                $this->location->$val = $data[$val];
            }
        }
    }


}
