<?php
namespace Modules\Kitchen\App\Actions\Kitchens;

use Hash;
use App\Models\Kitchen;
use App\Traits\Response;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;


use Modules\Kitchen\App\Http\Resources\KitchenResource;
use Modules\Kitchen\App\Implementations\KitchenImplementation;

class StoreKitchenAction
{
    use AsAction;
    use Response;
    private $kitchen;
    
    function __construct(KitchenImplementation $kitchenImplementation)
    {
        $this->kitchen = $kitchenImplementation;
    }

    public function handle(array $data)
    {

        $kitchen = $this->kitchen->create($data);

        return new kitchenResource($kitchen);
    }
    public function rules()
    {
        return [
            'name' => ['required','unique:kitchens,name'],
        ];
    }
    public function withValidator(Validator $validator, ActionRequest $request)
    {
    }

    public function asController(Request $request)
    {
        if(auth('sanctum')->check() &&  !auth('sanctum')->user()->has_permission('kitchen.add'))
            return $this->sendError('Forbidden',[],403);

        $kitchen = $this->handle($request->all());

        return $this->sendResponse($kitchen,' Kitchen Added Successfully');
    }
}


