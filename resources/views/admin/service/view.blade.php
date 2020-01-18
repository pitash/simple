@extends('layouts.app')
@section('content')
  <div class="container">
  <div class="row">
    <div class="col-md-8">
      <table class="table table-hover" id="servicetable">
        <thead>
          <tr>
            <th>Service Photo</th>
            <th>Service Title</th>
            <th>Service Details</th>
            <th>Service Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>

          @forelse ($services as $service)
            <tr>
              <td>
                <img src="{{ asset('/storage') }}/{{ $service->service_image }}" width="100" alt="Not Found">
              </td>
              <td>{{ $service->service_title }}</td>
              <td>{{ $service->service_details }}</td>
              <td>
                @if ($service->service_status == 1)
                  <span class="btn btn-success">Active</span>
                @else
                  <span class="btn btn-warning">Deactive</span>
                @endif
              </td>
              <td>
                <div class="btn-group">
                  @if ($service->service_status == 1)
                    <a style='margin-right:9px' href="{{ url('admin/service/deactive') }}/{{ $service->id }}" data-placement="top" title="Active" class="btn btn-primary" >Dective</a>
                    <a style='margin-right:9px' href="{{ url('admin/service/edit') }}/{{ $service->id }}" data-placement="top" title="Edit" class="btn btn-danger" >Edit</a>
                  @else
                    <a style='margin-right:9px' href="{{ url('admin/service/active') }}/{{ $service->id }}" data-placement="top" title="Active" class="btn btn-primary" >Active</a>
                    <a style='margin-right:9px' href="{{ url('admin/service/edit') }}/{{ $service->id }}" data-placement="top" title="Edit" class="btn btn-danger" >Edit</a>
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
          <h5 class="card-title">Add Service Section</h5>
          <hr>
          <form class="form" action=" {{ url('/admin/service/insert') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="service_title">Service Title</label>
              <input type="text" class="form-control" id="service_title" placeholder="Add Service Title" name="service_title">
            </div>
            <div class="form-group">
              <label for="service_details">Service Details</label>
              <textarea name="service_details" class="form-control" rows="3" placeholder="Enter Your Service Details"></textarea>
            </div>
            <div class="form-group">
              <label for="service_photo">Service Photo</label>
              <input type="file" class="form-control" name="service_photo">
            </div>
            <button type="submit" class="btn btn-primary">Add Service</button>
          </form>
        </div>
      </div>
      <br>
    </div>
  </div>
  </div>
@endsection
@section('data_table')
  <script>
    $(document).ready( function () {
      $('#servicetable').DataTable();
      } );
  </script>
@endsection
