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

		<table class="table">
		  <tr>
		  	<th>Bill before savings</th>
		  	<th>Bill after savings</th>
		  	<th>Calculated savings </th>
		  </tr>

		  <tr>
		  	<td>
					<form id="air_tickets_form_2">
					  <div class="form-group-2">
					    <p><input type="hidden" name="apikey" value="e1c97619-b755-4fb0-8fec-e06d8594962e"></p>
					    <input class="col-md-3" type="file" id="air_tickets_2" name="file"> 
					    <span><input  class="btn-info" value="upload" type="submit"></span>
					  </div>	  
				   	</form>
				   	<div id="this-month-consumption"></div>
				   
		  	</td>
		  	<td>
		  			<form id="air_tickets_form">
					  <div class="form-group">
					    <p><input type="hidden" name="apikey" value="e1c97619-b755-4fb0-8fec-e06d8594962e"></p>
					    <input class="col-md-3" type="file" id="air_tickets" name="file">
					    <span><input  class="btn-info" value="upload" type="submit"></span>
					  </div>	  
				   	</form>
				   	<div id="this-month-consumption-2"></div>
		  	</td>
		  	<td> <div id="water-savings"></div> </td>
		  </tr>
  
       </table>
       <p>Note: Please make sure the bills are for 2 consecutive months.</p>
		

		

	    

          
          
         



		</div>
	</div>
	
		
		<h2>2- Fill Information:</h2>
	<div class="row">	
		

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

         $("#this-month-consumption").html("<div class='alert alert-danger' role='alert'>Please upload a valid California American Water bill.</div>");	

        } else {

        this_month_consumption = bill_content.match(/ gallons\) Total Water Use Comparison/g);

        bill_period_search = "Billing period:";	
        billing_period_start_index = bill_content.indexOf("Billing period:") + bill_period_search.length;
        billing_period_end_index = bill_content.indexOf("Next reading on or about");
        billing_period = bill_content.substring(billing_period_start_index, billing_period_end_index - 1 );

        consumption = bill_content.indexOf(this_month_consumption[0]);
        consumption = bill_content.substring(consumption - 5, consumption);
        consumption_before = Number(consumption.replace(",",""));       
        $("#this-month-consumption").html("<p class='output'>Monthly consumption before saving: " + consumption_before + " gallons</p>");
        $("#this-month-consumption").append("<p class='output'>Billing period: " + billing_period + "</p>");
        }
    }
  });

});

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

         $("#this-month-consumption-2").html("<div class='alert alert-danger' role='alert'>Please upload a valid California American Water bill.</div>");	

        } else {
        bill_period_search = "Billing period:";	
        billing_period_start_index = bill_content.indexOf("Billing period:") + bill_period_search.length;
        billing_period_end_index = bill_content.indexOf("Next reading on or about");
        billing_period = bill_content.substring(billing_period_start_index, billing_period_end_index - 1);

        this_month_consumption = bill_content.match(/ gallons\) Total Water Use Comparison/g);
        consumption = bill_content.indexOf(this_month_consumption[0]);
        consumption = bill_content.substring(consumption - 5, consumption);
        consumption_after = Number(consumption.replace(",",""));       
        console.log(consumption);

        $("#this-month-consumption-2").html("<p class='output'>Monthly consumption after saving: " + consumption_after + " gallons</p>");
        $("#this-month-consumption-2").append("<p class='output'>Billing period: " + billing_period + "</p>");
         
        
        savings_gallons = consumption_before - consumption_after;

        savings_percent = savings_gallons / consumption_before * 100; 

         $("#water-savings").html("<p class='output'>Your month to month savings are: " + savings_gallons + " gallons (" + savings_percent + "%)</p>");
    	}

    }
  });

});
</script>