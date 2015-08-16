<?php include 'header.php';?>
<div class="jumbotron-water-rewards">
      <div class="container">
        <h1>Redeem Your Water Savings</h1>
      </div>
 </div>

<div class="container water-form">
     
	<div class="row">
		<div class="col-md-12">

		<h2>1- Upload Bills:</h2>
		

		<form id="air_tickets_form">
  
		  <div class="form-group">
		    <p><input type="hidden" name="apikey" value="e1c97619-b755-4fb0-8fec-e06d8594962e"></p>
		    <label for="air_tickets">Upload The After Saving Bill:</label>
		    <input class="col-md-3" type="file" id="air_tickets" name="file">
		    <span><input  class="btn-primary" type="submit"></span>
		  </div>	  
	   </form>

	     <form id="air_tickets_form_2">
  
		  <div class="form-group-2">
		    <p><input type="hidden" name="apikey" value="e1c97619-b755-4fb0-8fec-e06d8594962e"></p>
		    <label for="air_tickets_2">Upload The After Saving Bill:</label>
		    <input class="col-md-3" type="file" id="air_tickets_2" name="file">
		    <span><input  class="btn-primary" type="submit"></span>
		  </div>	  
	   </form>

          <div id="this-month-consumption"></div>
          <div id="this-month-consumption-2"></div>



		</div>
	</div>
	
		
		<h2>2- Fill Information:</h2>
	<div class="row">	
		<div class="input-group col-md-3">
	        <span class="input-group-addon" id="basic-addon1">How many people in the property?</span>
	        <input type="number" class="form-control" value="2" aria-describedby="basic-addon1">
        </div>

        <div class="input-group col-md-3">
	        <span class="input-group-addon" id="basic-addon2">Surface Area of the property?</span>
	        <input type="number" class="form-control" value="2" aria-describedby="basic-addon1">
        </div>

        <div class="input-group col-md-3">
	        <span class="input-group-addon" id="basic-addon3">Surface Area of the property?</span>
	        <input type="number" class="form-control" value="2" aria-describedby="basic-addon1">
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


        bill_content = data.document[0].content;

        check_bill = bill_content.search("CALIFORNIA AMERICAN WATER");
        if (check_bill < 0) {

         $("#this-month-consumption").html("<div class='alert alert-danger' role='alert'>Please upload a valid California American Water bill.</div>");	

        } else {

        this_month_consumption = bill_content.match(/ gallons\) Total Water Use Comparison/g);
        consumption = bill_content.indexOf(this_month_consumption[0]);
        consumption = bill_content.substring(consumption - 5, consumption);
        consumption = Number(consumption.replace(",",""));       
        console.log("cb: " + check_bill);
        $("#this-month-consumption").html("<h4>Monthly consumption before saving: " + consumption + " gallons</h4>");
        }
    }
  });

});

 $("form#air_tickets_form_2").submit(function(event){
 
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
        bill_content = data.document[0].content;

        check_bill = bill_content.search("CALIFORNIA AMERICAN WATER");
        if (check_bill < 0) {

         $("#this-month-consumption-2").html("<div class='alert alert-danger' role='alert'>Please upload a valid California American Water bill.</div>");	

        } else {

        this_month_consumption = bill_content.match(/ gallons\) Total Water Use Comparison/g);
        consumption = bill_content.indexOf(this_month_consumption[0]);
        consumption = bill_content.substring(consumption - 5, consumption);
        consumption = Number(consumption.replace(",",""));       
        console.log(consumption);

        $("#this-month-consumption-2").html("<h4>Monthly consumption after saving: " + consumption + " gallons</h4>");
    	}

    }
  });

});
</script>