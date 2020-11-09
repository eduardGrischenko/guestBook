@extends('layouts.app')

@section('content')


        @if($item->exists)
            <form method="POST" action="{{ route('guestbook.visits.update', $item->id) }}">
                {{ method_field('PATCH') }}
                @else
                    <form method="POST" action="{{ route('guestbook.visits.store') }}">
                        @endif
                        {{ csrf_field() }}

                        <div class="container">

                            @include('guestbook.visits.includes.result_messages')

                        <div class="edit-main-panel">
                            <div class="col-md-8">
                                @include('guestbook.visits.includes.visits_edit_main_col')
                            </div>
                        </div>
                        <div class="edit-add-panel">
                            @include('guestbook.visits.includes.visits_edit_add_col')
                        </div>
                        </div>
                    </form>

                    @if($item->exists)
                        <br>
                        <form method="POST" action="{{ route('guestbook.visits.destroy', $item->id) }}">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}

                            <button type="submit" class="btn btn-primary">Удалить</button>

                        </form>
        @endif
@endsection
