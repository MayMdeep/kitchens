<?php
namespace Modules\Kitchen\App\Actions\ProductTransactions;

use Hash;
use App\Traits\Response;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Lorisleiva\Actions\ActionRequest;
use Modules\Kitchen\App\Models\Product;
use Lorisleiva\Actions\Concerns\AsAction;
use App\Http\Resources\ProductTransactionResource;
use App\Implementations\ProductTransactionImplementation;

class StoreProductTransactionAction
{
    use AsAction;
    use Response;

    private $productTransaction;

    function __construct(ProductTransactionImplementation $productTransactionImplementation)
    {
        $this->productTransaction = $productTransactionImplementation;
    }

    /**
     * Handle the creation of a new ProductTransaction.
     */
    public function handle(array $data)
    {
        $productTransaction = $this->productTransaction->Create($data);
        // Update the product quantity based on the transaction type
        // It should br a asepereate action or a queue worker but i dont have time
        $this->updateProductQuantity($data['product_id'], $data['location_id'], $data['quantity'], $data['transaction_type']);


        return new ProductTransactionResource($productTransaction);
    }
    public function rules()
    {
        return [
            'transaction_type' => ['required', 'in:withdraw,return'], // Must match valid transaction types
            'product_id' => ['required', 'exists:products,id'], // Ensure the product exists
            'location_id' => ['required', 'exists:locations,id'], // Ensure the location exists
            'quantity' => ['required', 'integer', 'min:1'], // Ensure valid quantity
            'notes' => ['nullable', 'string'], // Optional notes field
        ];
    }


 
    public function asController(Request $request)
    {
        if (auth('sanctum')->check() && !auth('sanctum')->user()->has_permission('productTransaction.add')) {
            return $this->sendError('Forbidden', [], 403);
        }

        $productTransaction = $this->handle($request->all());

        return $this->sendResponse($productTransaction, 'Product Transaction Added Successfully');
    }
// Handle the quantity update - it's a bad practice but i don't have time
    private function updateProductQuantity($productId, $locationId, $quantity, $transactionType)
    {
        // Determine the adjustment based on transaction type
        $adjustment = $transactionType === 'withdraw' ? -$quantity : $quantity;

        // Find the product and update the quantity
        Product::where('id', $productId)
            ->where('location_id', $locationId)
            ->increment('quantity', $adjustment);
    }
}