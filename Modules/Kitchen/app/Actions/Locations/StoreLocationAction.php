<?php
namespace Modules\Kitchen\App\Actions\Locations;

use Hash;
use App\Traits\Response;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Lorisleiva\Actions\ActionRequest;
use App\Http\Resources\LocationResource;
use Lorisleiva\Actions\Concerns\AsAction;
use App\Implementations\LocationImplementation;

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

        return new LocationResource($location);
    }
    public function rules()
    {
        return [
            'name' => ['required','unique:locations,name'],
            'kitchen_id' => ['required','exists:kitchens,id'],
            'status' => ['required'],
            'qr_code' => ['required'],
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