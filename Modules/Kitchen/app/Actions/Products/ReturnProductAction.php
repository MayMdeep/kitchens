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

class ReturnProductAction
{
    use AsAction;
    use Response;
    private $product;
    
    function __construct(ProductImplementation $productImplementation)
    {
        $this->product = $productImplementation;
    }

    public function handle(array $data, int $id)
    {
        $product = $this->product->Update($data, $id);
        return new ProductResource($product);
    }
    public function rules(Request $request)
    {
        return [
            'name' => ['unique:products,name,'.$request->route('id')],
            'qr_code' => ['unique:products,qr_code,'.$request->route('id')],
        ];
    }
    public function withValidator(Validator $validator, ActionRequest $request)
    {
    }

    public function asController(Request $request, int $id)
    {

        if(auth('sanctum')->check() &&  !auth('sanctum')->user()->has_permission('product.edit'))
            return $this->sendError('Forbidden',[],403);

        $product = $this->handle($request->all(), $id);

        return $this->sendResponse($product,'Updated Successfly');
    }
}