@extends('layouts.admin')

@section('title', 'Billing Account')
@section('menu-title', 'Billing Account')

@section('contents')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                @include('admin.student-view.billing-account.sections.profile-contents')
                @include('admin.student-view.billing-account.sections.billing-profile')
                <div class="bg-danger text-white py-1 text-center mt-5">
                    This is a system generated copy. If you want an authenticated signed copy of this document, please visit the cashier's office personally.
                </div>
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