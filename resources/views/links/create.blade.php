@extends('layouts.app')

@section('content')
    <livewire:save-link :edition="$weeklyNumber" :link-data="$linkData" />
@endsection
