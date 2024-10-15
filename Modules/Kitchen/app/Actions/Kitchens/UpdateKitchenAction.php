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

class UpdateKitchenAction
{
    use AsAction;
    use Response;
    private $kitchen;
    
    function __construct(KitchenImplementation $kitchenImplementation)
    {
        $this->kitchen = $kitchenImplementation;
    }

    public function handle(array $data, int $id)
    {
        $kitchen = $this->kitchen->Update($data, $id);
        return new KitchenResource($kitchen);
    }
    public function rules(Request $request)
    {
        return [
            'name' => ['unique:kitchens,name,'.$request->route('id')],
        ];
    }
    public function withValidator(Validator $validator, ActionRequest $request)
    {
    }

    public function asController(Request $request, int $id)
    {

        if(auth('sanctum')->check() &&  !auth('sanctum')->user()->has_permission('kitchen.edit'))
            return $this->sendError('Forbidden',[],403);

        $kitchen = $this->handle($request->all(), $id);

        return $this->sendResponse($kitchen,'Updated Successfly');
    }
}