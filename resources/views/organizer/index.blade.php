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
            <a href="{{route('create-organizer')}}" class="btn btn-sm btn-primary float-end">Create</a>
            <table class="table table-organizer">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Orgainzer Name</th>
                        <th scope="col">Image</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($organizer as $key => $b)
                    <tr>
                        <th scope="row">{{($paginatoror->pagination->current_page -1 ) * $paginatoror->pagination->per_page + $key + 1}}</th>
                        <td>{{$b->organizerName}}</td>
                        <td><img src="{{$b->imageLocation}}" /></td>
                        <td>
                            <a href="{{route('edit-organizer', $b->id)}}" class="btn btn-sm btn-warning" style="float: left;">Edit</a>
                            <form action="{{ route('delete-organizer', $b->id) }}" method="POST">
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
                $pagination = new LengthAwarePaginator(\Request::url(), $paginatoror->pagination->total, $paginatoror->pagination->per_page, $paginatoror->pagination->current_page);
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