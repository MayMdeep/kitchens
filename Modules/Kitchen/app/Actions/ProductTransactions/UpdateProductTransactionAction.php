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

class UpdateProductTransactionAction
{
    use AsAction;
    use Response;
    private $productTransaction;
    
    function __construct(ProductTransactionImplementation $productTransactionImplementation)
    {
        $this->productTransaction = $productTransactionImplementation;
    }

    public function handle(array $data, int $id)
    {
        $productTransaction = $this->productTransaction->Update($data, $id);
        return new ProductTransactionResource($productTransaction);
    }
    public function rules(Request $request)
    {
        return [
            'name' => ['unique:productTransactions,name,'.$request->route('id')],
            'qr_code' => ['unique:productTransactions,qr_code,'.$request->route('id')],
        ];
    }
    public function withValidator(Validator $validator, ActionRequest $request)
    {
    }

    public function asController(Request $request, int $id)
    {

        if(auth('sanctum')->check() &&  !auth('sanctum')->user()->has_permission('productTransaction.edit'))
            return $this->sendError('Forbidden',[],403);

        $productTransaction = $this->handle($request->all(), $id);

        return $this->sendResponse($productTransaction,'Updated Successfly');
    }
}