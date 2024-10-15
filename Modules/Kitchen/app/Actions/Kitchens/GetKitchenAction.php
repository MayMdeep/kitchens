<?php
namespace Modules\Kitchen\App\Actions\Kitchens;
use Hash;
use App\Traits\Response;
use Illuminate\Validation\Validator;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;
use Modules\Kitchen\App\Http\Resources\KitchenResource;
use Modules\Kitchen\App\Implementations\KitchenImplementation;

class GetKitchenAction
{
    use AsAction;
    use Response;
    private $kitchen;
    
    function __construct(KitchenImplementation $KitchenImplementation)
    {
        $this->kitchen = $KitchenImplementation;
    }

    public function handle(int $id)
    {
        return new KitchenResource($this->kitchen->getOne($id));
    }
    public function rules()
    {
        return [];
    }
    public function withValidator(Validator $validator, ActionRequest $request){}

    public function asController(int $id)
    {
        if(auth('sanctum')->check() &&  !auth('sanctum')->user()->has_permission('kitchen.get'))
            return $this->sendError('Forbidden',[],403);

        $record = $this->handle($id);

        return $this->sendResponse($record,'');
    }
}