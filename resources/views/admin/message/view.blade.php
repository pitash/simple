@extends('layouts.app')
@section('content')
<div class="container">
<div class="row">
  <div class="col-md-12">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>Sender Name</th>
          <th>Sender Email</th>
          <th>Message</th>
          <th>Send At</th>
          <th>Update At</th>
          <th>action</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($messages as $message)
          <tr>
            @if ($message->message_status == 2)
              <td style="background-color:#2FA360">{{ $message->id }}</td>
              <td style="background-color:#2FA360">{{ $message->sender_name }}</td>
              <td style="background-color:#2FA360">{{ $message->sender_email }}</td>
              <td style="background-color:#2FA360">{{ $message->sender_message }}</td>
              <td style="background-color:#2FA360">{{ $message->created_at->diffForHumans()}}</td>
              <td style="background-color:#2FA360">
                @if ($message->updated_at)
                  {{ $message->updated_at->diffForHumans() }}
                @else
                    --
                @endif
              </td>
              @else
                <td style="background-color:#F8FAFC">{{ $message->id }}</td>
                <td style="background-color:#F8FAFC">{{ $message->sender_name }}</td>
                <td style="background-color:#F8FAFC">{{ $message->sender_email }}</td>
                <td style="background-color:#F8FAFC">{{ $message->sender_message }}</td>
                <td style="background-color:#F8FAFC">{{ $message->created_at->diffForHumans()}}</td>
                <td style="background-color:#F8FAFC">
                @if ($message->updated_at)
                  {{ $message->updated_at->diffForHumans() }}
                  @else
                    --
                  @endif
                </td>
              @endif

              <td>

                    <button type="button" data-toggle="tooltip"  class="delete_link" value="{{ url('contact/message/delete') }}/{{ $message->id }}" data-toggle="tooltip" data-placement="top" title="Delete" >
                      <i class="fa fa-trash" aria-hidden="true"></i> </button>

                  @if ($message->message_status == 1)
                    <a href="{{ url('contact/message/markasread') }}/{{ $message->id }}" data-toggle="tooltip" data-placement="top" title="Mark as Read" class="btn btn-success">
                      <i class="fa fa-check" aria-hidden="true"></i>
                    </a>
                  @endif


                    <script>
                    $(document).ready(function(){
                      $('[data-toggle="tooltip"]').tooltip();
                    });
                    </script>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="7">  <h3>There is no data</h3></td>
            </tr>
          @endforelse
        </tbody>
      </table>
      {{ $messages->links() }}

      <table class="table table-hover">
        <h2>Deleted Data</h2>
        <thead>
          <tr>
            <th>ID</th>
            <th>Sender Name</th>
            <th>Sender Email</th>
            <th>Message</th>
            <th>Send At</th>
            <th>Update At</th>
            <th>action</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($deleted_messages as $message)
            <tr>
              @if ($message->message_status == 2)
                <td style="background-color:#2FA360">{{ $message->id }}</td>
                <td style="background-color:#2FA360">{{ $message->sender_name }}</td>
                <td style="background-color:#2FA360">{{ $message->sender_email }}</td>
                <td style="background-color:#2FA360">{{ $message->sender_message }}</td>
                <td style="background-color:#2FA360">{{ $message->created_at->diffForHumans()}}</td>
                <td style="background-color:#2FA360">
                  @if ($message->updated_at)
                    {{ $message->updated_at->diffForHumans() }}
                    @else
                      --
                  @endif
                </td>

                @else
                  <td style="background-color:#F8FAFC">{{ $message->id }}</td>
                  <td style="background-color:#F8FAFC">{{ $message->sender_name }}</td>
                  <td style="background-color:#F8FAFC">{{ $message->sender_email }}</td>
                  <td style="background-color:#F8FAFC">{{ $message->sender_message }}</td>
                  <td style="background-color:#F8FAFC">{{ $message->created_at->diffForHumans()}}</td>
                  <td style="background-color:#F8FAFC">
                    @if ($message->updated_at)
                      {{ $message->updated_at->diffForHumans() }}
                      @else
                        --
                    @endif
                  </td>
              @endif

              <td>
                <div class="btn-group">
                  <a href="{{ url('contact/message/restore') }}/{{ $message->id }}" data-toggle="tooltip" data-placement="top" title="Restore" class="btn btn-success">
                    <i class="fa fa-retweet" aria-hidden="true"></i>
                  </a>
                  <script>
                  $(document).ready(function(){
                    $('[data-toggle="tooltip"]').tooltip();
                  });
                  </script>
              </td>
              <tr>
              @empty
                <tr>
                  <td colspan="7">
                    <h3>There is No Data</h3>
                  </td>
                </tr>
              </tr>
            </tr>
          @endforelse
        </tbody>
      </table>
        {{ $messages->links() }}
      </div>
  </div>
  </div>
@endsection

@section('footer_script')
<script>
  $(document).ready(function (){
    $('.delete_link').click(function(){
      var redirect_link = $(this).val();
      Swal.fire({
        title: 'Are you sure?',
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
          window.location.href =""+ redirect_link;
        }
      });
    });
  });
</script>
@endsection
