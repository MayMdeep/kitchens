<?php
namespace Modules\Kitchen\App\Actions\ProductTransactions;
use Hash;
use App\Traits\Response;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Lorisleiva\Actions\ActionRequest;
use App\Http\Resources\ProductTransactionResource;
use Lorisleiva\Actions\Concerns\AsAction;
use App\Implementations\ProductTransactionImplementation;
class GetProductTransactionListAction
{
    use AsAction;
    use Response;
    private $productTransaction;
    
    function __construct(ProductTransactionImplementation $productTransactionImplementation)
    {
        $this->productTransaction = $productTransactionImplementation;
    }

    public function handle(array $data = [], int $perPage = 10)
    {
        if (!is_numeric($perPage))
            $perPage = 10;
        
        return ProductTransactionResource::collection($this->productTransaction->getPaginatedList($data, $perPage));
    }
    public function rules()
    {
        return [];
    }
    public function withValidator(Validator $validator, ActionRequest $request){}

    public function asController(Request $request)
    {
       if(auth('sanctum')->check() &&  !auth('sanctum')->user()->has_permission('productTransaction.get'))
           return $this->sendError('Forbidden',[],403);

        $list = $this->handle($request->all(),  $request->input('results', 10));
        
        return $this->sendPaginatedResponse($list,'');
    }
}