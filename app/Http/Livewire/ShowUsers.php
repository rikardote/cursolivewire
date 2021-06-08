<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ShowUsers extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $user, $image, $identificador;
    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';
    public $open_edit = false;
    public $cant='';
    public $readyToLoad = false;

    protected $queryString = [
        'cant' => ['except' => '10'],
        'sort' => ['except' => 'id'],
        'direction' => ['except' => 'desc'],
        'search' => ['except' => '']
    ];

    protected $rules = [
        'user.name' => 'required',
        'user.email' => 'required',
        'user.password' => 'required'
    ];

    protected $listeners = ['render', 'delete'];

    public function mount(){
        $this->identificador = rand();
        $this->user = new User();
    }

    public function render()
    {

        if ($this->readyToLoad) {
            $users = User::where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orderBy($this->sort, $this->direction)
                    ->paginate($this->cant);
        }else{
            $users= [];
        }

        return view('livewire.users.show-users', compact('users'));
    }
    public function loadPost(){
        $this->readyToLoad = true;
    }

    public function order($sort){

        if ($this->sort == $sort) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }


        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }



    }

    public function updatingSearch(){
        $this->resetPage();
    }

    public function edit(User $user){
        $this->user = $user;
        $this->open_edit = true;
    }

    public function update(){
        $this->validate();

        $this->user->save();

        $this->reset(['open_edit']);
        $this->identificador = rand();

        $this->emit('alert', 'El usuario se actualizo satisfactoriamente');
    }

    public function delete(User $user){
        $user->delete();
    }
}
