<?php
namespace App\Actions\Auth\User;
use App\Implementations\UserImplementation;
use App\Traits\Response;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class UserRegisterAction
{
    use AsAction;
    use Response;
    private $user;

    function __construct(UserImplementation $UserImplementation)
    {
        $this->user = $UserImplementation;
    }

    public function handle(array $data)
    {
       $user = $this->user->Create($data);
        return $user;
    }
    public function rules()
    {
        return [
            'name' => ['required', 'unique:users,name'],
            'email' => ['required', 'unique:users,email'],
            'password' => ['required','min:8'],
            'role_id' => ['required'],
        ];
    }
    public function withValidator(Validator $validator, ActionRequest $request)
    {
    }

    public function asController(Request $request)
    {
        $user = $this->handle($request->all());

        return $this->sendResponse($user, '');
    }
}
