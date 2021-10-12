<?php

namespace App\Http\Livewire\Admin\Appointments;

use App\Models\Client;
use Livewire\Component;
use App\Models\Appointment;
use Illuminate\Support\Facades\Validator;

class CreateAppointmentForm extends Component
{

   
    
    public $state = [
        'status' =>'SCHEDULED',
        
    ];

     




    public function createAppointment()
    {
        
        // validate
    //   dd($this->state);
        Validator::make($this->state, [
            'client_id' => 'required',
            'members' => 'required',
            'color' => 'required',
            'date' => 'required',
            'time' => 'required',
            'note' => 'required',
            'status' => 'required|in:SCHEDULED,CLOSED',
        ], ['client_id.required'=> 'The client field is required.'])->validate();
    
        Appointment::create($this->state);
        $this->state = [
            'client_id',
            'members',
            'date',
            'time',
            'note',
            'status',

        ];
        $this->dispatchBrowserevent('alert', ['message'=>'Appointment created successfully!']);
        
    }
    public function render()
    {

        $clients = Client::all();
        return view('livewire.admin.appointments.create-appointment-form', [
            'clients'=>$clients,
        ]);
    }
}
