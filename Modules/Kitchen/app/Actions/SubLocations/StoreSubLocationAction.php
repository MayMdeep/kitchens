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

class StoreSubLocationAction
{
    use AsAction;
    use Response;
    private $subLocation;
    
    function __construct(SubLocationImplementation $subLocationImplementation)
    {
        $this->subLocation = $subLocationImplementation;
    }

    public function handle(array $data)
    {

        $subLocation = $this->subLocation->create($data);

        return new SubLocationResource($subLocation);
    }
    public function rules()
    {
        return [
            'name' => ['required','unique:sublocations,name'],
            'location_id' => ['required','exists:locations,id'],
            'status' => ['required'],
        ];
    }
    public function withValidator(Validator $validator, ActionRequest $request)
    {
    }

    public function asController(Request $request)
    {
        if(auth('sanctum')->check() &&  !auth('sanctum')->user()->has_permission('subLocation.add'))
            return $this->sendError('Forbidden',[],403);

        $subLocation = $this->handle($request->all());

        return $this->sendResponse($subLocation,' SubLocation Added Successfully');
    }
}