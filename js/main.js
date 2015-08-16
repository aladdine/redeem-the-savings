
$( document ).ready(function() {

	$("#jumbotron-water-start").attr("href", "water-form.php");

	$("#jumbotron-electricity-start").attr("href", "electricity-form.php");


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
});
