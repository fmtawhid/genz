@extends('layouts.admin_master')
@section('content')
	<div class="row">
		<div class="col-12">
			<div class="page-title-box justify-content-between d-flex align-items-lg-center flex-lg-row flex-column">
				<h4 class="page-title">Dashboard</h4>
			</div>
		</div>
	</div>


	<style>
		.nav-tabs>li>a {
			color: #333;
			padding: 10px 15px;
			display: inline-block;
			text-decoration: none;
			border-radius: 4px;
		}
		
		.nav-tabs>li.active>a {
			background-color: #3B4CA7 !important;
			color: white !important;
			font-weight: bold;
		}
	</style>

	@if (isset($student))
		<div class="container bg-white py-2">
			<div class="profile-container">
				<div class="row mt-3">
					<div class="col-4 text-center">
						<div class="profile-header">
							<img src="{{ asset($student->image ? 'img/profile/' . $student->image : 'https://pinnacle.works/wp-content/uploads/2022/06/dummy-image.jpg') }}"
								alt="Profile Picture" style="width: 130px;">
						</div>
					</div>
					<div class="col-8">
						<h3>{{ $student->student_name }}</h3>
						<h4 class="text-muted">User ID - {{ $student->dhakila_number }}</h4>
						<div class="">
							<!-- For Student  -->
							<a href="{{ route('student.generateID', ['dhakila_number' => $student->dhakila_number]) }}"
								class="btn btn-primary">Generate ID Card</a>
						</div>
					</div>
				</div>
				<hr>

				<ul class="nav nav-tabs" role="tablist" style="padding-bottom: 15px">
					<li class="mx-2 @if ($activeTab == 'basic-info') active @endif">
						<a href="#basic-info" role="tab" data-toggle="tab">Basic Information</a>
					</li>
					<li class="mx-2 @if ($activeTab == 'payment-info') active @endif">
						<a href="#payment-info" role="tab" data-toggle="tab">Payment Info</a>
					</li>
					<li class="mx-2 @if ($activeTab == 'payment-due') active @endif">
						<a href="#payment-due" role="tab" data-toggle="tab">Payment Due </a>
					</li>
					<li class="mx-2 @if ($activeTab == 'attendance-info') active @endif">
						<a href="#attendance-info" role="tab" data-toggle="tab">Attendance Info</a>
					</li>
					<li class="mx-2 @if ($activeTab == 'document-info') active @endif">
						<a href="#document-info" role="tab" data-toggle="tab">Document Info</a>
					</li>
					<li class="mx-2 @if ($activeTab == 'exam-info') active @endif">
						<a href="#exam-info" role="tab" data-toggle="tab">Exam Info</a>
					</li>
					<li class="mx-2 @if ($activeTab == 'lesson-info') active @endif">
						<a href="#lesson-info" role="tab" data-toggle="tab">Subject and Lesson </a>
					</li>

				</ul>

				<div class="tab-content">
					<!-- Basic Information Tab -->
					<div class="tab-pane mt-3 mx-2 active" id="basic-info">
						<div class="bg-white p-6 rounded-lg">
							<h3 class="text-2xl font-semibold text-gray-700 mb-4 border-b-2 pb-2">Basic & Class
								Information</h3>
							<div class="row">
								<div class="col-6">
									<div class="p-6 bg-gray-50 rounded-lg">
										<h4 class="text-xl font-semibold text-gray-700 mb-4">Basic Information
										</h4>
										<p class="text-gray-600 mb-2"><strong>Phone:</strong>
											<a href="tel:+{{ $student->mobile }}"
												class="text-blue-500 hover:underline">{{ $student->mobile }}</a>
										</p>
										<p class="text-gray-600 mb-2"><strong>Whatsapp Number:</strong>
											{{ $student->emergency_contact }}</p>
										<p class="text-gray-600 mb-2"><strong>Father's Name:</strong>
											{{ $student->father_name }}</p>
										<p class="text-gray-600 mb-2"><strong>Present address:</strong>
											{{ $student->district }}</p>
										<p class="text-gray-600 mb-2"><strong>Email:</strong>
											{{ $student->email }}</p>
										<p class="text-gray-600 mb-2"><strong>Date of Birth:</strong>
											{{ $student->date_of_birth }}</p>
									</div>
								</div>
								<div class="col-6">
									<div class="p-6 bg-gray-50 rounded-lg">
										<h4 class="text-xl font-semibold text-gray-700 mb-4">Class Information
										</h4>
										<p class="text-gray-600 mb-2"><strong>Class:</strong>
											{{ $student->sreni->name }}</p>
										<p class="text-gray-600 mb-2"><strong>Department:</strong>
											{{ $student->bibag->name ?? 'No Department Assigned' }}</p>
										<p class="text-gray-600 mb-2"><strong>Roll Number:</strong>
											{{ $student->roll_number }}</p>
										<p class="text-gray-600 mb-2"><strong>Academic Session:</strong>
											{{ $student->academic_session }}</p>
										<p class="text-gray-600 mb-2"><strong>Form Number:</strong>
											{{ $student->form_number }}</p>
										<p class="text-gray-600 mb-2"><strong>User ID:</strong>
											{{ $student->dhakila_number }}</p>
										<p class="text-gray-600"><strong>Student Registration Date:</strong>
											{{ $student->dhakila_date }}</p>

									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Payment Information Tab -->
					<div class="tab-pane mt-3 mx-2" id="payment-info">
						<h3>Payment History</h3>
						<table id="payments_table" class="table table-striped dt-responsive nowrap w-100">
							<thead>
								<tr>
									<th>#</th>
									<th>Reciept Number</th>
									<th>Date</th>
									<th>Amount</th>
									<th>Purpose</th>
								</tr>
							</thead>
							<tbody>
								<!-- Data will be loaded via AJAX -->
							</tbody>
						</table>
					</div>

					<!-- Attendance Information Tab -->
					<div class="tab-pane mt-3 mx-2" id="attendance-info">
						<h3>Attendance Records</h3>
						<table id="attendance_table" class="table table-striped dt-responsive nowrap w-100">
							<thead>
								<tr>
									<th>#</th>
									<th>Date</th>
									<th>Attendance Type</th>
									<th>Remark</th>
								</tr>
							</thead>
							<tbody>
								<!-- Data will be loaded via AJAX -->
							</tbody>
						</table>
					</div>

					<!-- Document Information Tab -->
					<div class="tab-pane mt-3 mx-2" id="document-info">
						@if ($attachments->isEmpty())
							<p>No attachments found for this student.</p>
						@else
							<ul>
								@foreach ($attachments as $attachment)
									<li>
										<a href="{{ asset('assets/attachements/' . $attachment->file_path) }}"
											target="_blank">{{ $attachment->file_name }}</a>
									</li>

								@endforeach
							</ul>
						@endif
					</div>


					<!-- Exams Tab -->
					<div class="tab-pane mt-3 mx-2" id="exam-info">
						<div class="bg-white p-6 rounded-lg">
							<h3 class="text-2xl font-semibold text-gray-700 mb-4 border-b-2 pb-2">Exam Information</h3>
							<div class="row">
								<div class="col-12">
									<label for="exam_name" class="form-label">Exams:</label>
									<!-- Displaying Exams in DataTable -->
									<table id="examsTable" class="table table-bordered table-striped w-100">
										<thead>
											<tr>
												<th>Exam Name</th>
												<th>Exam Type</th>
												<th>Date</th>
												<th>Admit Card</th>
												<th>Actions</th>
											</tr>
										</thead>
										<tbody>
											@if($exams->isNotEmpty())
												@foreach($exams as $exam)
													<tr>
														<td>{{ $exam->name }}</td>
														<td>{{ $exam->exam_type }}</td>
														<td>{{ $exam->date }}</td>
														<td>
															<a href="{{ route('student.admitCard', ['exam_id' => $exam->id, 'student_id' => $student->id]) }}"
																class="btn btn-info btn-sm" target="_blank">
																Admit Card
															</a>
														</td>
														<td>
															<a href="{{ route('student.marksheet', ['exam_id' => $exam->id, 'student_id' => $student->id]) }}"
																class="btn btn-primary btn-sm" target="_blank">
																View Marksheet
															</a>
														</td>
													</tr>
												@endforeach
											@else
												<tr>
													<td colspan="5" class="text-center">No Exams Assigned</td>
												</tr>
											@endif
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>

					<!-- Lessons Tab -->
					<div class="tab-pane mt-3 mx-2" id="lesson-info">
						<div class="bg-white p-6 rounded-lg">
							<h3 class="text-2xl font-semibold text-gray-700 mb-4 border-b-2 pb-2">Class and Lessons</h3>

							<div class="row">
								<div class="col-md-12">
									<h5>Class: {{ $sreni->name }}</h5>
									<h6>Subjects</h6>
									<!-- List subjects -->
									<ul>
										@foreach($subjects as $subject)
											<li>{{ $subject->name }}</li>
										@endforeach
									</ul>
								</div>
							</div>

							<!-- Lessons DataTable -->
							<div class="row">
								<div class="col-md-12">
									<h6>Lessons</h6>
									<table id="lessonsTable" class="table table-bordered table-striped w-100">
										<thead>
											<tr>
												<th>Lesson Title</th>
												<th>Lesson Date</th>
												<th>Subject</th>
												<th>Note</th>
												<th>PDF</th>
											</tr>
										</thead>
										<tbody>
											<!-- Data will be filled dynamically using DataTables -->
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>


					<!-- Due Tab -->
					<div class="tab-pane mt-3 mx-2" id="payment-due">
						<div class="bg-white p-6 rounded-lg">
							<h3 class="text-2xl font-semibold text-gray-700 mb-4 border-b-2 pb-2">Assigned Fees</h3>
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Fee Category</th>
										<th>Month</th>
										<th>Amount</th>
									</tr>
								</thead>
								<tbody>
									@forelse($fees as $fee)
										<tr>
											<td>{{ $fee['category'] }}</td>
											<td>{{ $fee['month'] }}</td>
											<td>{{ number_format($fee['amount'], 2) }}</td>
										</tr>
									@empty
										<tr>
											<td colspan="3" class="text-center">No assigned fees found.</td>
										</tr>
									@endforelse
								</tbody>

								@if(count($fees) > 0)
									<tfoot>
										<tr class="bg-gray-100 font-semibold">
											<td colspan="2" class="text-end">Total Assigned:</td>
											<td>{{ number_format($totalAssigned, 2) }}</td>
										</tr>
										<tr class="bg-green-100 font-semibold">
											<td colspan="2" class="text-end">Total Paid:</td>
											<td>{{ number_format($totalPayments, 2) }}</td>
										</tr>
										<tr class="bg-red-100 font-semibold">
											<td colspan="2" class="text-end">Remaining Due:</td>
											<td>{{ number_format($remainingDue, 2) }}</td>
										</tr>
									</tfoot>
								@endif
							</table>
						</div>
					</div>


					<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
					<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
					<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap5.min.js"></script>

					<script>
						$(document).ready(function () {
							// Initialize DataTables for Exams
							$('#examsTable').DataTable({
								processing: true,
								serverSide: true,
								ajax: {
									url: '{{ route('studentD') }}',  // Your route to get the exams and lessons
									type: 'GET',
									dataSrc: function (json) {
										return json.exams.data;  // Use 'data' inside 'exams' to fetch the records
									}
								},
								columns: [
									{ data: 'name', name: 'name' },
									{ data: 'exam_type', name: 'exam_type' },
									{ data: 'start_date', name: 'start_date' },
									{
										data: 'id',
										render: function (data, type, row) {
											return `<a href="/panel/results/${data}/${row.student_id}" class="btn btn-primary">View Results</a>`;
										}
									}




								]
							});

							// Initialize DataTables for Lessons
							$('#lessonsTable').DataTable({
								processing: true,
								serverSide: true,
								ajax: {
									url: '{{ route('studentD') }}',  // Your route to get the lessons data
									type: 'GET',
									dataSrc: function (json) {
										return json.lessons.data;  // Use 'data' inside 'lessons' to fetch the records
									}
								},
								columns: [
									{ data: 'title', name: 'title' },
									{ data: 'lesson_date', name: 'lesson_date' },
									{ data: 'subject.name', name: 'subject.name' },
									{ data: 'note', name: 'note' },
									{
										data: 'pdf_file',
										name: 'pdf_file',
										render: function (data) {
											// Generate the correct URL for PDF using asset helper
											var pdfUrl = data ? "{{ asset('') }}/" + data : 'No PDF';
											return pdfUrl !== 'No PDF' ? `<a href="${pdfUrl}" target="_blank" class="btn btn-primary">View PDF</a>` : 'No PDF';
										}
									}
								]
							});
						});
					</script>



				</div>
			</div>

		</div>
		</div>
		</div>
	@else
		<div class="d-flex align-items-center justify-content-center" style="height:600px; border:3px solid; font-size:40px;">
			Student Information will appear here
		</div>
	@endif

	<!-- jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<!-- Bootstrap JS (Make sure it's after jQuery) -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<script>
		$(document).ready(function () {
			// Initialize DataTable for Payments
			$('#payments_table').DataTable({
				processing: true,
				serverSide: true,
				ajax: "{{ route('student.payments', $student->dhakila_number) }}",
				columns: [
					{ data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
					{ data: 'reciept_no', name: 'reciept_no' },
					{ data: 'date', name: 'date' },
					{ data: 'amount', name: 'amount' },
					{ data: 'purpose_name', name: 'purpose_name' }
				],
				responsive: true,
				language: {
					processing: "Loading..."
				}
			});

			// Initialize DataTable for Attendance
			$('#attendance_table').DataTable({
				processing: true,
				serverSide: true,
				ajax: "{{ route('student.attendances', $student->dhakila_number) }}",
				columns: [
					{ data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
					{ data: 'date', name: 'date' },
					{ data: 'attendance_type', name: 'attendance_type' },
					{ data: 'remark', name: 'remark' }
				],
				responsive: true,
				language: {
					processing: "Loading..."
				}
			});
		});
	</script>



	{{-- <div class="row row-cols-1 row-cols-xxl-6 row-cols-lg-3 row-cols-md-2">
		<div class="col">
			<div class="card widget-icon-box">
				<div class="card-body">
					<div class="d-flex justify-content-between">
						<div class="flex-grow-1 overflow-hidden">
							<h5 class="text-muted text-uppercase fs-13 mt-0" title="Number of Customers">Total
								Students</h5>
							<h3 class="my-3">54,214</h3>
							<p class="mb-0 text-muted text-truncate">
								<span class="badge bg-success me-1"><i class="ri-arrow-up-line"></i>
									2,541</span>
								<span>Since last month</span>
							</p>
						</div>
						<div class="avatar-sm flex-shrink-0">
							<span class="avatar-title text-bg-success rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
								<i class="ri-group-line"></i>
							</span>
						</div>
					</div>
				</div> <!-- end card-body-->
			</div> <!-- end card-->
		</div> <!-- end col-->

		<div class="col">
			<div class="card widget-icon-box">
				<div class="card-body">
					<div class="d-flex justify-content-between">
						<div class="flex-grow-1 overflow-hidden">
							<h5 class="text-muted text-uppercase fs-13 mt-0" title="Number of Orders">
								Orders</h5>
							<h3 class="my-3">7,543</h3>
							<p class="mb-0 text-muted text-truncate">
								<span class="badge bg-danger me-1"><i class="ri-arrow-down-line"></i>
									1.08%</span>
								<span>Since last month</span>
							</p>
						</div>
						<div class="avatar-sm flex-shrink-0">
							<span class="avatar-title text-bg-info rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
								<i class="ri-shopping-basket-2-line"></i>
							</span>
						</div>
					</div>
				</div> <!-- end card-body-->
			</div> <!-- end card-->
		</div> <!-- end col-->

		<div class="col">
			<div class="card widget-icon-box">
				<div class="card-body">
					<div class="d-flex justify-content-between">
						<div class="flex-grow-1 overflow-hidden">
							<h5 class="text-muted text-uppercase fs-13 mt-0" title="Average Revenue">
								Revenue</h5>
							<h3 class="my-3">$9,254</h3>
							<p class="mb-0 text-muted text-truncate">
								<span class="badge bg-danger me-1"><i class="ri-arrow-down-line"></i>
									7.00%</span>
								<span>Since last month</span>
							</p>
						</div>
						<div class="avatar-sm flex-shrink-0">
							<span class="avatar-title text-bg-danger rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
								<i class="ri-money-dollar-circle-line"></i>
							</span>
						</div>
					</div>

				</div> <!-- end card-body-->
			</div> <!-- end card-->
		</div> <!-- end col-->

		<div class="col">
			<div class="card widget-icon-box">
				<div class="card-body">
					<div class="d-flex justify-content-between">
						<div class="flex-grow-1 overflow-hidden">
							<h5 class="text-muted text-uppercase fs-13 mt-0" title="Growth">Growth
							</h5>
							<h3 class="my-3">+ 20.6%</h3>
							<p class="mb-0 text-muted text-truncate">
								<span class="badge bg-success me-1"><i class="ri-arrow-up-line"></i>
									4.87%</span>
								<span>Since last month</span>
							</p>
						</div>
						<div class="avatar-sm flex-shrink-0">
							<span class="avatar-title text-bg-primary rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
								<i class="ri-donut-chart-line"></i>
							</span>
						</div>
					</div>

				</div> <!-- end card-body-->
			</div> <!-- end card-->
		</div> <!-- end col-->
		<div class="col">
			<div class="card widget-icon-box">
				<div class="card-body">
					<div class="d-flex justify-content-between">
						<div class="flex-grow-1 overflow-hidden">
							<h5 class="text-muted text-uppercase fs-13 mt-0" title="Conversation Ration">
								Conversation</h5>
							<h3 class="my-3">9.62%</h3>
							<p class="mb-0 text-muted text-truncate">
								<span class="badge bg-success me-1"><i class="ri-arrow-up-line"></i>
									3.07%</span>
								<span>Since last month</span>
							</p>
						</div>
						<div class="avatar-sm flex-shrink-0">
							<span class="avatar-title text-bg-warning rounded rounded-3 fs-3 widget-icon-box-avatar">
								<i class="ri-pulse-line"></i>
							</span>
						</div>
					</div>

				</div> <!-- end card-body-->
			</div> <!-- end card-->
		</div> <!-- end col-->
		<div class="col">
			<div class="card widget-icon-box">
				<div class="card-body">
					<div class="d-flex justify-content-between">
						<div class="flex-grow-1 overflow-hidden">
							<h5 class="text-muted text-uppercase fs-13 mt-0" title="Conversation Ration">Balance
							</h5>
							<h3 class="my-3">$168.5k</h3>
							<p class="mb-0 text-muted text-truncate">
								<span class="badge bg-success me-1"><i class="ri-arrow-up-line"></i>
									18.34%</span>
								<span>Since last month</span>
							</p>
						</div>
						<div class="avatar-sm flex-shrink-0">
							<span class="avatar-title text-bg-dark rounded rounded-3 fs-3 widget-icon-box-avatar">
								<i class="ri-wallet-3-line"></i>
							</span>
						</div>
					</div>

				</div> <!-- end card-body-->
			</div> <!-- end card-->
		</div> <!-- end col-->
	</div> <!-- end row --> --}}

	{{-- <div class="row">
		<div class="col-lg-4">
			<div class="card">
				<div class="d-flex card-header justify-content-between align-items-center">
					<h4 class="header-title">Total Sales</h4>
					<div class="dropdown">
						<a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
							aria-expanded="false">
							<i class="ri-more-2-fill"></i>
						</a>
						<div class="dropdown-menu dropdown-menu-animated dropdown-menu-end">
							<!-- item-->
							<a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
							<!-- item-->
							<a href="javascript:void(0);" class="dropdown-item">Export Report</a>
							<!-- item-->
							<a href="javascript:void(0);" class="dropdown-item">Profit</a>
							<!-- item-->
							<a href="javascript:void(0);" class="dropdown-item">Action</a>
						</div>
					</div>
				</div>

				<div class="card-body pt-0">
					<div id="average-sales" class="apex-charts mb-3 mt-n5" data-colors="#4254ba">
					</div>

					<h5 class="mb-1 mt-0 fw-normal">Brooklyn, New York</h5>
					<div class="progress-w-percent">
						<span class="progress-value fw-bold">72k </span>
						<div class="progress progress-sm">
							<div class="progress-bar" role="progressbar" style="width: 72%;" aria-valuenow="72"
								aria-valuemin="0" aria-valuemax="100"></div>
						</div>
					</div>

					<h5 class="mb-1 mt-0 fw-normal">The Castro, San Francisco</h5>
					<div class="progress-w-percent">
						<span class="progress-value fw-bold">39k </span>
						<div class="progress progress-sm">
							<div class="progress-bar" role="progressbar" style="width: 39%;" aria-valuenow="39"
								aria-valuemin="0" aria-valuemax="100"></div>
						</div>
					</div>

					<h5 class="mb-1 mt-0 fw-normal">Kovan, Singapore</h5>
					<div class="progress-w-percent mb-0">
						<span class="progress-value fw-bold">61k </span>
						<div class="progress progress-sm">
							<div class="progress-bar" role="progressbar" style="width: 61%;" aria-valuenow="61"
								aria-valuemin="0" aria-valuemax="100"></div>
						</div>
					</div>
				</div> <!-- end card-body-->
			</div> <!-- end card-->
		</div> <!-- end col-->
		<div class="col-lg-8">
			<div class="card">
				<div class="d-flex card-header justify-content-between align-items-center">
					<h4 class="header-title">Revenue</h4>
					<div class="dropdown">
						<a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
							aria-expanded="false">
							<i class="ri-more-2-fill"></i>
						</a>
						<div class="dropdown-menu dropdown-menu-animated dropdown-menu-end">
							<!-- item-->
							<a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
							<!-- item-->
							<a href="javascript:void(0);" class="dropdown-item">Export Report</a>
							<!-- item-->
							<a href="javascript:void(0);" class="dropdown-item">Profit</a>
							<!-- item-->
							<a href="javascript:void(0);" class="dropdown-item">Action</a>
						</div>
					</div>
				</div>
				<div class="card-body p-0">
					<div class="bg-light-subtle border-top border-bottom border-light">
						<div class="row text-center">
							<div class="col">
								<p class="text-muted mt-3"><i class="ri-donut-chart-fill"></i> Current
									Week</p>
								<h3 class="fw-normal mb-3">
									<span>$1705.54</span>
								</h3>
							</div>
							<div class="col">
								<p class="text-muted mt-3"><i class="ri-donut-chart-fill"></i>
									Previous Week</p>
								<h3 class="fw-normal mb-3">
									<span>$6,523.25 <i class="ri-corner-right-up-fill text-success"></i></span>
								</h3>
							</div>
							<div class="col">
								<p class="text-muted mt-3"><i class="ri-donut-chart-fill"></i>
									Conversation</p>
								<h3 class="fw-normal mb-3">
									<span>8.27%</span>
								</h3>
							</div>
							<div class="col">
								<p class="text-muted mt-3"><i class="ri-donut-chart-fill"></i>
									Customers</p>
								<h3 class="fw-normal mb-3">
									<span>69k <i class="ri-corner-right-down-line text-danger"></i></span>
								</h3>
							</div>
						</div>
					</div>
				</div>
				<div class="card-body pt-0">
					<div dir="ltr">
						<div id="revenue-chart" class="apex-charts mt-1" data-colors="#4254ba,#17a497"></div>
					</div>
				</div> <!-- end card-body-->
			</div> <!-- end card-->
		</div> <!-- end col-->
	</div> --}}
	<!-- end row -->

	{{-- <div class="row">
		<div class="col-xl-7">
			<div class="card">
				<div class="d-flex card-header justify-content-between align-items-center">
					<h4 class="header-title">Revenue By Locations</h4>
					<div class="dropdown">
						<a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
							aria-expanded="false">
							<i class="ri-more-2-fill"></i>
						</a>
						<div class="dropdown-menu dropdown-menu-animated dropdown-menu-end">
							<!-- item-->
							<a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
							<!-- item-->
							<a href="javascript:void(0);" class="dropdown-item">Export Report</a>
							<!-- item-->
							<a href="javascript:void(0);" class="dropdown-item">Profit</a>
							<!-- item-->
							<a href="javascript:void(0);" class="dropdown-item">Action</a>
						</div>
					</div>
				</div>

				<div class="card-body">
					<div class="row">
						<div class="col-lg-8">
							<div id="world-map-markers" class="mt-3 mb-3" style="height: 317px">
							</div>
						</div>
						<div class="col-lg-4" dir="ltr">
							<div id="country-chart" class="apex-charts" data-colors="#17a497"></div>
						</div>
					</div>
				</div>
			</div> <!-- end card-->
		</div> <!-- end col -->
		<div class="col-xl-5">
			<div class="card">
				<div class="d-flex card-header justify-content-between align-items-center">
					<h4 class="header-title">Top Selling Products</h4>
					<a href="javascript:void(0);" class="btn btn-sm btn-info">Export <i
							class="ri-download-line ms-1"></i></a>
				</div>
				<div class="card-body p-0">
					<div class="table-responsive">
						<table class="table table-borderless table-hover table-nowrap table-centered m-0">
							<thead class="border-top border-bottom bg-light-subtle border-light">
								<tr>
									<th class="py-1">Product</th>
									<th class="py-1">Price</th>
									<th class="py-1">Orders</th>
									<th class="py-1">Avl. Quantity</th>
									<th class="py-1">Seller</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>ASOS Ridley High Waist</td>
									<td>$79.49</td>
									<td>82</td>
									<td>8,540</td>
									<td>Adidas</td>
								</tr>
								<tr>
									<td>Marco Lightweight Shirt</td>
									<td>$12.5</td>
									<td>58</td>
									<td>6,320</td>
									<td>Puma</td>
								</tr>
								<tr>
									<td>Half Sleeve Shirt</td>
									<td>$9.99</td>
									<td>254</td>
									<td>10,258</td>
									<td>Nike</td>
								</tr>
								<tr>
									<td>Lightweight Jacket</td>
									<td>$69.99</td>
									<td>560</td>
									<td>1,020</td>
									<td>Puma</td>
								</tr>
								<tr>
									<td>Marco Sport Shoes</td>
									<td>$119.99</td>
									<td>75</td>
									<td>357</td>
									<td>Adidas</td>
								</tr>
								<tr>
									<td>Custom Women's T-shirts</td>
									<td>$45.00</td>
									<td>85</td>
									<td>135</td>
									<td>Branded</td>
								</tr>
								<tr>
									<td>Marco Sport Shoes</td>
									<td>$119.99</td>
									<td>75</td>
									<td>357</td>
									<td>Adidas</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="text-center">
						<a href="#!" class="text-primary text-decoration-underline fw-bold btn mb-2">View
							All</a>
					</div>
				</div>
			</div>
		</div> <!-- end col -->
	</div>
	<!-- end row --> --}}

	{{-- <div class="row">
		<div class="col-xl-4 col-lg-6">
			<div class="card">
				<div class="d-flex card-header justify-content-between align-items-center">
					<h4 class="header-title">Channels</h4>
					<a href="javascript:void(0);" class="btn btn-sm btn-success">Export <i
							class="ri-download-line ms-1"></i></a>
				</div>

				<div class="card-body p-0">

					<div class="table-responsive">
						<table class="table table-sm table-centered table-hover table-borderless mb-0">
							<thead class="border-top border-bottom bg-light-subtle border-light">
								<tr>
									<th>Channel</th>
									<th>Visits</th>
									<th style="width: 40%;">Progress</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Direct</td>
									<td>2,050</td>
									<td>
										<div class="progress" style="height: 3px;">
											<div class="progress-bar" role="progressbar" style="width: 65%;"
												aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
									</td>
								</tr>
								<tr>
									<td>Organic Search</td>
									<td>1,405</td>
									<td>
										<div class="progress" style="height: 3px;">
											<div class="progress-bar bg-info" role="progressbar" style="width: 45%;"
												aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
									</td>
								</tr>
								<tr>
									<td>Refferal</td>
									<td>750</td>
									<td>
										<div class="progress" style="height: 3px;">
											<div class="progress-bar bg-warning" role="progressbar" style="width: 30%;"
												aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
									</td>
								</tr>
								<tr>
									<td>Social</td>
									<td>540</td>
									<td>
										<div class="progress" style="height: 3px;">
											<div class="progress-bar bg-danger" role="progressbar" style="width: 25%;"
												aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
									</td>
								</tr>
								<tr>
									<td>Other</td>
									<td>8,965</td>
									<td>
										<div class="progress" style="height: 3px;">
											<div class="progress-bar bg-success" role="progressbar" style="width: 30%"
												aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div> <!-- end table-responsive-->
				</div> <!-- end card-body-->
			</div> <!-- end card-->
		</div> <!-- end col-->

		<div class="col-xl-4 col-lg-6">
			<div class="card">
				<div class="d-flex card-header justify-content-between align-items-center">
					<h4 class="header-title">Social Media Traffic</h4>
					<a href="javascript:void(0);" class="btn btn-sm btn-success">Export <i
							class="ri-download-line ms-1"></i></a>
				</div>

				<div class="card-body p-0">

					<div class="table-responsive">
						<table class="table table-sm table-centered table-hover table-borderless mb-0">
							<thead class="border-top border-bottom bg-light-subtle border-light">
								<tr>
									<th>Network</th>
									<th>Visits</th>
									<th style="width: 40%;">Progress</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Facebook</td>
									<td>2,250</td>
									<td>
										<div class="progress" style="height: 3px;">
											<div class="progress-bar" role="progressbar" style="width: 65%"
												aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
									</td>
								</tr>
								<tr>
									<td>Instagram</td>
									<td>1,501</td>
									<td>
										<div class="progress" style="height: 3px;">
											<div class="progress-bar" role="progressbar" style="width: 45%"
												aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
									</td>
								</tr>
								<tr>
									<td>Twitter</td>
									<td>750</td>
									<td>
										<div class="progress" style="height: 3px;">
											<div class="progress-bar" role="progressbar" style="width: 30%"
												aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
									</td>
								</tr>
								<tr>
									<td>LinkedIn</td>
									<td>540</td>
									<td>
										<div class="progress" style="height: 3px;">
											<div class="progress-bar" role="progressbar" style="width: 25%"
												aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
									</td>
								</tr>
								<tr>
									<td>Other</td>
									<td>13,851</td>
									<td>
										<div class="progress" style="height: 3px;">
											<div class="progress-bar" role="progressbar" style="width: 52%"
												aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div> <!-- end table-responsive-->
				</div> <!-- end card-body-->
			</div> <!-- end card-->
		</div> <!-- end col-->

		<div class="col-xl-4 col-lg-12">
			<div class="card">
				<div class="d-flex card-header justify-content-between align-items-center">
					<h4 class="header-title">Engagement Overview</h4>
					<a href="javascript:void(0);" class="btn btn-sm btn-success">Export <i
							class="ri-download-line ms-1"></i></a>
				</div>

				<div class="card-body p-0">

					<div class="table-responsive">
						<table class="table table-sm table-centered table-hover table-borderless mb-0">
							<thead class="border-top border-bottom bg-light-subtle border-light">
								<tr>
									<th>Duration (Secs)</th>
									<th style="width: 30%;">Sessions</th>
									<th style="width: 30%;">Views</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>0-30</td>
									<td>2,250</td>
									<td>4,250</td>
								</tr>
								<tr>
									<td>31-60</td>
									<td>1,501</td>
									<td>2,050</td>
								</tr>
								<tr>
									<td>61-120</td>
									<td>750</td>
									<td>1,600</td>
								</tr>
								<tr>
									<td>121-240</td>
									<td>540</td>
									<td>1,040</td>
								</tr>
								<tr>
									<td>141-420</td>
									<td>56</td>
									<td>886</td>
								</tr>
							</tbody>
						</table>
					</div> <!-- end table-responsive-->
				</div> <!-- end card-body-->
			</div> <!-- end card-->
		</div> <!-- end col-->

	</div> --}}
	<!-- end row -->
@endsection