<!DOCTYPE html>
<html>
<head>
	<title>Uday Khuman | Coalition Test | Products</title>	
	<link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ URL::asset('css/bootstrap-table.min.css') }}" rel="stylesheet">
	<link href="{{ URL::asset('css/toastr.css') }}" rel="stylesheet">
	<link href="{{ URL::asset('css/product.css') }}" rel="stylesheet">
</head>
<body>

	<div class="container">
		<h4>Add New Product</h4>
		<table class="table">		 
		  	<tbody>
			    <tr >
			      	<td>
				      	<div class="form-group " id="productName">
							<label for="Product Name:">Product Name:</label>
							<input class="form-control" placeholder="Enter Product Name" name="productName" type="text" required="required">
							<br />
							<span class="text-danger"></span>
						</div>
			      	</td>
			      	<td>
		      			<div class="form-group " id="quantity">
							<label for="Quantity in stock:">Quantity In Stock:</label>
							<input class="form-control" placeholder="Enter Quantity" name="quantity" type="number" required="required">
							<br />
							<span class="text-danger"></span>
						</div>	
			      	</td>
			      	<td>
			      		<div class="form-group " id="pricePerUnit">
							<label for="Price per Unit:">Price Per Unit:</label>
							<input class="form-control" placeholder="Enter Price per unit" name="pricePerUnit" type="number" required="required">
							<br />
							<span class="text-danger"></span>
						</div>
			      	</td>
			      	<td>
			      		<div class="form-group ">
			      			<br />
		      				<button class="btn btn-success" onclick="saveProduct('')">Save</button>
			      		</div>
			      	</td>
			    </tr>		   
		  	</tbody>
		</table>
		<h4>Product Listing</h4>
		<table class="table" id="productTable" style ="text-align: center;">
			<thead>
				<tr>
					<th scope="col" style ="text-align: center;">SR#</th>
					<th scope="col" style ="text-align: center;">Name</th>
					<th scope="col" style ="text-align: center;">Quntity in stock</th>
					<th scope="col" style ="text-align: center;">Price/Unit</th>
					<th scope="col" style ="text-align: center;">Total Amount</th>
					<th scope="col" style ="text-align: center;">Date added</th>
					<th scope="col" style ="text-align: center;">Json File</th>
					<th scope="col" colspan="3" style ="text-align: center;">Actions</th>
				</tr>
			</thead>		 
		  	<tbody id="productsTableData"></tbody>
		  	<thead>
		  		<tr>
		  			<td></td>
		  			
		  			<td>
		  				<div class="form-group ">
							<label for="Sum:">Sum:</label>
						</div>
		  			</td>
		  			<td>
		  				<div class="form-group ">
							<label for="sumOfQuantity:" id="sumOfQuantity"></label>
						</div>
		  			</td>
		  			<td>
		  				<div class="form-group ">
							<label for="totalSum:" id="totalSum">Sum:</label>
						</div>
		  			</td>
		  			<td></td>
		  			<td></td>
		  		</tr>
		  	</thead>
		</table>
	</div>
	<div id="overlay">
	  	<div class="cv-spinner">
	    	<span class="spinner"></span>
	 	</div>
	</div>
</body>
	<!-- Scripts -->
	<script type="text/javascript">
		var AppURL = "<?php echo config('app.url');?>";
	</script>
    <script src="{{ URL::asset('js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap-table.min.js') }}"></script>
    <script src="{{ URL::asset('js/toastr.js') }}"></script>
    <script src="{{ URL::asset('js/product.js') }}"></script>
</html>