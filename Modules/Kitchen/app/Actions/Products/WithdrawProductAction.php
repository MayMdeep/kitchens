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

class WithdrawProductAction
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
            'location_qr_code ' => ['exists:locations,qr_code'],
            'product_id ' => ['exists:products,id'], // or maybe qr but using id is more efficent
            'quantity ' => ['required','numeric'],
        ];
    }

    public function asController(Request $request, int $id)
    {

        if(auth('sanctum')->check() &&  !auth('sanctum')->user()->has_permission('product.withdraw'))
            return $this->sendError('Forbidden',[],403);

        $product = $this->handle($request->all(), $id);

        return $this->sendResponse($product,'Updated Successfly');
    }
}