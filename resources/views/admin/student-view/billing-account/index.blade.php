@extends('layouts.admin')

@section('title', 'Billing Account')
@section('menu-title', 'Billing Account')

@section('contents')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                @include('admin.student-view.billing-account.sections.profile-contents')
                @include('admin.student-view.billing-account.sections.billing-profile')
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#btnPrint').click(function(){
            alert('IMPORTANT REMINDER!\n Enable the "Background Graphics" option first before printing.\n This will allow the images to be included in the printout.')
            window.print();
        })
    </script>
@endsection