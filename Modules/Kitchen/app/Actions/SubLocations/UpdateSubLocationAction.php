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

class UpdateSubLocationAction
{
    use AsAction;
    use Response;
    private $subLocation;
    
    function __construct(SubLocationImplementation $subLocationImplementation)
    {
        $this->subLocation = $subLocationImplementation;
    }

    public function handle(array $data, int $id)
    {
        $subLocation = $this->subLocation->Update($data, $id);
        return new SubLocationResource($subLocation);
    }
    public function rules(Request $request)
    {
        return [
            'name' => ['unique:subLocations,name,'.$request->route('id')],
            'qr_code' => ['unique:subLocations,qr_code,'.$request->route('id')],
        ];
    }
    public function withValidator(Validator $validator, ActionRequest $request)
    {
    }

    public function asController(Request $request, int $id)
    {

        if(auth('sanctum')->check() &&  !auth('sanctum')->user()->has_permission('subLocation.edit'))
            return $this->sendError('Forbidden',[],403);

        $subLocation = $this->handle($request->all(), $id);

        return $this->sendResponse($subLocation,'Updated Successfly');
    }
}