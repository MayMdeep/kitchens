<?php
namespace Modules\Location\App\Actions\Locations;

use Hash;
use App\Traits\Response;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;
use Modules\Location\App\Http\Resources\LocationResource;
use Modules\Location\App\Implementations\LocationImplementation;

class UpdateLocationAction
{
    use AsAction;
    use Response;
    private $location;
    
    function __construct(LocationImplementation $locationImplementation)
    {
        $this->location = $locationImplementation;
    }

    public function handle(array $data, int $id)
    {
        $location = $this->location->Update($data, $id);
        return new LocationResource($location);
    }
    public function rules(Request $request)
    {
        return [
            'name' => ['unique:locations,name,'.$request->route('id')],
        ];
    }
    public function withValidator(Validator $validator, ActionRequest $request)
    {
    }

    public function asController(Request $request, int $id)
    {

        if(auth('sanctum')->check() &&  !auth('sanctum')->user()->has_permission('location.edit'))
            return $this->sendError('Forbidden',[],403);

        $location = $this->handle($request->all(), $id);

        return $this->sendResponse($location,'Updated Successfly');
    }
}