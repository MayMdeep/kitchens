<?php
namespace Modules\Kitchen\App\Actions\Products;
use Hash;
use App\Traits\Response;
use Illuminate\Validation\Validator;
use Lorisleiva\Actions\ActionRequest;
use App\Http\Resources\ProductResource;
use Lorisleiva\Actions\Concerns\AsAction;
use App\Implementations\ProductImplementation;

class GetProductAction
{
    use AsAction;
    use Response;
    private $product;
    
    function __construct(ProductImplementation $ProductImplementation)
    {
        $this->product = $ProductImplementation;
    }

    public function handle(int $id)
    {
        return new ProductResource($this->product->getOne($id));
    }
    public function rules()
    {
        return [];
    }
    public function withValidator(Validator $validator, ActionRequest $request){}

    public function asController(int $id)
    {
        if(auth('sanctum')->check() &&  !auth('sanctum')->user()->has_permission('product.get'))
            return $this->sendError('Forbidden',[],403);

        $record = $this->handle($id);

        return $this->sendResponse($record,'');
    }
}