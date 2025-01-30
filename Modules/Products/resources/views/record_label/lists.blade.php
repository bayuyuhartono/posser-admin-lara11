@extends('layouts.main', ['title' => $title ])

@section('content')
 
<div class="card">
  <div class="card-header">
      <h3 class="card-title">List {{ $title }}</h3>
      <div class="float-right">
        @if (permissionCheck('add'))
          <a href="{{ url('products/recordlabel/add') }}" class="btn bg-gradient-primary btn-sm">Add</a>
        @endif
      </div>
  </div>
  @if ($lists->isEmpty())
    <div class="card-body text-center"><h3>Data is empty</h3></div>
  @else
    <div class="card-body">
      <table id="datatable-def" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>No</th>
          <th>Name</th>
          <th>City</th>
          <th width="200">Action</th>
        </tr>
        </thead>
        <tbody>
          @foreach ($lists as $key => $value)
            <tr>
              <td width="20" class="text-center">{{ intval($key) + 1 }}</td>
              <td>{{ $value->name }}</td>
              <td>{{ $value->city_name }}</td>
              <td>
                <div class="btn-group btn-block">
                  @if (permissionCheck('edit')) <a href="{{ url('products/recordlabel/edit/'.$value->uuid) }}" class="btn btn-success btn-sm">Edit</a> @endif
                  @if (permissionCheck('delete')) <a href="{{ url('products/recordlabel/delete/'.$value->uuid) }}" onclick="return confirm('Anda yakin menghapus data ini?')" class="btn btn-danger btn-sm">Delete</a> @endif
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @endif
</div>
 
@endsection

@push('extra-styles')
  <link rel="stylesheet" href="{{asset('ui/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('ui/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('ui/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endpush

@push('extra-scripts')
  <script src="{{asset('ui/plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('ui/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{asset('ui/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
  <script src="{{asset('ui/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
  <script src="{{asset('ui/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
  <script src="{{asset('ui/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
  <script src="{{asset('ui/plugins/jszip/jszip.min.js')}}"></script>
  <script src="{{asset('ui/plugins/pdfmake/pdfmake.min.js')}}"></script>
  <script src="{{asset('ui/plugins/pdfmake/vfs_fonts.js')}}"></script>
  <script src="{{asset('ui/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
  <script src="{{asset('ui/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
  <script src="{{asset('ui/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

  <script type="text/javascript">
    $(function () {
      $("#datatable-def").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#datatable-def_wrapper .col-md-6:eq(0)');
    });
  </script>
@endpush