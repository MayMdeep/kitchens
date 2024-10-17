<?php
namespace Modules\Kitchen\App\Actions\ProductTransactions;
use Hash;
use App\Traits\Response;
use Illuminate\Validation\Validator;
use Lorisleiva\Actions\ActionRequest;
use App\Http\Resources\ProductTransactionResource;
use Lorisleiva\Actions\Concerns\AsAction;
use App\Implementations\ProductTransactionImplementation;

class GetProductTransactionAction
{
    use AsAction;
    use Response;
    private $productTransaction;
    
    function __construct(ProductTransactionImplementation $ProductTransactionImplementation)
    {
        $this->productTransaction = $ProductTransactionImplementation;
    }

    public function handle(int $id)
    {
        return new ProductTransactionResource($this->productTransaction->getOne($id));
    }
    public function rules()
    {
        return [];
    }
    public function withValidator(Validator $validator, ActionRequest $request){}

    public function asController(int $id)
    {
        if(auth('sanctum')->check() &&  !auth('sanctum')->user()->has_permission('productTransaction.get'))
            return $this->sendError('Forbidden',[],403);

        $record = $this->handle($id);

        return $this->sendResponse($record,'');
    }
}