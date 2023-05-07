@extends('template')
@section('content')
<div class="container mt-5 mb-5">
    <div class="col-sm-12">
        <div id='organizer'>
            <div class="mb-3">
                @if (\Session::has('message'))
                <div class="alert alert-success" role="alert">
                    {!! \Session::get('message') !!}
                </div>
                @endif
            </div>
            <a href="{{route('home')}}" class="btn btn-sm btn-primary float-end ms-1">Home</a>
            <a href="{{route('create-event')}}" class="btn btn-sm btn-primary float-end">Create</a>
            <table class="table table-event">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Event Name</th>
                        <th scope="col">Event Type</th>
                        <th scope="col">Organizer Name</th>
                        <th scope="col">Image</th>
                        <th scope="col">Event Date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($event as $key => $b)
                        <tr>
                            <th scope="row">{{($paginator->pagination->current_page -1 ) * $paginator->pagination->per_page + $key + 1}}</th>
                            <td>{{$b->eventName}}</td>
                            <td>{{$b->eventType}}</td>
                            <td>{{$b->organizer->organizerName}}</td>
                            <td><img src="{{$b->organizer->imageLocation}}" /></td>
                            <td>{{date('D M Y', strtotime($b->eventDate))}}</td>
                            <td>
                                <a href="{{route('view-event', $b->id)}}" class="btn btn-sm btn-warning" style="float: left;">Edit</a>
                                <form action="{{ route('delete-event', $b->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm btn-danger ms-1" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <?php
            use Illuminate\Pagination\LengthAwarePaginator;
            $pagination = new LengthAwarePaginator(\Request::url(), $paginator->pagination->total, $paginator->pagination->per_page, $paginator->pagination->current_page);
            echo $pagination->links();
        ?>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
$('.pagination a').unbind().on('click', function(event) {
  console.log(event);
  event.preventDefault();

  $('li').removeClass('active');
  $(this).parent('li').addClass('active');

  var page = $(this).attr('href').split('page=')[1];
  fetch_data(page);
});

function fetch_data(page) {
  $.ajax({
    url: "/organizer?page=" + page,
    success: function(data) {
      $('#organizer').empty().html(data);
    }
  });
}
</script>
@endpush