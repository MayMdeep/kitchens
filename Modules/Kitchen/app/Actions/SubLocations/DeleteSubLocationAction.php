<?php
namespace Modules\Kitchen\App\Actions\SubLocations;

use Hash;
use App\Traits\Response;
use Illuminate\Validation\Validator;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;
use App\Implementations\SubLocationImplementation;

class DeleteSubLocationAction
{
    use AsAction;
    use Response;
    private $subLocation;
    
    function __construct(SubLocationImplementation $subLocationImplementation)
    {
        $this->subLocation = $subLocationImplementation;
    }

    public function handle(int $id)
    {
        return $this->subLocation->delete($id);
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
    
            if(auth('sanctum')->check() &&  !auth('sanctum')->user()->has_permission('subLocation.delete'))
            return $this->sendError('Forbidden',[],403);
            $this->handle($id);
            return $this->sendResponse(['Success'], 'subLocation Deleted successfully.');
        
		}catch (\Exception $e) {
            return $this->sendError($e->getMessage());
			
		}
    }
}

