<div class="mb-3">
    <label class="form-label">Orgainzer Name</label>
    {{ Form::text('organizerName',null, ['class' => 'form-control', 'id' => 'organizerName', 'required']) }}
</div>
<div class="mb-3">
    <label class="form-label">Image Location</label>
    {{ Form::text('imageLocation',null, ['class' => 'form-control', 'id' => 'imageLocation', 'required']) }}
</div>
<div class="mb-3">
    <button type="submit" class="btn btn-sm btn-primary float-end ms-1">Submit</button>
    <a href="{{str_replace(url('/'), '', url()->previous())}}" class="btn btn-sm btn-warning float-end">Cancel</a>
</div>