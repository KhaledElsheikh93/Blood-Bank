@extends('admin.layouts.app')

@section('page_title')
  Settings
@endsection

@section('content')
<!-- Main content -->
<section class="content">

<!-- Default box -->
<div class="card">
  <div class="card-header">
    <h3 class="card-title">List of settings</h3>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fas fa-minus"></i></button>
      <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fas fa-times"></i></button>
    </div>
  </div>
  @include('flash::message')
  <div class="card-body">
       <a href="{{ url(route('settings.create')) }}" class="btn btn-primary">
         <i class="fa fa-plus"></i> New settings</a>
        
       @if($records)
          <div class="table-respnosive">
             <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th class="text-center">Notification</th>
                    <th class="text-center">Text</th>
                    <th class="text-center">About App</th>
                    <th class="text-center">Phone</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">FaceBook</th>
                    <th class="text-center">Twitter</th>
                    <th class="text-center">Instagram</th>
                    <th class="text-center">Edit</th>
                    <th class="text-center">Delete</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($records as $record)
                     <tr>
                       <td>{{ $loop->iteration}}</td>
                       <td class="text-center">{{ $record->notification}}</td>
                       <td class="text-center">{{ $record->settings_text}}</td>
                       <td class="text-center">{{ $record->about_app}}</td>
                       <td class="text-center">{{ $record->phone}}</td>
                       <td class="text-center">{{ $record->email}}</td>
                       <td class="text-center">{{ $record->fb_link}}</td>
                       <td class="text-center">{{ $record->tw_link}}</td>
                       <td class="text-center">{{ $record->insta_link}}</td>
                       <td class="text-center">
                          <a href="{{ url(route('settings.edit', $record->id)) }}" class="btn btn-success btn-xs">
                              <i class="fa fa-edit"></i> 
                              Edit
                          </a>
                       </td>
                       <td class="text-center">
                         {!! Form::open([
                            'action' => ['SettingController@destroy', $record->id],
                            'method' => 'delete'
                         ]) !!}
                         <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?',this,'red')" >
                            <i class="fa af-trash-o"></i>
                            Delete
                          </button>
                         {!! Form::close() !!}
                       </td>
                     </tr>
                  @endforeach
                </tbody>
             </table>
          </div>
          @else
            <div class="alert alert-danger" role="alert">
                    No data
                </div>
       @endif
  </div>
  <!-- /.card-body -->


</div>
<!-- /.card -->
</section>
<!-- /.content -->

@endsection
