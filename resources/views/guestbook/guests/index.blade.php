@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
                    <a class="btn btn-primary"
                       href="{{ route('guestbook.guests.create') }}">Добавить гостя</a>
                </nav>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover" id="data">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Имя</th>
                                <th>Возраст</th>
                                <th>Пол</th>
                            </tr>
                            </thead>
                            <tfoot>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tfoot>
                        </table>

                        <style>
                            .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
                                background: none;
                                color: #ffffff !important;
                                border-radius: 4px;
                                border: 1px solid #828282;
                            }

                            .dataTables_wrapper .dataTables_paginate .paginate_button {
                                background: none;
                                color: #ffffff !important;
                            }
                        </style>

                        @push('scripts')
                            <script>
                                $(function () {
                                    $('#data').DataTable({
                                        info: false,
                                        lengthChange: false,
                                        processing: true,
                                        serverSide: true,
                                        dom: 'bftrip',
                                        language: {
                                            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json"
                                        },
                                        ajax: '{!! route('get.guests') !!}',
                                        columnDefs: [
                                            {
                                                targets: 2,
                                                data: 'birthday', render: function (data, type, row) {
                                                    return Math.floor(moment(row.timestamp).diff(data, 'years', true))
                                                }
                                            }
                                        ],
                                        columns: [
                                            {data: 'id', name: 'id'},
                                            {
                                                data: 'name', name: 'name', render: function (data, type, row) {
                                                    return "<a href='/guestbook/guests/" + row.id + " /edit " + "'>" + row.name + "</a>"
                                                }
                                            },
                                            {data: 'birthday', name: 'birthday'},
                                            {data: 'gender', name: 'gender'},
                                        ],
                                        initComplete: function () {
                                            this.api().columns().every(function () {
                                                var column = this;
                                                var input = document.createElement("input");
                                                $(input).appendTo($(column.footer()).empty())
                                                    .on('change', function () {
                                                        column.search($(this).val(), false, false, true).draw();
                                                    });
                                            });
                                        }
                                    });
                                });
                            </script>
                        @endpush
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




