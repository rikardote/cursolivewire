<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Component
{
    protected $rules = [
        'name' => 'required',
        'email' => 'required',
        'password' => 'required'
    ];
    use WithFileUploads;

    public $open = false;

    public $name, $email, $password, $identificador;

    public function mount(){
        $this->identificador = rand();
    }

    public function save(){

        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password)
        ]);

        $this->reset(['open', 'name', 'email', 'password']);

        $this->identificador = rand();

        $this->emitTo('show-users', 'render');
        $this->emit('alert', 'El usuario se creo satisfactoriamente');
    }

    public function render()
    {
        return view('livewire.users.create-user');
    }
}
