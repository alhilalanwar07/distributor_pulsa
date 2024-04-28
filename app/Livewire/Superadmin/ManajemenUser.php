<?php

namespace App\Livewire\Superadmin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ManajemenUser extends Component
{
    use LivewireAlert;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';


    public $search;
    public $perPage = 10;

    public $role;
    public $name;
    public $email;
    public $password;

    protected $rules = [
        'role' => 'required',
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8',
    ];

    protected $users;

    public function render()
    {
        return view('livewire.superadmin.manajemen-user', [
            'users' => User::where('name', 'like', '%'.$this->search.'%')
                ->orWhere('email', 'like', '%'.$this->search.'%')
                ->paginate($this->perPage),
        ]);
    }

    public function store()
    {
        $this->validate();

        User::create([
            'role' => $this->role,
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

        $this->resetInput();
    }

    // test alert
    public function submit()
    {
        $this->alert('question', 'How are you today?');
    }
}
