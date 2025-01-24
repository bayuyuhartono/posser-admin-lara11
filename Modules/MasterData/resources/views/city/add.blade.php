@extends('layouts.main', ['title' => $title ])

@section('content')

@if ($errors->any())
<div class="alert alert-danger alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <h5><i class="icon fas fa-ban"></i> Validation Failure!</h5>
  @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
  @endforeach
</div>
@endif

@if (session('success'))
  <div class="alert alert-success alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <h5><i class="icon fas fa-check"></i> Success!</h5>
  {{ session('success') }}
  </div>
@endif

@if (session('failed'))
  <div class="alert alert-danger alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <h5><i class="icon fas fa-ban"></i> Failed!</h5>
  {{ session('failed') }}
  </div>
@endif
 
<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">Form {{ $title }}</h3>
  </div>
  <form action="{{ url()->current() }}" method="post">
    @csrf
    <div class="card-body row">
      <div class="col-sm-12">
        <div class="form-group">
          <label>Country</label>
          <select class="form-control select2bs4" name="country" style="width: 100%;" required>
            <option value="" @selected(old('country') == "")>Choose country</option>
            @foreach ($country as $item)
                <option value="{{ $item->uuid }}" @selected(old('country') == $item->uuid)>
                    {{ $item->name }}
                </option>
            @endForeach
          </select>
        </div>
        <div class="form-group">
          <label for="city_name">City Name</label>
          <input type="text" class="form-control" id="city_name" name="city_name" placeholder="City Name" value="{{ old('city_name') }}" required>
        </div>
      </div>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
      <a href="{{ url('masterdata/city') }}" onclick="return confirm('Anda yakin mau kembali?')" class="btn btn-success">Kembali</a>
    </div>
  </form>
</div>
 
@endsection

@push('extra-styles')
  <link rel="stylesheet" href="{{asset('ui/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('ui/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endpush

@push('extra-scripts')
  <script src="{{asset('ui/plugins/select2/js/select2.full.min.js')}}"></script>    
  <script type="text/javascript">
    $(function () {
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
    });
    </script>
@endpush