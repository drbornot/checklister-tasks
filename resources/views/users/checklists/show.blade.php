@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            @livewire('checklist-show-component',['checklist' => $checklist])
        </div>
    </div>
@endsection
