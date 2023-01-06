@extends('layouts.app')

@section('content')
    <!-- Modal -->
    <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Booking title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="form-group">
                            <label for="id">ID:</label>
                            <input type="text" class="form-control" name="id" id="id"
                                aria-describedby="helpId" placeholder="Título">
                            <small id="helpId" class="form-text text-muted">Help text</small>
                        </div>
                        <div class="form-group">
                            <label for="title">Título:</label>
                            <input type="text" class="form-control" name="title" id="title"
                                aria-describedby="helpId" placeholder="Título">
                            <small id="helpId" class="form-text text-muted">Help text</small>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción:</label>
                            <textarea class="form-control" name="descripcion" id="descripcion" rows="3" placeholder="Descripción"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="start">Start:</label>
                            <input type="date" class="form-control" name="start" id="start"
                                aria-describedby="helpId">
                            <small id="helpId" class="form-text text-muted">Help text</small>
                        </div>
                        <div class="form-group">
                            <label for="end">End:</label>
                            <input type="date" class="form-control" name="end" id="end"
                                aria-describedby="helpId">
                            <small id="helpId" class="form-text text-muted">Help text</small>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="saveBtn" class="btn btn-primary">Save changes</button> --}}
                    <button type="button" class="btn btn-success" id="btnGuardar">Guardar</button>
                    <button type="button" class="btn btn-warning" id="btnModificar">Modificar</button>
                    <button type="button" class="btn btn-danger" id="btnEliminar">Eliminar</button>
                    <button type="button" class="btn btn-secondary" id="btnCerrar" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="text-center mt-5">FullCalendar js Laravel series with Career Development Lab</h3>
                <div class="col-md-11 offset-1 mt-5 mb-5">

                    <div id="calendar">

                    </div>

                </div>
            </div>
        </div>
    </div>
    

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var booking = @json($events);
            $('#calendar').fullCalendar({
                locale: "es",
                header: {
                    left: 'prev, next today',
                    center: 'title',
                    right: 'month, agendaWeek, agendaDay',
                },
                events: booking,
                selectable: true,
                selectHelper: true,

                select: function(start, end, allDays) {
                    $('#bookingModal').modal('toggle');

                    $('#btnGuardar').click(function() {
                        let title = $('#title').val();
                        let start_date = moment(start).format('YYYY-MM-DD');
                        let end_date = moment(end).format('YYYY-MM-DD');
                        $.ajax({
                            url:"{{ route('evento.agregar') }}",
                            type:"POST",
                            dataType:'json',
                            data:{ title, description, start, end },
                            success:function(response)
                            {
                                $('#bookingModal').modal('hide')
                                $('#calendar').fullCalendar('renderEvent', {
                                    'title': response.title,
                                    'descriptionx   ': response.descriptionx   ,
                                    'start' : response.start,
                                    'end'  : response.end,
                                    'color' : response.color
                                });
                            },
                            error:function(error)
                            {
                                if(error.responseJSON.errors) {
                                    $('#titleError').html(error.responseJSON.errors.title);
                                }
                            },
                        });
                    });
                }
            })
        })
    </script>
@endsection
