<?php

namespace App\Http\Livewire\Admin\Appointments;

use App\Models\Client;
use Livewire\Component;
use App\Models\Appointment;
use Illuminate\Support\Facades\Validator;

class UpdateAppointmentForm extends Component
{

    public $state = [];
    public $appointment;

    public function mount(Appointment $appointment = null)
    {
        $this->state = $appointment->toArray();
        $this->appointment = $appointment;
    }

    public function updateAppointment()
    {
         // validate
         Validator::make($this->state, [
            'client_id' => 'required',
            'date' => 'required',
            'time' => 'required',
            'note' => 'required',
            'status' => 'required|in:SCHEDULED,CLOSED',
        ], ['client_id.required'=> 'The client field is required.'])->validate();
    
        $this->appointment->update($this->state);
        
        $this->dispatchBrowserevent('alert', ['message'=>'Appointment updated successfully!']);
    }
    public function render()
    {
        $clients = Client::all();
        return view('livewire.admin.appointments.update-appointment-form',[
            'clients'=> $clients,
        ]);
    }
}
