<?php
namespace Modules\Kitchen\App\Actions\Kitchens;

use Hash;
use App\Traits\Response;
use Illuminate\Validation\Validator;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;
use Modules\Kitchen\App\Implementations\KitchenImplementation;

class DeleteKitchenAction
{
    use AsAction;
    use Response;
    private $kitchen;
    
    function __construct(KitchenImplementation $kitchenImplementation)
    {
        $this->kitchen = $kitchenImplementation;
    }

    public function handle(int $id)
    {
        return $this->kitchen->delete($id);
    }
    public function rules()
    {
        return [];
    }
    public function withValidator(Validator $validator, ActionRequest $request)
    {
    }

    public function asController(int $id)
    {
        try{
    
            if(auth('sanctum')->check() &&  !auth('sanctum')->user()->has_permission('kitchen.delete'))
            return $this->sendError('Forbidden',[],403);
            $this->handle($id);
            return $this->sendResponse(['Success'], 'kitchen Deleted successfully.');
        
		}catch (\Exception $e) {
            return $this->sendError($e->getMessage());
			
		}
    }
}

