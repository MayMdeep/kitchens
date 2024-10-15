<?php
namespace Modules\Location\App\Actions\Locations;

use Hash;
use App\Traits\Response;
use Illuminate\Validation\Validator;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;
use Modules\Location\App\Implementations\LocationImplementation;

class DeleteLocationAction
{
    use AsAction;
    use Response;
    private $location;
    
    function __construct(LocationImplementation $locationImplementation)
    {
        $this->location = $locationImplementation;
    }

    public function handle(int $id)
    {
        return $this->location->delete($id);
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
    
            if(auth('sanctum')->check() &&  !auth('sanctum')->user()->has_permission('location.delete'))
            return $this->sendError('Forbidden',[],403);
            $this->handle($id);
            return $this->sendResponse(['Success'], 'location Deleted successfully.');
        
		}catch (\Exception $e) {
            return $this->sendError($e->getMessage());
			
		}
    }
}

