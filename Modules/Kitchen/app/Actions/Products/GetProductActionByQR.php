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

class GetProductActionByQR
{
    use AsAction;
    use Response;
    private $product;
    
    function __construct(ProductImplementation $ProductImplementation)
    {
        $this->product = $ProductImplementation;
    }

    public function handle(array $data)
    {
        return new ProductResource($this->product->getList(['qr_code'=> $data['qr_code']] )->first());
    }
    public function rules()
    {
        return [
            'qr_code'=> ['required' , 'exists:products,qr_code']
        ];
    }
    public function withValidator(Validator $validator, ActionRequest $request){}

    public function asController(Request $request)
    {
        if(auth('sanctum')->check() &&  !auth('sanctum')->user()->has_permission('product.get'))
            return $this->sendError('Forbidden',[],403);

        $record = $this->handle($request->all());

        return $this->sendResponse($record,'');
    }
}