<?php
namespace Modules\Kitchen\App\Actions\Products;

use Hash;
use App\Traits\Response;
use Illuminate\Validation\Validator;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;
use App\Implementations\ProductImplementation;

class DeleteProductAction
{
    use AsAction;
    use Response;
    private $product;
    
    function __construct(ProductImplementation $productImplementation)
    {
        $this->product = $productImplementation;
    }

    public function handle(int $id)
    {
        return $this->product->delete($id);
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
    
            if(auth('sanctum')->check() &&  !auth('sanctum')->user()->has_permission('product.delete'))
            return $this->sendError('Forbidden',[],403);
            $this->handle($id);
            return $this->sendResponse(['Success'], 'product Deleted successfully.');
        
		}catch (\Exception $e) {
            return $this->sendError($e->getMessage());
			
		}
    }
}

