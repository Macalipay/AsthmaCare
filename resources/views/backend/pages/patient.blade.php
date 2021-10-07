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
                            <h5 class="card-title">Patient List
                                <button type="button" class="btn btn-primary add" data-toggle="modal" data-target="#defaultModalPrimary" style="float:right">
                                    Add Patient
                                </button>
                            </h5>
                        </div>
                        @include('backend.partials.flash-message')
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <table id="datatables" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Asthma Type</th>
                                                <th>Asthma Level</th>
                                                <th>Gender</th>
                                                <th>Age</th>
                                                <th>Contact #</th>
                                                <th>Email</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($patients as $key => $patient)
                                                <tr>
                                                    <td>{{ ++$key}}</td>
                                                    <td>{{ $patient->firstname . ' ' . $patient->middlename . ' ' . $patient->lastname}}</td>
                                                    <td>{{ $patient->asthma_id}}</td>
                                                    <td>{{ $patient->asthma_level}}</td>
                                                    <td>{{ $patient->gender}}</td>
                                                    <td>{{ $patient->age}}</td>
                                                    <td>{{ $patient->contact}}</td>
                                                    <td>{{ $patient->email}}</td>
                                                    <td class="table-action">
                                                        <a href="#" class="align-middle fas fa-fw fa-pen edit" title="Edit" data-toggle="modal" data-target="#defaultModalPrimary" id={{$patient->id}}></a>
                                                        <a href="{{url('patient/destroy/' . $patient->id)}}" onclick="alert('Are you sure you want to Delete?')"><i class="align-middle fas fa-fw fa-trash"></i></a>
                                                    </td>
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
        {{-- MODAL --}}
        <div class="modal fade" id="defaultModalPrimary" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Patient Record</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body m-3">
                        <form id="modal-form" action="{{url('patient/save')}}" method="post">
                            @csrf
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">First Name</label>
                            <input type="text" class="form-control" id="expense" name="expense" placeholder="First Name" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">Middle Name</label>
                            <input type="text" class="form-control" id="expense" name="expense" placeholder="Middle Name" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">Last Name</label>
                            <input type="text" class="form-control" id="expense" name="expense" placeholder="Last Name" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">Asthma Type</label>
                            <input type="text" class="form-control" id="expense" name="expense" placeholder="Asthma Type" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">Asthma Level</label>
                            <input type="text" class="form-control" id="expense" name="expense" placeholder="Asthma Level" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">Gender</label>
                            <input type="text" class="form-control" id="expense" name="expense" placeholder="Gender" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">Age</label>
                            <input type="text" class="form-control" id="expense" name="expense" placeholder="Age" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">Contact #</label>
                            <input type="text" class="form-control" id="expense" name="expense" placeholder="Contact #" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">Email</label>
                            <input type="text" class="form-control" id="expense" name="expense" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Add</button>
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
                "pageLength": 100
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