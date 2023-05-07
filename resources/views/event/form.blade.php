<div class="row">
    <div class="col-sm-6">
        <div class="mb-3">
            <label class="form-label">Event Name</label>
            {{ Form::text('eventName',null, ['class' => 'form-control', 'id' => 'eventName', 'required']) }}
        </div>
        <div class="mb-3">
            <label class="form-label">Event Type</label>
            {{ Form::text('eventType',null, ['class' => 'form-control', 'id' => 'eventType', 'required']) }}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="mb-3">
            <label class="form-label">Event Date</label>
            {{ Form::date('eventDate',null, ['class' => 'form-control', 'id' => 'eventDate', 'required']) }}
        </div>
        <div class="mb-3">
            <label class="form-label">Organizer</label>
            <select class="form-select" aria-label="Default select example" name="organizerId">
                @foreach($organizer as $b)
                    @if(\Request::route()->getName() === 'create-event')
                        <option selected>Open this select menu</option>
                    @endif
                    <option value="{{$b->id}}">{{$b->organizerName}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-sm btn-primary float-end ms-1">Submit</button>
        <a href="{{str_replace(url('/'), '', url()->previous())}}" class="btn btn-sm btn-warning float-end">Cancel</a>
    </div>
</div>