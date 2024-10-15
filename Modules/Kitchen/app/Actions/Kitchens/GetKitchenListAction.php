<?php
namespace Modules\Kitchen\App\Actions\Kitchens;
use Hash;
use App\Traits\Response;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;
use Modules\Kitchen\App\Http\Resources\KitchenResource;
use Modules\Kitchen\App\Implementations\KitchenImplementation;
class GetKitchenListAction
{
    use AsAction;
    use Response;
    private $kitchen;
    
    function __construct(KitchenImplementation $kitchenImplementation)
    {
        $this->kitchen = $kitchenImplementation;
    }

    public function handle(array $data = [], int $perPage = 10)
    {
        if (!is_numeric($perPage))
            $perPage = 10;
        
        return KitchenResource::collection($this->kitchen->getPaginatedList($data, $perPage));
    }
    public function rules()
    {
        return [];
    }
    public function withValidator(Validator $validator, ActionRequest $request){}

    public function asController(Request $request)
    {
       if(auth('sanctum')->check() &&  !auth('sanctum')->user()->has_permission('kitchen.get'))
           return $this->sendError('Forbidden',[],403);

        $list = $this->handle($request->all(),  $request->input('results', 10));
        
        return $this->sendPaginatedResponse($list,'');
    }
}