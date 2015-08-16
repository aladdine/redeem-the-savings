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
		  	<th width='33%'><p>Upload bill before savings</p></th>
		  	<th width='33%'><p class='after-savings-bill-upload'>Upload bill after savings</p></th>
		  	<th width='33%'><p class='savings-display'>Calculated savings</p></th>
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
		  			<form id="air_tickets_form" class='after-savings-bill-upload' >
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
	
		
		<h2>2- Add Points:</h2>
	<div class="row">	
           <div class="col-md-6">
           		<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1">How many people live in this property?</span>
				  <input type="number" id="people_in_the _property" class="form-control" placeholder="example 5" aria-describedby="basic-addon1">
				</div>

				<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1">How many hours did you water the lawn for achieving these savings?</span>
				  <input type="text" class="form-control" placeholder="example 5" aria-describedby="basic-addon1">
				</div>

				<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1">How many bedrooms are in this property?</span>
				  <input type="number" class="form-control" placeholder="example 5" aria-describedby="basic-addon1">
				</div>
                
				<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1">How many bathrooms in this property?</span>
				  <input type="number" class="form-control" placeholder="example 3" aria-describedby="basic-addon1">
				</div>

				<div class="form-group">
				  <label for="sel1">Did you use/do any of these to achieve savings?</label>
				  <select class="form-control" id="sel1" multiple>
				    <option value="5">Efficient shower head</option>
				    <option value="10">Recycling water from the sink</option>
				    <option value="15">Less then 5 laundry loads per month </option>
				    <option value="20">Got the pipes checked for leakage </option>
				  </select>
				</div>
           </div>	

            <div class="col-md-6">
           		<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1">Added Points:</span>
				  <input type="text" class="form-control" id="people_in_the _property_points" value="0 points" aria-describedby="basic-addon1" readonly>
				</div>
				<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1">Added Points:</span>
				  <input type="text" class="form-control" value="0 points" aria-describedby="basic-addon1" readonly>
				</div>
				<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1">Points earned</span>
				  <input type="text" class="form-control" value="0 points" aria-describedby="basic-addon1" readonly>
				</div>
				<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1">Points earned</span>
				  <input type="text" class="form-control" value="0 points" aria-describedby="basic-addon1" readonly>
				</div>
				<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1">Points earned</span>
				  <input type="text" class="form-control" value="0 points" aria-describedby="basic-addon1" readonly>
				</div>
				


				
           </div>		

	</div>

	
	<div class="row">
		<div class="col-md-12">
		<h2>3- Redeem:</h2>
		<div id="total-points"><p class='output'>Total points earned: 0 points</p></div>
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
        $(".after-savings-bill-upload").fadeIn();
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
        $(".savings-display").show();
         
        
        savings_gallons = consumption_before - consumption_after;

        savings_percent = savings_gallons / consumption_before * 100; 

         $("#water-savings").html("<p class='output'>Your month to month savings are: " + savings_gallons + " gallons (" + savings_percent + "%)</p>");
	         if (savings_percent >= 0) {
                 points = savings_percent * 2 + 20;
              //   id="people_in_the _property"
                $("#total-points").html("<p class='output'>Total points earned: " + points + " points</p>");
                
	         }
    	}

    }
  });

});


</script>