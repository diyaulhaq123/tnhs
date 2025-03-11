<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use App\Mail\WelcomeEmail;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use App\Repositories\Admin\AdminRepository;
use App\Repositories\Member\MemberRepositoryInterface;

class RegisteredUserController extends Controller
{

    private $memberRepo;
    private $adminRepo;
    public function __construct(MemberRepositoryInterface $memberRepo, AdminRepository $adminRepo){
        $this->memberRepo = $memberRepo;
        $this->adminRepo = $adminRepo;
    }

    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $members = $this->memberRepo->getMemberTypes();
        return view('auth.register', compact('members'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'type' => ['required','integer'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'type' => $request->type,
            'password' => Hash::make($request->password),
        ]);
        $this->adminRepo->assignRoleToUser($user->id, 'member');
        Mail::to($request->email)->send(new WelcomeEmail($request->email, $request->name));

        event(new Registered($user));

        Auth::login($user);

        return redirect()->intended(route('dashboards'))->with('success','Registered Successfully');
    }
}
