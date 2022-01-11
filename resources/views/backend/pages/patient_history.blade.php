@extends('backend.master.template')
@section('content')
    <main class="content">
        <div class="container-fluid">
            <div class="header">
                <h1 class="header-title">
                    Patient Record
                </h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Patient History</h5>
                        </div>
                        @include('backend.partials.flash-message')
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h3 id="fullname">Name: {{$patient->firstname . ' ' . $patient->lastname}} </h3>
                                        </div>
                                        <div class="col-md-4">
                                            <h3 for="" style="float: right">Email: {{$patient->email}} </h3>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <h3 for="">Type of Asthma: {{$patient->asthma->asthma}} </h3>
                                        </div>
                                        <div class="col-md-4">
                                            <h3 for="" style="float: right">Asthma Level: {{$patient->level}} </h3>
                                        </div>
                                    </div>

                                    <table id="datatables" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Doctor</th>
                                                <th>Patient Remarks</th>
                                                <th>Doctor Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($appointments as $key => $appointment)
                                                <tr>
                                                    <td>{{ ++$key}}</td>
                                                    <td>{{ $appointment->date}}</td>
                                                    <td>{{ $appointment->time}}</td>
                                                    <td>{{ $appointment->doctor->firstname . ' ' . $appointment->doctor->lastname}}</td>
                                                    <td>{{ $appointment->patient_remarks}}</td>
                                                    <td>{{ $appointment->doctor_remarks}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
    </main>
@endsection

@section('scripts')
    <script>
        function edit(id){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/patient/edit/' + id,
                method: 'get',
                data: {

                },
                success: function(data) {
                    $('.modal-title').text('Update Patient Record');
                    $('.submit-button').text('Update');
                        $.each(data, function() {
                            $.each(this, function(k, v) {
                               $('[name ="'+k+'"]').val(v);
                            });
                        });
                    $('#modal-form').attr('action', 'patient/update/' + data.patient.id);
                }
            });

        }

        $(function() {
            $('#datatables').DataTable({
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                {
                extend: ['print'], 
                title: $('#fullname').text() + ' History',
                        customize: function ( win ) {
                            $(win.document.body)
                                .css( 'font-size', '10pt' )
                                .prepend(
                                    '<img src="{!! asset("/img/logo.png") !!}" style="width:200px; height:200px; top:80; right:80; float:right" />'
                                );
        
                            $(win.document.body).find( 'table' )
                                .addClass( 'compact' )
                                .css( 'font-size', 'inherit' );
                        }
                    }
                ],
            });

            $( "table" ).on( "click", ".edit", function() {
                edit(this.id);
            });

            $('.add').click(function(){
                $('.modal-title').text('Add Patient Record');
                $('.submit-button').text('Add');
                $('#modal-form').attr('action', 'patient/save');
            })
        });
    </script>
@endsection