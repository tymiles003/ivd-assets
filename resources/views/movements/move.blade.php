@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-4 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Move Asset</h3>
        </div>
        <div class="panel-body">
          <form method="POST" action="/assets/{{$asset->id}}/store">
            {{csrf_field()}}
            <div class="form-group">
              <label for="location_id">Location</label>
              <select class="form-control location_id" name="location_id">
                <option value = ""></option>
                @foreach($locations as $location)
                    <option value="{{$location->id}}">{{$location->building}}, {{$location->office}}, {{$location->location_name}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="status_id">Status</label>
              <select class="form-control status_id" name="status_id">
                <option value = ""></option>
                @foreach($statuses as $status)
                    <option value="{{$status->id}}">{{$status->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary">Move Asset</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Current Location/Status</h3>
        </div>
        <div class="panel-body">
            <h4><b>Location:</b> {{$asset->movement->location->location_name}}</h4>
            <h4><b>Status:</b> {{$asset->movement->status->name}}</h4>
        </div>
      </div>
    </div>

      @if(count($errors))
        <ul>
          @foreach($errors->all() as $error)
            <li>{{$error}}</li>
          @endforeach
        </ul>
      @endif
    </div>
    <div class="text-center"><a class="btn btn-primary" href="{{ URL::previous() }}">Back</a></div>
  </div>
@endsection

@section('footer')
  <script type="text/javascript">
    $(document).ready(function() {
      $(".location_id").select2();
      $(".status_id").select2();
    });
  </script>
@endsection
