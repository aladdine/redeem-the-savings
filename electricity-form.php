<?php include 'header.php';?>
<div class="container electricity-form">
	<div class="row">
		<div class="col-md-12">
		<h2>1- Upload Bill:</h2>
		 

		<form id="air_tickets_form">
  
		  <div class="form-group">
		    <p><input type="hidden" name="apikey" value="e1c97619-b755-4fb0-8fec-e06d8594962e"></p>
		   
		    <input class="col-md-5" type="file" id="air_tickets" name="file">
		    <span><input  class="col-md-5 btn-primary" type="submit"></span>
		  </div>
	</form>





		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
		<h2>2- Fill Information:</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
		<h2>3- Check Points:</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
		<h2>4- Redeem:</h2>
		</div>
	</div>
</div>

<? include 'footer.php';?>     



<script>
 $("form#air_tickets_form").submit(function(event){
 
	   //disable the default form submission
		event.preventDefault();
 
		//grab all form data  
		var formData = new FormData($(this)[0]);

  $.ajax({
    url: 'https://api.idolondemand.com/1/api/sync/extracttext/v1',
    type: 'POST',
    data: formData,
    async: false,
    cache: false,
    contentType: false,
    processData: false,
    success: function (data) {
    
        console.log(data.document[0].content);
       

    }
  });
});
</script>