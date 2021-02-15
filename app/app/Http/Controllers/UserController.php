<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User as ModelUser;
use App\Http\Filter\UserTrait;
use Illuminate\Http\Request;
use App\Service\User;
use Throwable;

class UserController extends Controller
{
    use UserTrait;

    private $model;
    private $statusCode;
    public function __construct()
    {
        $this->model = new ModelUser();
        $this->statusCode = config('httpcode');
    }

    public function index(Request $request)
    {
        $users = (new User())->list();
        return view('user.list', ['users' => $users]);
    }

    public function new(Request $request)
    {
        return view('user.new');
    }

    public function view(int $id)
    {
        $user = (new User())->find($id);
        return view('user.edit',
            ['user' => $user]
        );
    }

    /**
     * New user
     *
     * @param  Request  $request
     * @return View
     */
    public function store(Request $request)
    {
        try {
            $params = $this->prepare($request);
            extract($params);

            $created = (new User($name, $email, $password))->new();
            $request->session()->flash('response', $created);
        } catch(Throwable $t) {
            $request->session()->flash('response', [
                'success' => false,
                'message' => 'Dados inválidos!',
            ]);
        }
        return $this->new($request);
    }

    /**
     * Update user
     *
     * @param  Request  $request
     * @return View
     */
    public function update(Request $request, int $id)
    {
        try {
            $params = $this->prepare($request);
            if (!$id) {
                throw 'dados inválidos';
            }

            $name = $params['name'] ?? '';
            $email = $params['email'] ?? '';
            $password = $params['password'] ?? '';

            $update = (
                new User($name, $email, $password)
            )->update($id);

            $request->session()->flash('response', $update);
        } catch(Throwable $t) {
            $request->session()->flash('response', [
                'success' => false,
                'message' => 'Dados inválidos!',
            ]);
        }

        return $this->view($id);
    }

    public function delete(Request $request)
    {
        try {
            $deleted = (new User())->delete($request->id);
            $request->session()->flash('response', $deleted);
        } catch(Throwable $t) {
            $request->session()->flash('response', [
                'success' => false,
                'message' => 'Dados inválidos!',
            ]);
        }

        return $this->index($request);
    }
}