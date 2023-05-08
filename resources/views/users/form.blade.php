<div class="mb-3">
    <label class="form-label">First Name</label>
    {{ Form::text('firstName',null, ['class' => 'form-control', 'id' => 'firstName', 'required']) }}
</div>
<div class="mb-3">
    <label class="form-label">Last Name</label>
    {{ Form::text('lastName',null, ['class' => 'form-control', 'id' => 'lastName', 'required']) }}
</div>
<div class="mb-3">
    <label class="form-label">Email</label>
    {{ Form::email('email',null, ['class' => 'form-control', 'id' => 'email', 'required']) }}
</div>
<div class="mb-3">
    <button type="submit" class="btn btn-sm btn-primary float-end ms-1">Submit</button>
    <a href="{{str_replace(url('/'), '', url()->previous())}}" class="btn btn-sm btn-warning float-end">Cancel</a>
</div>