@extends(('layouts.app'))

@section('page_title')
  Donation requests
@endsection

@section('content')
<!-- Main content -->
<section class="content">

<!-- Default box -->
<div class="card">
  <div class="card-header">
    <h3 class="card-title">List of Donation requests</h3>

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
                    <th class="text-center">patien name</th>
                    <th class="text-center">patien phone</th>
                    <th class="text-center">patien city</th>
                    <th class="text-center">hospital name</th>
                    <th class="text-center">blood type</th>
                    <th class="text-center">patien age</th>
                    <th class="text-center">bags number</th>
                    <th class="text-center">hospital address</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($records as $record)
                     <tr>
                       <td>{{ $records->perPage()*($records->currentPage()-1)+$loop->iteration }}</td>
                       <td class="text-center">{{ $record->patient_name}}</td>
                       <td class="text-center">{{ $record->patient_phone}}</td>
                       <td class="text-center">{{ optional($record->city)->name}}</td>
                       <td class="text-center">{{ $record->hospital_name}}</td>
                       <td class="text-center">{{ optional($record->blood_type)->name}}</td>
                       <td class="text-center">{{ $record->patient_age}}</td>
                       <td class="text-center">{{ $record->bags_num}}</td>
                       <td class="text-center">{{ $record->hospital_address}}</td>
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
