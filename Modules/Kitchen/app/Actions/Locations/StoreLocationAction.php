<?php
namespace Modules\Location\App\Actions\Locations;

use Hash;
use App\Models\Location;
use App\Traits\Response;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;


use Modules\Location\App\Http\Resources\LocationResource;
use Modules\Location\App\Implementations\LocationImplementation;

class StoreLocationAction
{
    use AsAction;
    use Response;
    private $location;
    
    function __construct(LocationImplementation $locationImplementation)
    {
        $this->location = $locationImplementation;
    }

    public function handle(array $data)
    {

        $location = $this->location->create($data);

        return new locationResource($location);
    }
    public function rules()
    {
        return [
            'name' => ['required','unique:locations,name'],
        ];
    }
    public function withValidator(Validator $validator, ActionRequest $request)
    {
    }

    public function asController(Request $request)
    {
        if(auth('sanctum')->check() &&  !auth('sanctum')->user()->has_permission('location.add'))
            return $this->sendError('Forbidden',[],403);

        $location = $this->handle($request->all());

        return $this->sendResponse($location,' Location Added Successfully');
    }
}