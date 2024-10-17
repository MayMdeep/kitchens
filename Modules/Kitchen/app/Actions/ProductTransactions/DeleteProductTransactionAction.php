<?php
namespace Modules\Kitchen\App\Actions\ProductTransactions;

use Hash;
use App\Traits\Response;
use Illuminate\Validation\Validator;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;
use App\Implementations\ProductTransactionImplementation;

class DeleteProductTransactionAction
{
    use AsAction;
    use Response;
    private $productTransaction;
    
    function __construct(ProductTransactionImplementation $productTransactionImplementation)
    {
        $this->productTransaction = $productTransactionImplementation;
    }

    public function handle(int $id)
    {
        return $this->productTransaction->delete($id);
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
    
            if(auth('sanctum')->check() &&  !auth('sanctum')->user()->has_permission('productTransaction.delete'))
            return $this->sendError('Forbidden',[],403);
            $this->handle($id);
            return $this->sendResponse(['Success'], 'productTransaction Deleted successfully.');
        
		}catch (\Exception $e) {
            return $this->sendError($e->getMessage());
			
		}
    }
}

