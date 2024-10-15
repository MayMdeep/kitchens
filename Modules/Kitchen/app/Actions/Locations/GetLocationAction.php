<?php
namespace Modules\Location\App\Actions\Locations;
use Hash;
use App\Traits\Response;
use Illuminate\Validation\Validator;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;
use Modules\Location\App\Http\Resources\LocationResource;
use Modules\Location\App\Implementations\LocationImplementation;

class GetLocationAction
{
    use AsAction;
    use Response;
    private $location;
    
    function __construct(LocationImplementation $LocationImplementation)
    {
        $this->location = $LocationImplementation;
    }

    public function handle(int $id)
    {
        return new LocationResource($this->location->getOne($id));
    }
    public function rules()
    {
        return [];
    }
    public function withValidator(Validator $validator, ActionRequest $request){}

    public function asController(int $id)
    {
        if(auth('sanctum')->check() &&  !auth('sanctum')->user()->has_permission('location.get'))
            return $this->sendError('Forbidden',[],403);

        $record = $this->handle($id);

        return $this->sendResponse($record,'');
    }
}