@extends('layouts.master')

@push('title')
- Daftar Calon Staf
@endpush

@push('styles')
<!-- simplebar CSS-->
<link href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
<!-- Bootstrap core CSS-->
<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
<!--Data Tables -->
<link href="{{ asset('assets/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/plugins/bootstrap-datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
<!-- animate CSS-->
<link href="{{ asset('assets/css/animate.css') }}" rel="stylesheet" type="text/css" />
<!-- Icons CSS-->
<link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
<!-- Sidebar CSS-->
<link href="{{ asset('assets/css/sidebar-menu.css') }}" rel="stylesheet" />
<!-- Custom Style-->
<link href="{{ asset('assets/css/app-style.css') }}" rel="stylesheet" />
@endpush

@section('content')
<div class="row pt-2 pb-2">
  <div class="col-sm-9">
    <h4 class="page-title">Daftar Calon Staf</h4>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">{{ env('APP_NAME') }}</a></li>
      <li class="breadcrumb-item"><a href="javaScript:void();">Kelola Staf</a></li>
      <li class="breadcrumb-item active" aria-current="page">Daftar Calon Staf</li>
    </ol>
  </div>
  <div class="col-sm-3">

  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert">×</button>
      <div class="alert-icon contrast-alert">
       <i class="icon-check"></i>
     </div>
     <div class="alert-message">
      <span><strong>Berhasil!</strong> {{$message}}.</span>
    </div>
  </div>
  @endif
  <div class="card">
    <div class="card-header"><i class="fa fa-table"></i> Data Calon Staf</div>
    <div class="card-body">
      <div class="table-responsive">
        <table id="example" class="table table-bordered" style="width: 100%;">
          <thead>
            <tr>
              <th>NO</th>
              <th>NAMA</th>
              <th>NUPTK</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            
          </tbody>

        </table>
      </div>
    </div>
  </div>
</div>
</div><!-- End Row-->

<!--Start Back To Top Button-->
<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
<!--End Back To Top Button-->

@push('scripts')
<!-- Bootstrap core JavaScript-->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

<!-- simplebar js -->
<script src="{{ asset('assets/plugins/simplebar/js/simplebar.js') }}"></script>
<!-- waves effect js -->
<script src="{{ asset('assets/js/waves.js') }}"></script>
<!-- sidebar-menu js -->
<script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
<!-- Custom scripts -->
<script src="{{ asset('assets/js/app-script.js') }}"></script>

<!--Data Tables js-->
<script src="{{ asset('assets/plugins/bootstrap-datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-datatable/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-datatable/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-datatable/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-datatable/js/jszip.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-datatable/js/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-datatable/js/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-datatable/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-datatable/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-datatable/js/buttons.colVis.min.js') }}"></script>


<script src="{{ asset('js_datatables/datatable.js') }}"></script>
<script>
  $(document).ready(function () {
    staffProspective()
  });
</script>
@endpush
@endsection