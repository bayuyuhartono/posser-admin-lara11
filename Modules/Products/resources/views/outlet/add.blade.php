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
  <form action="{{ url()->current() }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="card-body row">
      <div class="col-sm-12">
        <div class="form-group">
          <label for="display_pict">Display Picture</label>
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="display_pict" name="display_pict">
            <label class="custom-file-label" for="display_pict">Choose file</label>
          </div>
        </div>
        <div class="form-group">
          <label for="outlet_name">Outlet Name</label>
          <input type="text" class="form-control" id="outlet_name" name="outlet_name" placeholder="Outlet Name" value="{{ old('outlet_name') }}" required>
        </div>
        <div class="form-group">
          <label for="description">Description</label>
          <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="{{ old('description') }}" required>
        </div>
        <div class="form-group">
          <label>Genre</label>
          <select class="select2bs4" multiple="multiple" data-placeholder="Pick genre" name="genre[]" style="width: 100%;">
            @foreach ($genre as $item)
                <option value="{{ $item->uuid }}" @selected(old('genre') == $item->uuid)>
                    {{ $item->name }}
                </option>
            @endForeach
          </select>
        </div>
        <div class="form-group">
          <label>City</label>
          <select class="form-control select2bs4" name="city" style="width: 100%;" required>
            <option value="" @selected(old('city') == "")>Choose city</option>
            @foreach ($city as $item)
                <option value="{{ $item->uuid }}" @selected(old('city') == $item->uuid)>
                    {{ $item->name }}
                </option>
            @endForeach
          </select>
        </div>
        <div class="form-group">
          <label for="address">Address</label>
          <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="{{ old('address') }}" required>
        </div>
        <div class="form-group">
          <label for="phone">Phone</label>
          <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" value="{{ old('phone') }}" required>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
        </div>
        <div class="form-group">
          <label for="web_link">Website Link</label>
          <input type="text" class="form-control" id="web_link" name="web_link" placeholder="Website Link" value="{{ old('web_link') }}" required>
        </div>
      </div>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
      <a href="{{ url('products/outlet') }}" onclick="return confirm('Anda yakin mau kembali?')" class="btn btn-success">Kembali</a>
    </div>
  </form>
</div>
 
@endsection

@push('extra-styles')
  <link rel="stylesheet" href="{{asset('ui/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('ui/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endpush

@push('extra-scripts')
  <script src="{{asset('ui/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
  <script src="{{asset('ui/plugins/select2/js/select2.full.min.js')}}"></script>    
  <script type="text/javascript">
    $(function () {
      bsCustomFileInput.init();

      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
    });
    </script>
@endpush