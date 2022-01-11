@extends('backend.master.template')
@section('content')
    <main class="content">
        <div class="container-fluid">
            <div class="header">
                <h1 class="header-title">
                    Types of Company
                </h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Record List</h5>
                            <button type="button" class="btn btn-primary add" data-toggle="modal" data-target="#defaultModalPrimary" style="float:right">
                                Add Clinic
                            </button>
                        </div>
                        @include('backend.partials.flash-message')
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <table id="datatables" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Company Name</th>
                                                <th>Address</th>
                                                <th>Contact</th>
                                                <th>City</th>
                                                <th>Status</th>
                                                <th>Permit</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($companies as $key => $company)
                                                <tr>
                                                    <td>{{ ++$key}}</td>
                                                    <td>{{ $company->company_name}}</td>
                                                    <td>{{ $company->address}}</td>
                                                    <td>{{ $company->contact}}</td>
                                                    <td>{{ $company->city}}</td>
                                                    @if ($company->status == 0)
                                                        <td>Active</td>
                                                    @else
                                                        <td>Inactive</td>
                                                    @endif
                                                    <td width="400px"> <img src="{{ asset('img/permit/' . $company->photo)}}" alt="No Permit" srcset="" style="width:10%; height:10%"> </td>
                                                    <td class="table-action">
                                                        <a href="#" class="align-middle fas fa-fw fa-pen edit" title="Edit" data-toggle="modal" data-target="#defaultModalPrimary" id={{$company->id}}></a>
                                                        <a href="#" data-toggle="modal" data-target="#confirmation" onclick="delete_id={{$company->id}};"><i class="align-middle fas fa-fw fa-trash"></i></a>
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
                    <button company="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button company="button" class="btn btn-primary" onclick="confirmDelete(delete_id)">Yes</button>
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
                        <h5 class="modal-title">Add Type</h5>
                        <button company="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body m-3">
                        <form method="POST" action="{{url('company/save')}}" enctype="multipart/form-data">
                            @csrf
                            <h5>Administrator Information</h5>
    
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">First Name</label>
    
                                <div class="col-md-6">
                                    <input id="firstname" type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Middle Name</label>
    
                                <div class="col-md-6">
                                    <input id="middlename" type="text" class="form-control" name="middlename" value="{{ old('middlename') }}" required autocomplete="middlename" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Last Name</label>
    
                                <div class="col-md-6">
                                    <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
    
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email">
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
    
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
    
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <h5>Clinic/Hospital Information</h5>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Clinic/Hospital Name</label>
    
                                <div class="col-md-6">
                                    <input id="company_name" type="text" class="form-control" name="company_name" value="{{ old('company_name') }}" required autocomplete="company_name" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Address</label>
    
                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Contact</label>
    
                                <div class="col-md-6">
                                    <input id="contact" type="text" class="form-control" name="contact" value="{{ old('contact') }}" required autocomplete="contact" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">City</label>
    
                                <div class="col-md-6">
                                    <input id="city" type="text" class="form-control" name="city" value="{{ old('city') }}" required autocomplete="city" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Upload Permit</label>
    
                                <div class="col-md-6">
                                    <input type="file" class="form-control" id="photo"  name="photo" value="{{ old('photo') }}" required autocomplete="photo" autofocus>
                                </div>
                            </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Register</button>
                                </form>
                            </div>
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
                url: '/company/edit/' + id,
                method: 'get',
                data: {

                },
                success: function(data) {
                    $('.modal-title').text('Update Type');
                    $('.submit-button').text('Update');
                        $.each(data, function() {
                            $.each(this, function(k, v) {
                               $('[name ="'+k+'"]').val(v);
                            });
                        });
                    $('#modal-form').attr('action', 'company/update/' + data.symptoms.id);
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
                title: 'Company List',
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
                $('.modal-title').text('Add Type');
                $('.submit-button').text('Add');
                $('#modal-form').attr('action', 'company/save');
            })
        });

        function confirmDelete(id) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/company/destroy/' + id,
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