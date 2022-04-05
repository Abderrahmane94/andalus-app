@extends('admin.adminBase')
@section('admin')


 <div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->


		<!-- Main content -->
		<section class="content">
		  <div class="row">



			<div class="col-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title"> كشف حضور: <strong>{{ $group[0]->name }}</strong> </h3>
				  <h3 class="box-title"> التاريخ: <strong>{{ date('d / m / Y', strtotime($groupAttendances->date)) }}</strong> </h3>

				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
		<table  class="table table-bordered table-striped">
						<thead>
			<tr>
				<th width="5%">الرقم</th>
				<th>الاسم</th>
				<th>رقم التسجيل</th>
				<th>الحالة</th>


			</tr>
		</thead>
		<tbody>
			@foreach($studentAttendances as $key => $value )
			<tr>
				<td>{{ $key+1 }}</td>
				<td> {{ $value['student']['last_name']    }}  {{    $value['student']['first_name'] }}</td>
				<td> {{ $value['student']['id_no'] }}</td>
				<td> {{ $value->attendance_status }}</td>


			</tr>
			@endforeach

						</tbody>
						<tfoot>

						</tfoot>
					  </table>
					</div>
				</div>
				<!-- /.box-body -->
			  </div>
			  <!-- /.box -->


			</div>
			<!-- /.col -->
		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->

	  </div>
  </div>





@endsection
