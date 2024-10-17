<?php
namespace Modules\Kitchen\App\Actions\Products;
use Hash;
use App\Traits\Response;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Lorisleiva\Actions\ActionRequest;
use App\Http\Resources\ProductResource;
use Lorisleiva\Actions\Concerns\AsAction;
use App\Implementations\ProductImplementation;
class GetProductListAction
{
    use AsAction;
    use Response;
    private $product;
    
    function __construct(ProductImplementation $productImplementation)
    {
        $this->product = $productImplementation;
    }

    public function handle(array $data = [], int $perPage = 10)
    {
        if (!is_numeric($perPage))
            $perPage = 10;
        
        return ProductResource::collection($this->product->getPaginatedList($data, $perPage));
    }
    public function rules()
    {
        return [];
    }
    public function withValidator(Validator $validator, ActionRequest $request){}

    public function asController(Request $request)
    {
       if(auth('sanctum')->check() &&  !auth('sanctum')->user()->has_permission('product.get'))
           return $this->sendError('Forbidden',[],403);

        $list = $this->handle($request->all(),  $request->input('results', 10));
        
        return $this->sendPaginatedResponse($list,'');
    }
}