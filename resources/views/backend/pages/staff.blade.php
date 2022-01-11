@extends('backend.master.template')
@section('content')
    <main class="content">
        <div class="container-fluid">
            <div class="header">
                <h1 class="header-title">
                    Staff
                </h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Staff List
                                <button type="button" class="btn btn-primary add" data-toggle="modal" data-target="#defaultModalPrimary" style="float:right">
                                    Add Staff
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
                                                <th>Email</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($staff as $key => $item)
                                                <tr>
                                                    <td>{{ ++$key}}</td>
                                                    <td>{{ $item->firstname.' '.$item->lastname}}</td>
                                                    <td>{{ $item->gender}}</td>
                                                    <td>{{ $item->birthday}}</td>
                                                    <td>{{ $item->contact_no}}</td>
                                                    <td>{{ $item->city}}</td>
                                                    <td>{{ $item->username}}</td>
                                                    <td>{{ $item->email}}</td>
                                                    <td class="table-action">
                                                        <a href="#" class="align-middle fas fa-fw fa-pen edit" title="Edit" data-toggle="modal" data-target="#defaultModalPrimary" id={{$item->id}}></a>
                                                        <a href="#" data-toggle="modal" data-target="#confirmation" onclick="delete_id={{$item->id}};"><i class="align-middle fas fa-fw fa-trash"></i></a>
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
            
        </div>
        {{-- MODAL --}}
        <div class="modal fade" id="defaultModalPrimary" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Staff</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body m-3">
                        <form id="modal-form" action="{{url('staff/save')}}" method="post">
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
                            <input type="text" class="form-control" id="contact_no" name="contact_no" placeholder="" value="{{ old('contact_no') }}" required>
                        </div>
                        @if (Auth::user()->roles->first()->name == 'Staff')
                            <input type="text" class="form-control" id="company_id" name="company_id" placeholder="" value="{{Auth::user()->company_id}}" hidden>
                        @else
                            <div class="form-group col-md-12">
                                <label for="name">Company</label>
                                <select class="form-control" name="company_id" id="company_id" required>
                                    <option value="">Please Select Company</option>
                                    @foreach($company as $item)
                                        <option value="{{$item->id}}">{{$item->company_name.' - '.$item->city}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        
                        <div class="form-group col-md-12">
                            <label for="name">City</label>
                            <input type="text" class="form-control" id="city" name="city" placeholder="" value="{{ old('city') }}" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="name">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="" value="{{ old('username') }}" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="name">Email Address</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="" value="{{ old('email') }}" required>
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

        function edit(id){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/staff/edit/' + id,
                method: 'get',
                data: {

                },
                success: function(data) {
                    $('.modal-title').text('Update Staff');
                    $('.submit-button').text('Update');
                    $.each(data, function() {
                        $.each(this, function(k, v) {
                            $('[name ="'+k+'"]').val(v);
                        });
                    });
                    $('#modal-form').attr('action', '/staff/update/' + id);
                    console.log(data);
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
                title: 'Staff List',
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
                $('.modal-title').text('Add Staff');
                $('.submit-button').text('Add');
                $('#modal-form').attr('action', 'staff/save');
            })
        });

        function confirmDelete(id) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/staff/destroy/' + id,
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