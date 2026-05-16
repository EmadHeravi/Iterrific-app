<?php

namespace App\Http\Livewire\ExampleLaravel;

use App\Models\User;
use Livewire\Component;

class UserProfile extends Component
{

    public User $user;
    public $first_name = '';
    public $last_name = '';
    public $email = '';
    public $phone_country_code = '';
    public $phone_number = '';
    public $personal_city = '';
    public $personal_country = '';
    public $about = '';

    protected function rules(){
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email,'.$this->user->id,
            'phone_country_code' => 'nullable|string|max:10',
            'phone_number' => 'nullable|string|max:25',
            'personal_city' => 'nullable|string|max:255',
            'personal_country' => 'nullable|string|max:255',
            'about' => 'nullable|string|max:150',
        ];
    }

    public function mount() { 
        $this->user = auth()->user();
        $this->first_name = $this->user->first_name;
        $this->last_name = $this->user->last_name;
        $this->email = $this->user->email;
        $this->phone_country_code = $this->user->phone_country_code;
        $this->phone_number = $this->user->phone_number;
        $this->personal_city = $this->user->personal_city;
        $this->personal_country = $this->user->personal_country;
        $this->about = $this->user->about;
    }

    public function updated($propertyName){

        $this->validateOnly($propertyName);
    }
    
    public function update()
    {
        $this->validate();

        if (env('IS_DEMO') && $this->user->id == 1){
            
            if( auth()->user()->email == $this->email ){
                
                $this->fillUser();
                $this->user->save();
                return back()->withStatus('Profile successfully updated.');
            }
            
            return back()->with('demo', "You are in a demo version, you can't change the admin email." );
        };

        $this->fillUser();
        $this->user->save();
        return back()->withStatus('Profile successfully updated.');
    
}

private function fillUser()
{
    $this->user->fill([
        'first_name' => $this->first_name,
        'last_name' => $this->last_name,
        'email' => $this->email,
        'phone_country_code' => $this->phone_country_code,
        'phone_number' => $this->phone_number,
        'personal_city' => $this->personal_city,
        'personal_country' => $this->personal_country,
        'about' => $this->about,
    ]);
}

public function render()
{
    return view('livewire.example-laravel.user-profile');
}

}
