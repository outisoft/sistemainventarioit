@extends('toast.app')


@section('content')
<div class="card mb-4">
    <h5 class="card-header">Bootstrap Toasts Example With Placement</h5>
    <div class="card-body">
      <div class="row gx-3 gy-2 align-items-center">
        <div class="col-md-3">
          <label class="form-label" for="selectTypeOpt">Type</label>
          <select id="selectTypeOpt" class="form-select color-dropdown">
            <option value="bg-primary" selected>Primary</option>
            <option value="bg-secondary">Secondary</option>
            <option value="bg-success">Success</option>
            <option value="bg-danger">Danger</option>
            <option value="bg-warning">Warning</option>
            <option value="bg-info">Info</option>
            <option value="bg-dark">Dark</option>
          </select>
        </div>
        <div class="col-md-3">
          <label class="form-label" for="selectPlacement">Placement</label>
          <select class="form-select placement-dropdown" id="selectPlacement">
            <option value="top-0 start-0">Top left</option>
            <option value="top-0 start-50 translate-middle-x">Top center</option>
            <option value="top-0 end-0">Top right</option>
            <option value="top-50 start-0 translate-middle-y">Middle left</option>
            <option value="top-50 start-50 translate-middle">Middle center</option>
            <option value="top-50 end-0 translate-middle-y">Middle right</option>
            <option value="bottom-0 start-0">Bottom left</option>
            <option value="bottom-0 start-50 translate-middle-x">Bottom center</option>
            <option value="bottom-0 end-0">Bottom right</option>
          </select>
        </div>
        <div class="col-md-3">
          <label class="form-label" for="de">&nbsp;</label>
          <button id="toast" class="btn btn-primary d-block">Show Toast</button>
        </div>
      </div>
    </div>
</div>
@endsection