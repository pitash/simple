@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8">
      <table class="table table-hover" id="about_table">
        <thead>
          <tr>
            <th>About Photo</th>
            <th>About Title</th>
            <th>About Details</th>
            <th>About Point</th>
            <th>About Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($abouts as $about)
            <tr>
              <td>
                <img src="{{ asset('/storage') }}/{{ $about->about_image }}" width="100" alt="Not Found">
              </td>
              <td>{{ $about->about_title }}</td>
              <td>{{ $about->about_details }}</td>
              <td>{{ $about->about_point }}</td>
              <td>
                @if ($about->about_status == 2)
                  <span class="btn btn-success">Active</span>
                @else
                  <span class="btn btn-warning">Deactive</span>
                @endif
              </td>
              <td>
                <div class="btn-group">
                  @if ($about->about_status == 1)
                    <a style='margin-right:9px' href="{{ url('admin/about/active') }}/{{ $about->id }}" data-placement="top" title="Active" class="btn btn-primary" >Active</a>
                    <a style='margin-right:9px' href="{{ url('admin/about/edit') }}/{{ $about->id }}" data-placement="top" title="Edit" class="btn btn-danger" >Edit</a>
                  @else
                    --
                  @endif
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="3">
                <h2>There is no data</h2>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Add About Section</h5>
          <hr>
          <form class="form" action=" {{ url('/admin/about/insert') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="about_title">About Title</label>
              <input type="text" class="form-control" id="about_title" placeholder="Add About Title" name="about_title">
            </div>
            <div class="form-group">
              <label for="about_details">About Details</label>
              <textarea name="about_details" class="form-control" rows="5" placeholder="Enter Your About Details"></textarea>
            </div>
            <div class="form-group">
              <label for="about_point">About Point</label>
              <input type="text" class="form-control" id="about_point" placeholder="Add About Point" name="about_point">
            </div>
            <div class="form-group">
              <label for="about_photo">About Photo</label>
              <input type="file" class="form-control" id="about_photo" name="about_photo" >

            </div>
            <button type="submit" class="btn btn-primary">Add About</button>
          </form>
        </div>
      </div>
      <br>
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Add About Section</h5>
          <hr>
          <form class="form" action=" {{ url('/admin/about/point/insert') }}" method="post">
            @csrf
            <div class="form-group">
              <label for="about">About</label>
              <select class="form-control" name="about_id">
                <option value="">-Select-</option>
                @foreach ($abouts as $about)
                  <option value="{{ $about->id }}">{{ $about->about_title }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="point">Point</label>
              <input type="text" class="form-control" id="point" placeholder="Add About Point" name="point">
            </div>
            <button type="submit" class="btn btn-primary">Add Point</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('data_table')
  <script>
    $(document).ready( function () {
      $('#about_table').DataTable();
      } );
  </script>
@endsection
