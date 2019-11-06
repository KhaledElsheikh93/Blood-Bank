@extends('layouts.app')

@inject('model', 'App\Models\Post')
@inject('category', 'App\Models\Category')

@section('page_title')
  Add New Post
@endsection

@section('content')
<!-- Main content -->
<section class="content">

<!-- Default box -->
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Add Post</h3>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fas fa-minus"></i></button>
      <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fas fa-times"></i></button>
    </div>
  </div>
  @include('flash::message')
  <div class="card-body">
      {!! Form::model($model, [
         'action' => 'PostController@store'
      ]) !!}
      @include('partials.validation_errors')
      @include('posts.form')
      <div class="form-group">
          <label for="category">Category name</label>
          <select name="category_id">
            @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
          </select> 
      </div>
      <div class="form-group">
      {!! Form::submit('Add', [
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
