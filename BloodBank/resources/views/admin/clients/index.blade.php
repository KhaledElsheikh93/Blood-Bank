@extends(('admin.layouts.app'))

@section('page_title')
  Clients
@endsection

@section('content')
<!-- Main content -->
<section class="content">

<!-- Default box -->
<div class="card">
  <div class="card-header">
    <h3 class="card-title">List of Clients</h3>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fas fa-minus"></i></button>
      <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fas fa-times"></i></button>
    </div>
  </div>
  @include('flash::message')
  <div class="card-body">
       @if($records)
          <div class="table-respnosive">
             <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th class="text-center">phone</th>
                    <th class="text-center">email</th>
                    <th class="text-center">name</th>
                    <th class="text-center">date of birth</th>
                    <th class="text-center">blood type</th>
                    <th class="text-center">last donation date</th>
                    <th class="text-center">city</th>
                    
                  </tr>
                </thead>
                <tbody>
                  @foreach($records as $record)
                     <tr>
                       <td>{{ $records->perPage()*($records->currentPage()-1)+$loop->iteration }}</td>
                       <td class="text-center">{{ $record->phone }}</td>
                       <td class="text-center">{{ $record->email }}</td>
                       <td class="text-center">{{ $record->name }}</td>
                       <td class="text-center">{{ $record->date_of_birth }}</td>
                       <td class="text-center">{{ optional($record->bloodType)->name }}</td>
                       <td class="text-center">{{ $record->last_donation_date }}</td>
                       <td class="text-center">{{ optional($record->city)->name }}</td>
                       
                      
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
<div>
{{ $records->links() }}
</div>

</div>
<!-- /.card -->
</section>
<!-- /.content -->

@endsection
