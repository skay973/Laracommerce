@extends('layouts.main')

@section('page-title')
<header id="page-title">
	<div class="container">
		<h1>Order Detail</h1>

		<ul class="breadcrumb">
			<li><a href="index.html">Admin</a></li>
			<li><a href="#">Orders</a></li>
			<li class="active">Order Detail</li>
		</ul>
	</div>
</header>
@stop

@section('content')

@foreach($invoices as $invoice)
<section class="container printable"><!-- note class 'printable' - this area is printable only! -->

	<div class="white-row">

		<!-- INVOICE HEADER -->
		<div class="row">

			<div class="col-sm-6">
				<img class="img-responsive" src="{{ URL::asset('assets/images/logo.png') }}" alt="" />
			</div>

			<div class="col-sm-6 text-right">
				<p>
					{{ $invoice->id }} &bull; <strong>29 June 2014</strong>
					<br />
					Lid est laborum dolo rumes fugats untras.
				</p>
			</div>

		</div>
		<!-- /INVOICE HEADER -->

		<hr class="margin-top10 margin-bottom10" /><!-- separator -->

		<!-- DETAILS -->
		<div class="row">

			<div class="col-sm-6">

				<h4><strong>Client</strong> Details</h4>
				<ul class="list-unstyled">
					<li><strong>First Name:</strong> John</li>
					<li><strong>Last Name:</strong> Doe</li>
					<li><strong>Country:</strong> U.S.A.</li>
					<li><strong>DOB:</strong> YYYY/MM/DD</li>
				</ul>

			</div>

			<div class="col-sm-6">

				<h4><strong>Payment</strong> Details</h4>
				<ul class="list-unstyled">
					<li><strong>Bank Name:</strong> 012345678901</li>
					<li><strong>Account Number:</strong> 012345678901</li>
					<li><strong>SWIFT Code:</strong> SWITCH012345678CODE</li>
					<li><strong>V.A.T Reg #:</strong> VAT5678901CODE</li>
				</ul>

			</div>

		</div>
		<!-- /DETAILS -->
	</div>



	<!-- INVOICE BODY -->
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Payment <strong>Invoice</strong></h3>
		</div>

		<div class="panel-body">

			<p>Lid est laborum dolo rumes fugats untras. Etharums ser quidem rerum facilis dolores nemis omnis fugats vitaes nemo minima rerums unsers sadips amets.</p>

			<table class="table table-striped">
				<!-- table head -->
				<thead>
					<tr>
						<th>#</th>
						<th>Item Name</th>
						<th class="hidden-sm">Description</th>
						<th>Qty</th>
						<th>Unit price</th>
						<th>Total</th>
					</tr>
				</thead>

				<!-- table items -->
				<tbody>
					<tr><!-- item -->
						<td>1</td>
						<td>PC Case</td>
						<td class="hidden-sm">Unique side and front panel design with</td>
						<td>2</td>
						<td>$20</td>
						<td>$40</td>
					</tr>
					<tr><!-- item -->
						<td>2</td>
						<td>LCD Display</td>
						<td class="hidden-sm">Side panel with TAC 2.0 ventilation holes</td>
						<td>1</td>
						<td>$102</td>
						<td>$102</td>
					</tr>
					<tr><!-- item -->
						<td>3</td>
						<td>Mobile Phone</td>
						<td class="hidden-sm">Mesh front panel design to improve the airflow</td>
						<td>3</td>
						<td>$544</td>
						<td>$1632</td>
					</tr>
					<tr><!-- item -->
						<td>4</td>
						<td>HDD Disk</td>
						<td class="hidden-sm">Stylish mesh front panel strips to maximize air</td>
						<td>4</td>
						<td>$97</td>
						<td>$388</td>
					</tr>
				</tbody>
			</table>

		</div>

	</div>
	<!-- INVOICE BODY -->

	<hr class="half-margins invisible" /><!-- separator -->

	<!-- INVOICE FOOTER -->
	<div class="row">

		<div class="col-sm-6">
			<h4><strong>Contact</strong> Details</h4>

			<p class="nomargin nopadding">
				<strong>Note:</strong>
				Like other components, easily make a panel more meaningful to a particular context by adding any of the contextual state classes.
			</p><br /><!-- no P margin for printing - use <br> instead -->

			<address>
				PO Box 21132 <br>
				Vivas 2355 Australia<br>
				Phone: 1-800-565-2390 <br>
				Fax: 1-800-565-2390 <br>
				Email:support@yourname.com
			</address>

		</div>

		<div class="col-sm-6 text-right">

			<ul class="list-unstyled invoice-total-info">
				<li><strong>Sub - Total Amount:</strong> $2162.00</li>
				<li><strong>Discount:</strong> 10.0%</li>
				<li><strong>VAT ($6):</strong> $12.0</li>
				<li><strong>Grand Total:</strong> $1958.0</li>
			</ul>

			<div class="padding20">
				<button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
				<button class="btn btn-primary">Invoice Submit</button>
			</div>

		</div>

	</div>
	<!-- /INVOICE FOOTER -->

</section>
@endforeach
@stop
