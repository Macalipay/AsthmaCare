@extends('backend.master.template')
@section('content')
    <main class="content">
        <div class="container-fluid">
            <div class="header">
                <h1 class="header-title">
                    Appointment
                </h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Record List
                                <button appointment="button" class="btn btn-primary add ml-2" data-toggle="modal" data-target="#blockAppointmentModal" style="float:right">
                                    Block Schedule
                                </button> 
                            </h5>
                        </div>
                        @include('backend.partials.flash-message')
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div id='calendar'></div>
                                    {{-- {!! $calendar->calendar() !!} --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="modal fade" id="confirmation" tabindex="-1" role="dialog" aria-labelledby="confirmationLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        Are you sure you want to delete this data?
                    </div>
                    <div class="modal-footer">
                    <button appointment="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button appointment="button" class="btn btn-primary" onclick="confirmDelete(delete_id)">Yes</button>
                    </div>
                </div>
                </div>
            </div>
        </div>
        {{-- MODAL --}}
        <div class="modal fade" id="blockAppointmentModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Appointment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body m-3">
                        <form id="modal-form" action="{{url('appointment/save')}}" method="post">
                            @csrf
                        <div class="form-group col-md-12">
                            <label for="name">Full Name</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="name">Date</label>
                            <input type="text" class="form-control" id="date" name="date" placeholder="">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="name">Time</label>
                            <input type="text" class="form-control" id="time" name="time" placeholder="">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="name">Patient Remarks</label>
                            <input type="text" class="form-control" id="patient_remarks" name="patient_remarks" placeholder="">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="name">Doctor Remarks</label>
                            <input type="text" class="form-control" id="patient_remarks" name="patient_remarks" placeholder="">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="name">Zoom Links</label>
                            <input type="text" class="form-control" id="link" name="link" placeholder="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger cancel-button">Cancel</button>
                        <button type="button" class="btn btn-primary completed-button">Done Check Up</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

         {{-- MODAL --}}
         <div class="modal fade" id="defaultModalPrimary" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Appointment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body m-3">
                        <form id="modal-form" action="{{url('appointment/save')}}" method="post">
                            @csrf
                        <div class="form-group col-md-12">
                            <label for="name">Full Name</label>
                            <input type="hidden" class="form-control" id="appointment_id" name="appointment_id" placeholder="" >
                            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="" readonly>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="name">Date</label>
                            <input type="text" class="form-control" id="date" name="date" placeholder="" readonly>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="name">Time</label>
                            <input type="text" class="form-control" id="time" name="time" placeholder="" readonly>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="name">Patient Remarks</label>
                            <input type="text" class="form-control" id="patient_remarks" name="patient_remarks" placeholder="" readonly>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="name">Doctor Remarks</label>
                            <input type="text" class="form-control" id="patient_remarks" name="patient_remarks" placeholder="" readonly>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="name">Zoom Links</label>
                            <input type="text" class="form-control" id="link" name="link" placeholder="" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger cancel-button">Cancel</button>
                        <button type="button" class="btn btn-primary completed-button">Done Check Up</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    
    <script>
        var delete_id = '';
        var SITEURL = "{{ url('/appointment') }}";
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function edit(id){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/appointment/edit/' + id,
                method: 'get',
                data: {

                },
                success: function(data) {
                    $('#defaultModalPrimary').modal('toggle');
                    $('.modal-title').text('View Appointment');
                       var name = data.appointments.patient;
                       $('#appointment_id').val(data.appointments.id)
                        $.each(data, function() {
                            $.each(this, function(k, v) {
                                if(k == 'patient_id') {
                                    $('#fullname').val(name.firstname + ' ' + name.middlename + ' ' + name.lastname);
                                } else {
                                    $('[name ="'+k+'"]').val(v);
                                }
                            });
                        });
                }
            });
        }

        function cancel(id){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/appointment/cancel/' + id,
                method: 'get',
                success: function(data) {
                    location.reload();
                }
            });

        }

        function completed(id){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/appointment/completed/' + id,
                method: 'get',
                success: function(data) {
                    location.reload();
                }
            });

        }


        $(function() {
            var calendar = $('#calendar').fullCalendar({
                    editable: true,
                    events: SITEURL + "/",
                    displayEventTime: false,
                    editable: true,
                    eventRender: function (event, element, view) {
                        if (event.allDay === 'true') {
                                event.allDay = true;
                        } else {
                                event.allDay = false;
                        }
                    },
                    selectable: true,
                    selectHelper: true,
                    select: function (start, end, allDay) {
                        
                    },
                    eventDrop: function (event, delta) {
                       
                    },
                    eventClick: function (event) {
                        edit(event.id);
                    }
 
                });
 
            $('#datatables').DataTable({
                responsive: true,
                "pageLength": 100
            });

            $( "table" ).on( "click", ".edit", function() {
                edit(this.id);
            });

            $('.add').click(function(){
                $('.modal-title').text('Add Appointment');
                $('.submit-button').text('Add');
                $('#modal-form').attr('action', 'asthma/save');
            })

            $('.cancel-button').click(function(){
                cancel($('#appointment_id').val());
            })

            $('.completed-button').click(function(){
                completed($('#appointment_id').val());
            })
            
            function displayMessage(message) {
                toastr.success(message, 'Event');
            } 
        });

        function confirmDelete(id) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/asthma/destroy/' + id,
                method: 'get',
                data: {
                },
                success: function(data) {
                    location.reload();
                }
            });
        }
    </script>
@endsection