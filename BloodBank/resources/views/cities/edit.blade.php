@extends('layouts.app')

@inject('governorate', 'App\Models\Governorate')

@section('page_title')
 Edit Cities
@endsection

@section('content')
<!-- Main content -->
<section class="content">

<!-- Default box -->
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Edit city</h3>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fas fa-minus"></i></button>
      <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fas fa-times"></i></button>
    </div>
  </div>
  <div class="card-body">
    {!! Form::model($model, [
      'action' => ['CityController@update', $model->id],
      'method' => 'put'
      
    ]) !!}

      @include('partials.validation_errors')
      @include('cities.form')
      <div class="form-group">
          <label for="governorate">Governorate name</label>
          <select name="governorate_id">
            @foreach($governorates as $governorate)
                <option value="{{$governorate->id}}">{{$governorate->name}}</option>
            @endforeach
          </select> 
      </div>
      <div class="form-group">
        {!! Form::submit('Edit', [
           'class' => 'btn btn-primary'
        ]) !!}
    </div>
      
    {!! Form::close() !!}
  </div>
  <!-- /.card-body -->


</div>
<!-- /.card -->
</section>
<!-- /.content -->

@endsection
