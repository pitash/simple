@extends('layouts.app')
@section('content')
  <div class="container">
  <div class="row">
  <div class="col-md-7 offset-2">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ url('admin/about/update') }}" method="post">
      @csrf
      <div class="form-group">
      </div>
      <div class="form-group">
        <label for="about_title">About Title</label>
        <input type="text" class="form-control" id="about_title" placeholder="Enter About Title" name="about_title" value="{{ $old_information->about_title }}">
        <input type="hidden" class="form-control" id="about_id" aria-describedby="emailHelp" name="about_id" value="{{ $old_information->id }}">
      </div>
      <div class="form-group">
        <label for="about_details">About Details</label>
        <textarea class="form-control" name="about_details" rows="8" cols="80" >{{ $old_information->about_details }} </textarea>
      </div>
      <div class="form-group">
        <label for="about_point">About Point</label>
        <input type="text" class="form-control" id="about_point" placeholder="Add About Point" name="about_point" value="{{ $old_information->about_point }}">
      </div>
      <button type="submit" class="btn btn-primary">Update</button>
    </form>
  </div>
  </div>
@endsection
