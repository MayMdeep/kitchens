<?php
namespace Modules\Kitchen\App\Actions\SubLocations;
use Hash;
use App\Traits\Response;
use Illuminate\Validation\Validator;
use Lorisleiva\Actions\ActionRequest;
use App\Http\Resources\SubLocationResource;
use Lorisleiva\Actions\Concerns\AsAction;
use App\Implementations\SubLocationImplementation;

class GetSubLocationAction
{
    use AsAction;
    use Response;
    private $subLocation;
    
    function __construct(SubLocationImplementation $SubLocationImplementation)
    {
        $this->subLocation = $SubLocationImplementation;
    }

    public function handle(int $id)
    {
        return new SubLocationResource($this->subLocation->getOne($id));
    }
    public function rules()
    {
        return [];
    }
    public function withValidator(Validator $validator, ActionRequest $request){}

    public function asController(int $id)
    {
        if(auth('sanctum')->check() &&  !auth('sanctum')->user()->has_permission('subLocation.get'))
            return $this->sendError('Forbidden',[],403);

        $record = $this->handle($id);

        return $this->sendResponse($record,'');
    }
}