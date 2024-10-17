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

class StoreProductAction
{
    use AsAction;
    use Response;
    private $product;
    
    function __construct(ProductImplementation $productImplementation)
    {
        $this->product = $productImplementation;
    }

    public function handle(array $data)
    {

        $product = $this->product->create($data);
        $product['alert_quantity'] = 0;
        return new ProductResource($product);
    }
    public function rules()
    {
        return [
            'name' => ['required','unique:products,name'],
            'location_id' => ['required','exists:locations,id'],
            'sub_location_id' => ['required','exists:sublocations,id'],
            'quantity' => ['required','integer' ,'min:1'],
            'expiry_date' => ['required'],
            'production_date' => ['required'],
            'status' => ['required'],
            'qr_code' => ['required'],
            'ingredients' => ['required'],
        ];
    }
    public function withValidator(Validator $validator, ActionRequest $request)
    {
    }

    public function asController(Request $request)
    {
        if(auth('sanctum')->check() &&  !auth('sanctum')->user()->has_permission('product.add'))
            return $this->sendError('Forbidden',[],403);

        $product = $this->handle($request->all());

        return $this->sendResponse($product,' Product Added Successfully');
    }
}