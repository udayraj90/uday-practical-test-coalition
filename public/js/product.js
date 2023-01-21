function validateFields(fields,id,separator){
	var message =  "";
	$.each(fields, function( index, value ) {
		var fieldValue = $.trim($("#"+value+id).children('input[name="'+value+'"]').val());
		var separator = typeof separator === 'undefined' ? ' ' : separator;
		var fieldName = value.replace(/([a-z\d])([A-Z])/g, '$1' + separator + '$2')
        .replace(/([A-Z]+)([A-Z][a-z\d]+)/g, '$1' + separator + '$2');

		var errorMessage = fieldValue.length<=0?fieldName + " is required":"";
		$("#"+value+id).children('.text-danger').text(errorMessage);
		message += errorMessage;
	});
	return message;	
}

function editProduct(id){
	$("#product"+id).find(".productData").addClass("hide");
	$("#product"+id).find(".productValue").removeClass("hide");
	$("#product"+id).find(".editProductButton").addClass("hide");
	$("#product"+id).find(".saveProductButton").removeClass("hide");
	$("#product"+id).find(".cancelProductButton").removeClass("hide");
}

function cancelEditProductMode(id){
	$("#product"+id).find(".productData").removeClass("hide");
	$("#product"+id).find(".productValue").addClass("hide");
	$("#product"+id).find(".editProductButton").removeClass("hide");
	$("#product"+id).find(".saveProductButton").addClass("hide");
	$("#product"+id).find(".cancelProductButton").addClass("hide");
	$('.text-danger').text("");
}

function loadProducts(){
	$.ajax({
	    type:'POST',
	    url: AppURL+'api/loadProducts',
	    data:{searchText : ""},
	    dataType:'json',
	    async: false,
	    success:function(data){
	        if(data.success){
	        	var productsTableHtml = "";
	        	$.each(data.data.productList, function( index, value ) {
					 productsTableHtml += '<tr id="product'+value.id+'"><td><div class="form-group " ><span for="Price per unit:">'+value.SR+'</span></div></td>';
					 productsTableHtml += '<td><div class="form-group " id="productName'+value.id+'"><span for="Product Name:" class="productData">'+value.productName+'</span><input class="form-control productValue hide" placeholder="Enter Product Name" name="productName" type="text" required="required" value="'+value.productName+'"><span class="text-danger"></span></div></td>';
					 productsTableHtml += '<td><div class="form-group " id="quantity'+value.id+'"><span for="Quantity:" class="productData">'+value.quantity+'</span><input class="form-control productValue hide" placeholder="Enter Quantity" name="quantity" required="required" value="'+value.quantity+'" type="number" ><span class="text-danger"></span></div></td>';
					 productsTableHtml += '<td><div class="form-group " id="pricePerUnit'+value.id+'"><span for="Price per unit:" class="productData">'+value.pricePerUnit+'</span><input class="form-control productValue hide" placeholder="Enter price" name="pricePerUnit" required="required" value="'+value.pricePerUnit+'" type="number" ><span class="text-danger"></span></div></td>';
					 productsTableHtml += '<td><div class="form-group " ><span for="Price per unit:">'+value.amount+'</span></div></td><td><div class="form-group " ><span">'+value.date_added+'</span></div></td></td><td><div class="form-group " ><span><a href="'+value.jsonFileNameURL
+'" target="_blank">'+value.jsonFileName+'</a></span></div></td>';
					 productsTableHtml += '<td class="editProductButton"><div class="form-group "><button type="button" class="btn btn-info btn-sm" onclick="editProduct('+value.id+')"><span class="glyphicon glyphicon-edit"></span> Edit</button></div></td><td class="saveProductButton hide"><div class="form-group "><button type="button" class="btn btn-success btn-sm" onclick="saveProduct('+value.id+')"><span class="glyphicon glyphicon-save"></span> Save</button></div></td><td class="cancelProductButton hide"><div class="form-group "><button type="button" class="btn btn-secondary btn-sm" onclick="cancelEditProductMode('+value.id+')"><span class="glyphicon glyphicon-remove"></span> Cancel</button></div></td>';
					 productsTableHtml += "</tr>";
				});
				$("#productsTableData").html(productsTableHtml);
				$("#totalSum").text(data.data.sum);
				$("#sumOfQuantity").text(data.data.sumOfQuantity);
				toastr.success(data.message);
				
			}else{
				toastr.error(data.message);
			}
	    },
	    beforeSend: function(){
	        $("#overlay").fadeIn();
	    },
	    complete: function(){
	        $("#overlay").fadeOut();
	    }
	}).fail(function (jqXHR, textStatus, errorThrown) {
		toastr.error(errorThrown);
	});
}

function saveProduct(id){
	var fieldsArray = ["productName","quantity","pricePerUnit"];
	var validationMessage = validateFields(fieldsArray,id);
	if(validationMessage.length > 0){
		return;
	}
	$.ajax({
	    type:'POST',
	    url: AppURL+'api/saveProduct',
	    data:{
			id : id,	
			productName : $.trim($("#productName"+id).children('input[name="productName"]').val()),	
			quantity : $.trim($("#quantity"+id).children('input[name="quantity"]').val()),	
			pricePerUnit : $.trim($("#pricePerUnit"+id).children('input[name="pricePerUnit"]').val()),
		},
	    dataType:'json',
	    async: false,
	    success:function(data){
	        if(data.success){
				toastr.success(data.message);
				loadProducts();
				resetForm(fieldsArray)
			}else{
				toastr.error(data.message);
			}
	    },
	    beforeSend: function(){
	        $("#overlay").fadeIn();
	    },
	    complete: function(){
	        $("#overlay").fadeOut();
	    }
	}).fail(function (jqXHR, textStatus, errorThrown) {
		toastr.error(errorThrown);
	});	
}

function resetForm(fields){
	$.each(fields, function( index, value ) {
		$("#"+value).children('input[name="'+value+'"]').val("");
	});
}

$( document ).ready(function() {
    loadProducts();
});
