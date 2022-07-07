@extends('user.layouts.main')

@section('content-wrapper')
    @if ($oldCustData->class == 'Personal')
        @include('user.pages.oldcustomer.personal')
    @elseif ($oldCustData->class == 'Bussiness')
        @include('user.pages.oldcustomer.bussiness')
    @endif
@endsection
