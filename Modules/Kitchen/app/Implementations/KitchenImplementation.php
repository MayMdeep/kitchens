<?php

namespace Modules\Kitchen\App\Implementations;

use App\Interfaces\Model;
use Modules\Kitchen\App\Models\Kitchen;

class KitchenImplementation implements Model
{
    private $kitchen;

    function __construct()
    {
        $this->kitchen = New Kitchen();
    }
    public function resolveCriteria($data = [])
    {
        $query = Kitchen::Query();

        if (array_key_exists('columns', $data)) {
            $query = $query->select($data['columns']);
        } elseif (array_key_exists('raw_columns', $data)) {
            $query = $query->selectRaw($data['raw_columns']);
        } else {
            $query = $query->select("*");
        }
        if (array_key_exists('keywords', $data)) {
          //  $query = $query->whereHas('allTranslations', function ($query) use ($data){
                return $query->where('name', 'like', '%'.$data['keywords'].'%');
          //  })->orWhere('name',  'like', '%'.$data['keywords'].'%');
        }
        if (array_key_exists('name', $data)) {
            $query = $query->where('name',  $data['name']);
        }
        if (array_key_exists('id', $data)) {
            $query = $query->where('id',  $data['id']);
        }

        if (array_key_exists('orderBy', $data)) {
            $query = $query->orderBy($data['orderBy'], 'DESC');
        }else {
            $query = $query->orderBy('id', 'DESC');
        }
        $query->with('locations');
        return $query;

    }

    public function getOne($id)
    {
        $kitchen = Kitchen::findOrFail($id);
        return $kitchen;
    }
    public function getList($data) {
        $list = $this->resolveCriteria($data)->get();
        return $list;
    }
    public function getPaginatedList($data, $perPage) {
        $list = $this->resolveCriteria($data)->paginate($perPage);
        return $list;
    }
    public function Create($data = [])
    {

        $this->mapDataModel($data);

        $this->kitchen->save();

        return $this->kitchen;

    }
    public function Update($data = [], $id)
    {
        $this->kitchen = $this->getOne($id);

        $this->mapDataModel($data);

        $this->kitchen->save();

        return $this->kitchen;
    }
    public function Delete($id) {
        $record = $this->getOne($id);

        $record->delete();
    }

    public function mapDataModel($data)
    {
        $attribute = [
			'id'
			,'name'
			,'created_at'
			,'updated_at'
			,'deleted_at'
			,'created_by'
			,'updated_by'
			,'deleted_by'
        ];
        foreach ($attribute as $val) {
            if (array_key_exists($val, $data)) {
                $this->kitchen->$val = $data[$val];
            }
        }
    }


}
