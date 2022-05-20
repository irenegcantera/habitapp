<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;

class Avatar extends Component
{
    public $user_id;
    public $avatar;

    public function render()
    {
        return view('usuario.config');
    }

    public function update()
    {
        if ($this->user_id) {
            $user = User::find($this->user_id);
            $user->update([
                'avatar' => $this->avatar,
            ]);
            $this->updateMode = false;
            session()->flash('message', 'Users Updated Successfully.');
            $this->resetInputFields();
        }
    }
}
