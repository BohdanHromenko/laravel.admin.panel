<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\AdminUserEditRequest;
use App\Models\Admin\User;
use App\Models\UserRole;
use App\Repositories\Admin\MainRepository;
use App\Repositories\Admin\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use MetaTag;

class UserController extends AdminBaseController
{

    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = app(UserRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $perpage = 8;
        $countUsers = MainRepository::getCountUsers();
        $paginator = $this->userRepository->getAllUsers($perpage);


        MetaTag::setTags(['title' => 'Users list']);
        return view('blog.admin.user.index', compact('countUsers', 'paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        MetaTag::setTags(['title' => 'Add user']);
        return view('blog.admin.user.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AdminUserEditRequest $request
     * @return Response
     */
    public function store(AdminUserEditRequest $request)
    {
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password'])
        ]);

        if (!$user) {
            return back()
                ->withErrors(['msg' => 'Creation Error'])
                ->withInput();
        } else {
            $role = UserRole::create([
                'user_id' => $user->id,
                'role_id' => (int)$request['role'],
            ]);
            if (!$role) {
                return back()
                    ->withErrors(['msg' => 'Creation Error'])
                    ->withInput();
            } else {
                return redirect()
                    ->route('blog.admin.users.index')
                    ->with(['success' => 'Saved successfully']);
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $perpage = 10;
        $item = $this->userRepository->getId($id);
        if (empty($item)) {
            abort(404);
        }

        $orders = $this->userRepository->getUserOrders($id, $perpage);
        $role = $this->userRepository->getUserRole($id);
        $count = $this->userRepository->getCountOrdersPag($id);
        $count_orders = $this->userRepository->getCountOrders($id, $perpage);

        MetaTag::setTags(['title' => "User edit № {$item->id}"]);
        return view('blog.admin.user.edit', compact(
            'item', 'orders', 'role', 'count', 'count_orders'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AdminUserEditRequest $request
     * @param User $user
     * @param UserRole $role
     * @return void
     */
    public function update(AdminUserEditRequest $request, User $user, UserRole $role)
    {
        $user->name = $request['name'];
        $user->email = $request['email'];
        $request['password'] == null ?: $user->password = bcrypt($request['password']);
        $save = $user->save();

        if (!$save) {
            return back()
                ->withErrors(['msg' => 'Save error'])
                ->withInput();
        } else {
            $role->where('user_id', $user->id)->update(['role_id' => (int)$request['role']]);
            return redirect()
                ->route('blog.admin.users.edit', $user->id)
                ->with(['success' => 'Save successfully']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return void
     */
    public function destroy(User $user)
    {
        $result = $user->forceDelete();
        if ($result) {
            return redirect()
                ->route('blog.admin.users.index')
                ->with(['success' => "User " . ucfirst($user->name) . " was deleted"]);
        } else {
            return back()->withErrors(['msg' => 'Error delete']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }
}
