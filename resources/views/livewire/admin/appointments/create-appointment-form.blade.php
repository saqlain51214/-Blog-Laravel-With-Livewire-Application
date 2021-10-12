<div>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- <h1 class="m-0 text-dark">Appointments</h1> -->
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="">Appointments</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form wire:submit.prevent="createAppointment" autocomplete="off">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Add New Appointment</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="client">Client:</label>
                                            <select wire:model.defer="state.client_id"
                                                class="form-control @error('client_id') is-invalid @enderror">
                                                <option value="">Select Client</option>
                                                @foreach ($clients as $client)
                                                <option value="{{$client->id}}">{{$client->name}}</option>
                                                @endforeach

                                            </select>
                                            @error('client_id')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Select Team Members</label>
                                            <div
                                                class="@error('members') is-invalid border border-danger rounded  custom-error @enderror">
                                                <x-inputs.select2 wire:model="state.members" class="select2"
                                                    multiple="multiple" id="members" name="members"
                                                    data-placeholder="Select a Members" style="width: 100%;">
                                                    <option>Alabama</option>
                                                    <option>Alaska</option>
                                                    <option>California</option>
                                                    <option>Delaware</option>
                                                    <option>Tennessee</option>
                                                    <option>Texas</option>
                                                    <option>Washington</option>
                                                </x-inputs.select2>
                                            </div>
                                            @error('members')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Color Picker -->
                                <div class="form-group">
                                    <label>Color picker with addon:</label>

                                    <div class="input-group" id="colorPicker">
                                        <input type="text" name="color"
                                            class="form-control @error('color') is-invalid    @enderror">

                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-square"></i></span>
                                        </div>
                                        @error('color')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <!-- /.input group -->
                                </div>
                                <!-- /.form group -->

                                {{-- <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" wire:ignore.self>
                                            <label for="">Color Picker</label>
                                            <input wire:model.defer="state.color" type="text" name="" id="colorPicker" class="form-control @error('color') is-invalid    @enderror">
                                            @error('color')
                                            <div class="invalid-feedback">
                                                {{$message}}
                            </div>
                            @enderror
                        </div>

                </div>
            </div> --}}


            {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Select Other Option</label>
                                        <div class="@error('others') is-invalid border border-danger rounded  custom-error @enderror">
                                            <x-inputs.select2 wire:model="state.others" class="select2" multiple="multiple"
                                                id="others" name="others" data-placeholder="Other Option"
                                                style="width: 100%;">
                                                <option>Alabama</option>
                                                <option>Alaska</option>
                                                <option>California</option>
                                                <option>Delaware</option>
                                                <option>Tennessee</option>
                                                <option>Texas</option>
                                                <option>Washington</option>
                                            </x-inputs.select2>
                                            @error('others')
                                            <div class="invalid-feedback">
                                                {{$message}}
        </div>
        @enderror
    </div>
</div>
</div> --}}
{{-- <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Date:</label>
                                            <div class="input-group date" wire:ignore id="appointmentDate"
                                                data-target-input="nearest" data-appointmentdate="@this">
                                                <input type="text" class="form-control datetimepicker-input"
                                                    id="appointmentDateInput" data-target="#appointmentDate">
                                                <div class="input-group-append" data-target="#appointmentDate"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}


{{-- <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="appointmentStartTime">Appointment Start Time</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-clock"></i>
                                                        </span>
                                                    </div>
                                                    <x-timepicker wire:model.defer="state.appointment_start_time" id="appointmentStartTime"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="appointmentEndTime">Appointment End Time</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-clock"></i>
                                                        </span>
                                                    </div>
                                                    <x-timepicker wire:model.defer="state.appointment_end_time" id="appointmentEndTime"/>
                                                </div>
                                            </div>
                                        </div> --}}

<div class="col-md-6">
    <div class="form-group">
        <label for="appointmentDate">Appointment Date</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-calendar"></i>
                </span>
            </div>
            <x-datepicker wire:model.defer="state.date" id="appointmentDate" :error="'date'" />
            @error('date')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label for="appointmentTime">Appointment Time</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-clock"></i>
                </span>
            </div>
            <x-timepicker wire:model.defer="state.time" id="appointmentTime" :error="'date'" />
            @error('time')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>
</div>

{{-- <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="appointmentEndTime">Appointment End Time</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-clock"></i>
                                                        </span>
                                                    </div>
                                                    <x-timepicker wire:model.defer="state.appointment_end_time" id="appointmentEndTime"/>
                                                </div>
                                            </div>
                                        </div> --}}


{{-- 
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Appointment Time:</label>
                                            <div class="input-group date" wire:ignore id="appointmentTime"
                                                data-target-input="nearest" data-appointmenttime="@this">
                                                <input type="text" class="form-control datetimepicker-input"
                                                    id="appointmentTimeInput" data-target="#appointmentTime">
                                                <div class="input-group-append" data-target="#appointmentTime"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text">
                                                        <i class="far fa-clock"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Appointment End Time:</label>
                                            <div class="input-group date" wire:ignore id="appointmentTime"
                                                data-target-input="nearest" data-appointmenttime="@this">
                                                <input type="text" class="form-control datetimepicker-input"
                                                    id="appointmentTimeInput" data-target="#appointmentTime">
                                                <div class="input-group-append" data-target="#appointmentTime"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text">
                                                        <i class="far fa-clock"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group" wire:ignore>
            <label for="note">Note:</label>
            <textarea id="note" data-note="@this" wire:model.dafer="state.note"
                class="form-control @error('note') is-invalid @enderror"></textarea>
            @error('note')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="status">Status:</label>
            <select wire:model.defer="state.status" class="form-control @error('status') is-invalid @enderror">
                <option value="">Select Status</option>

                <option value="SCHEDULED">scheduled</option>
                <option value="CLOSED">close</option>


            </select>
            @error('status')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>
</div>
</div>
<div class="card-footer">
    <button type="button" class="btn btn-secondary"><i class="fa fa-times mr-1"></i>
        Cancel</button>
    <button type="submit" id="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>
        Save</button>
</div>
</div>
</form>
</div>
</div>
</div>
</div>

@push('js')
{{-- <script>
        $(document).ready(function () {
            $('#appointmentDate').datetimepicker({
                format: 'L',
            });


            $('#appointmentDate').on("change.datetimepicker", function (e) {
                let date = $(this).data('appointmentdate');
                eval(date).set('state.date', $('#appointmentDateInput').val());

                console.log(date);
            });

            $('#appointmentTime').datetimepicker({
                format: 'LT',
            });

            $('#appointmentTime').on("change.datetimepicker", function (e) {
                let time = $(this).data('appointmenttime');
                eval(time).set('state.time', $('#appointmentTimeInput').val());

                console.log(time);
            });

            $('#appointmentTime').on("change.datetimepicker", function (e) {
                let time = $(this).data('appointmenttime');
                eval(time).set('state.time', $('#appointmentTimeInput').val());

                console.log(time);
            });

        });

    </script>--}}

{{-- <script>

$(document).ready(function () {
            
            $('.select2').select2({
                    theme: 'bootstrap4',
                }).on('change', function(e){
                   let value = $(this).val();
                   console.log(value);
                   @this.set('state.members',value);
                    
                });

        });
     </script> --}}
<script src="https://cdn.ckeditor.com/ckeditor5/25.0.0/classic/ckeditor.js"></script>
<script>
    $('#colorPicker').colorpicker().on('change', function (event) {
        $('#colorPicker .fa-square').css('color', event.color.toString());
    })

</script>
<script>
    ClassicEditor.create(document.querySelector('#note'));
    $('form').submit(function () {
        @this.set('state.members', $('#members').val());
        @this.set('state.note', $('#note').val());
        @this.set('state.color', $('[name=color]').val());
    })

</script>



@endpush


</div>
