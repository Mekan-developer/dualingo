@extends('layouts.main')
@section('content')
    @livewire("edit.review-edit",['review' => $review,'lessons' => $lessons])
@endsection