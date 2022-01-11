@extends('backend.master.template')
@section('content')
    <main class="content">
        <div class="container-fluid">
            <div class="header">
                <h1 class="header-title">
                    Doctors
                </h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Doctor List
                                <button type="button" class="btn btn-primary add" data-toggle="modal" data-target="#defaultModalPrimary" style="float:right">
                                    Add Doctors
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
                                                <th>Gender</th>
                                                <th>Birthday</th>
                                                <th>Contact No</th>
                                                <th>City</th>
                                                <th>Username</th>
                                                <th>License No.</th>
                                                <th>Email</th>
                                                <th>Photo</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($doctors as $key => $doctor)
                                                <tr>
                                                    <td>{{ ++$key}}</td>
                                                    <td>{{ $doctor->firstname.' '.$doctor->lastname}}</td>
                                                    <td>{{ $doctor->gender}}</td>
                                                    <td>{{ $doctor->birthday}}</td>
                                                    <td>{{ $doctor->contact_no}}</td>
                                                    <td>{{ $doctor->city}}</td>
                                                    <td>{{ $doctor->username}}</td>
                                                    <td>{{ $doctor->license}}</td>
                                                    <td>{{ $doctor->email}}</td>
                                                    <td width="400px"> <img src="{{ asset('img/doctor/' . $doctor->photo)}}" alt="No Photo" srcset="" style="width:30%; height:30%"> </td>
                                                    <td class="table-action">
                                                        <a href="#" class="align-middle fas fa-fw fa-pen edit" title="Edit" data-toggle="modal" data-target="#defaultModalPrimary" id={{$doctor->id}}></a>
                                                        <a href="#" data-toggle="modal" data-target="#confirmation" onclick="delete_id={{$doctor->id}};"><i class="align-middle fas fa-fw fa-trash"></i></a>
                                                        <a href="#" class="align-middle fas fa-fw fa-calendar schedule" title="Add Schedule" data-toggle="modal" data-target="#addSchedule" onclick="showSchedule({{$doctor->id}})"></a>
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
            
            <div class="modal fade" id="confirmation" tabindex="-1" role="dialog" aria-labelledby="confirmationLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        Are you sure you want to delete this data?
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary" onclick="confirmDelete(delete_id)">Yes</button>
                    </div>
                </div>
                </div>
            </div>
            
            <div class="modal fade" id="addSchedule" tabindex="-1" role="dialog" aria-labelledby="confirmationLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Doctor Schedule</h5>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Day</label>
                                <select name="day" id="day" class="form-control">
                                    <option value="">Please Select Day</option>
                                    <option value="Sunday">Sunday</option>
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="">Please Select Day</option>
                                    <option value="0">Present</option>
                                    <option value="1">Day off</option>
                                </select>
                            </div>
                            
                            <table id="schedule" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Day</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary" onclick="setSchedule()">Set Schedule</button>
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
                        <h5 class="modal-title">Add Doctor</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body m-3">
                        <form id="modal-form" action="{{url('doctors/save')}}" method="post" enctype="multipart/form-data">
                            @csrf
                        <div class="form-group col-md-12">
                            <label for="name">Firstname</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="" value="{{ old('firstname') }}" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="name">Middlename</label>
                            <input type="text" class="form-control" id="middlename" name="middlename" placeholder="" value="{{ old('middlename') }}" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="name">Lastname</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="" value="{{ old('lastname') }}" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="name">Gender</label>
                            <select class="form-control" name="gender" id="gender" required>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="name">Birthday</label>
                            <input type="date" class="form-control" id="birthday" name="birthday" placeholder="" value="{{ old('birthday') }}" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="name">Contact No</label>
                            <input type="number" class="form-control" id="contact_no" name="contact_no" placeholder="" value="{{ old('contact_no') }}" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="name">Company</label>
                            <select class="form-control" name="company_id" id="company_id" required>
                                <option value="">Please Select Company</option>
                                @foreach($company as $item)
                                    <option value="{{$item->id}}">{{$item->company_name.' - '.$item->city}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="name">City</label>
                            <input type="text" class="form-control" id="city" name="city" placeholder="" value="{{ old('city') }}" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="name">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="" value="{{ old('username') }}" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="name">License Number</label>
                            <input type="text" class="form-control" id="license" name="license" placeholder="" value="{{ old('license') }}" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="name">Email Address</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="" value="{{ old('email') }}" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="name">Photo</label>
                            <input type="file" class="form-control" id="photo" name="photo" placeholder="" value="{{ old('photo') }}" required>
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
    <script>
        var delete_id = '';
        var doctor_id = '';

        function edit(id){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/doctors/edit/' + id,
                method: 'get',
                data: {

                },
                success: function(data) {
                    $('.modal-title').text('Update Doctor');
                    $('.submit-button').text('Update');
                    $.each(data, function() {
                        $.each(this, function(k, v) {
                            $('[name ="'+k+'"]').val(v);
                        });
                    });
                    console.log(data);
                    $('#modal-form').attr('action', 'doctors/update/' + data.doctor.id);
                }
            });

        }

        $(function() {
            $('#datatables').DataTable({
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf',
                {
                extend: ['print'], 
                title: 'Doctors List',
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
                $('.modal-title').text('Add Doctor');
                $('.submit-button').text('Add');
                $('#modal-form').attr('action', 'doctors/save');
            })
        });

        function confirmDelete(id) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/doctors/destroy/' + id,
                method: 'get',
                data: {
                },
                success: function(data) {
                    location.reload();
                }
            });
        }

        function setSchedule() {
            $.post('/doctors/save-schedule', { "_token": "{{ csrf_token() }}", "doctor_id": doctor_id, "day": $('#day').val(), "status": $('#status').val() }, function(response) {
                location.reload();
            });
        }

        function showSchedule(id) {
            doctor_id = id;
            
            $.post('/doctors/get-schedule', { "_token": "{{ csrf_token() }}", "doctor_id": doctor_id }, function(response) {
                var html = "";
                $.each(response, function(index, val) {
                    console.log(val);
                    html += "<tr>";
                    html += "<td>"+index+"</td>";
                    html += "<td>"+val.day+"</td>";
                    if(val.status === "0"){
                        html += "<td>Present</td>";
                    }
                    else {
                        html += "<td>Day off</td>";
                    }
                    html += "</tr>";
                });
                $('#schedule tbody').html(html);
            });
        }
    </script>
@endsection