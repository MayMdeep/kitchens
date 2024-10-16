<?php
namespace Modules\Kitchen\App\Actions\SubLocations;
use Hash;
use App\Traits\Response;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Lorisleiva\Actions\ActionRequest;
use App\Http\Resources\SubLocationResource;
use Lorisleiva\Actions\Concerns\AsAction;
use App\Implementations\SubLocationImplementation;
class GetSubLocationListAction
{
    use AsAction;
    use Response;
    private $subLocation;
    
    function __construct(SubLocationImplementation $subLocationImplementation)
    {
        $this->subLocation = $subLocationImplementation;
    }

    public function handle(array $data = [], int $perPage = 10)
    {
        if (!is_numeric($perPage))
            $perPage = 10;
        
        return SubLocationResource::collection($this->subLocation->getPaginatedList($data, $perPage));
    }
    public function rules()
    {
        return [];
    }
    public function withValidator(Validator $validator, ActionRequest $request){}

    public function asController(Request $request)
    {
       if(auth('sanctum')->check() &&  !auth('sanctum')->user()->has_permission('subLocation.get'))
           return $this->sendError('Forbidden',[],403);

        $list = $this->handle($request->all(),  $request->input('results', 10));
        
        return $this->sendPaginatedResponse($list,'');
    }
}