<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo URL;?>/assets/css/style.css">
	<title>Hello, world!</title>
  </head>
  <body>
  <div class="container-fluid px-1 px-sm-3 py-5 mx-auto">
    <div class="row d-flex justify-content-center">
        <div class="row card0">
            <div class="card1 col-lg-8 col-md-7">
                <small>the.weather</small>
                <div class="text-center">
                    <img class="image mt-5" src="https://i.imgur.com/M8VyA2h.png">
                </div>
                <div class="row px-3 mt-3 mb-3">
                    <h1 class="large-font mr-3" id ="temp">26&#176;</h1>
                    <div class="d-flex flex-column mr-3">
                        <h2 class="mt-3 mb-0" id="city">London</h2>
                        <small>10:36 - Tuesday, 22 Oct '19</small>
                    </div>
                    <div class="d-flex flex-column text-center">
                        <h3 class="fa fa-sun-o mt-4"></h3>
                        <small>Sunny</small>
                    </div>
                </div>
            </div>
            <div class="card2 col-lg-4 col-md-5">
                <div class="row px-3">
                    <input type="text" name="location" id="location" placeholder="Another location" class="mb-5">
                    <div class="fa fa-search mb-5 mr-0 text-center" onclick="search()"></div>
                </div>
                <div class="mr-5">
                   <p>Weather Details</p>
                    <div class="row px-3">
                        <p class="light-text">Cloudy</p>
                        <p class="ml-auto">12%</p>
                    </div>
                    <div class="row px-3">
                        <p class="light-text">Humidity</p>
                        <p class="ml-auto">78%</p>
                    </div>
                    <div class="row px-3">
                        <p class="light-text">Wind</p>
                        <p class="ml-auto">1km/h</p>
                    </div>
                    <div class="row px-3">
                        <p class="light-text">Rain</p>
                        <p class="ml-auto">0mm</p>
                    </div>

                    <div class="line mt-3"></div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Optional JavaScript -->



	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
 
<script>
	function search(){
		let location = $("#location").val();
		if(location == ""){
			alert("Enter Location To Get Weather Report");
			return false;
		}
		$.ajax({
			type:"post",
			url: "<?php echo URL;?>/welcome/getWeatherData",
			data:{
				location: location

			},
			success: function(response){
				let object = JSON.parse(response);
				if(object.cod == 404){
					alert(object.message);
					$('#location').val("");
					return false;
				}else{
					console.log(object);
					let temp = Math.round(object.list[0].main.temp - 273.15);
					let city = object.city.name;
					$("#city").text(city);
					$("#temp").text(temp);

					//  console.log(object.city.name);
				}
				// console.log(object.cod);

				// if(response.cod == 404){
				// 	alert(response.message);
					
				// }
				// console.log(response);

			},
			error: function(error){
				console.error(error);

			}
			

		});
		
	}

</script>

</body>
</html>