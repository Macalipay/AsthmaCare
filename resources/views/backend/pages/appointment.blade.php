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
                                <button appointment="button" class="btn btn-primary add" data-toggle="modal" data-target="#defaultModalPrimary" style="float:right">
                                    Add Appointment
                                </button>
                            </h5>
                        </div>
                        @include('backend.partials.flash-message')
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div id='calendar'></div>
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
        <div class="modal fade" id="defaultModalPrimary" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Appointment</h5>
                        <button appointment="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body m-3">
                        <form id="modal-form" action="{{url('asthma/save')}}" method="post">
                            @csrf
                        <div class="form-group col-md-12">
                            <label for="name">Name</label>
                            <input appointment="text" class="form-control" id="asthma" name="asthma" placeholder="" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">Description</label>
                            <textarea name="description" id="description" class="form-control" cols="30" rows="10" placeholder="Enter Description Here" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button appointment="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button appointment="submit" class="btn btn-primary submit-button">Add</button>
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
        var SITEURL = "{{ url('/') }}";
        function edit(id){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/asthma/edit/' + id,
                method: 'get',
                data: {

                },
                success: function(data) {
                    $('.modal-title').text('Update Appointment');
                    $('.submit-button').text('Update');
                        $.each(data, function() {
                            $.each(this, function(k, v) {
                               $('[name ="'+k+'"]').val(v);
                            });
                        });
                    $('#modal-form').attr('action', 'asthma/update/' + data.symptoms.id);
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
                $('.modal-title').text('Add Appointment');
                $('.submit-button').text('Add');
                $('#modal-form').attr('action', 'asthma/save');
            })

              
            var calendar = $('#calendar').fullCalendar({
                                header: {
                                    left: 'prev,next today',
                                    center: 'title',
                                    right: 'month,basicWeek,basicDay'
                                },
                                editable: true,
                                events: SITEURL + "/fullcalender",
                                displayEventTime: false,
                                editable: true,
                                eventRender: function (event, element, view) {
                                    if (event.allDay === 'true') {
                                            event.allDay = true;
                                    } else {
                                            event.allDay = true;
                                    }
                                },
                                selectable: true,
                                selectHelper: true,
                                select: function (start, end, allDay) {
                                    var title = prompt('Event Title:');
                                    if (title) {
                                        var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
                                        var end = $.fullCalendar.formatDate(end, "Y-MM-DD");
                                        $.ajax({
                                            url: SITEURL + "/fullcalenderAjax",
                                            data: {
                                                title: title,
                                                start: start,
                                                end: end,
                                                type: 'add'
                                            },
                                            type: "POST",
                                            success: function (data) {
                                                displayMessage("Event Created Successfully");
            
                                                calendar.fullCalendar('renderEvent',
                                                    {
                                                        id: data.id,
                                                        title: title,
                                                        start: start,
                                                        end: end,
                                                        allDay: allDay
                                                    },true);
            
                                                calendar.fullCalendar('unselect');
                                            }
                                        });
                                    }
                                },
                                eventDrop: function (event, delta) {
                                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");
            
                                    $.ajax({
                                        url: SITEURL + '/fullcalenderAjax',
                                        data: {
                                            title: event.title,
                                            start: start,
                                            end: end,
                                            id: event.id,
                                            type: 'update'
                                        },
                                        type: "POST",
                                        success: function (response) {
                                            displayMessage("Event Updated Successfully");
                                        }
                                    });
                                },
                                eventClick: function (event) {
                                    var deleteMsg = confirm("Do you really want to delete?");
                                    if (deleteMsg) {
                                        $.ajax({
                                            type: "POST",
                                            url: SITEURL + '/fullcalenderAjax',
                                            data: {
                                                    id: event.id,
                                                    type: 'delete'
                                            },
                                            success: function (response) {
                                                calendar.fullCalendar('removeEvents', event.id);
                                                displayMessage("Event Deleted Successfully");
                                            }
                                        });
                                    }
                                }
            
                            });
            
            
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