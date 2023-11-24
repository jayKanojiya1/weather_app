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
	<title>Weather Details</title>
  </head>
  <body>
  <div class="container-fluid px-1 px-sm-3 py-5 mx-auto">
    <div class="row d-flex justify-content-center">
        <div class="row card0">
            <div class="card1 col-lg-8 col-md-7">
                <small>Weather Report</small>
                <div class="text-center">
                    <img class="image mt-5" src="https://i.imgur.com/M8VyA2h.png">
                </div>
                <div class="row px-3 mt-3 mb-3">
                    <h1 class="large-font mr-3" id ="temp">26&#176;</h1>
                    <div class="d-flex flex-column mr-3">
                        <h2 class="mt-3 mb-0" id="city">London</h2>
                        <p id="date">10:36 - Tuesday, 22 Oct '19</p>
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
                        <p class="light-text">Weather</p>
                        <p class="ml-auto" id="weather">12%</p>
                    </div>
                    <div class="row px-3">
                        <p class="light-text">Humidity</p>
                        <p class="ml-auto" id="humidity">78%</p>
                    </div>
                    <div class="row px-3">
                        <p class="light-text">Wind</p>
                        <p class="ml-auto" id="wind">1<span>km/h</span></p>
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
					const options = { day: 'numeric', month: 'short', year: 'numeric' };
					let date = new Date(object.list[0].dt * 1000).toLocaleDateString('en-US', options);
					let temp = Math.round(object.list[0].main.temp - 273.15);
					let wind = Math.round(object.list[0].wind.speed);
					let city = object.city.name;
					let humidity = object.list[0].main.humidity;
					let weather = object.list[0].weather[0].main;
					
					$("#city").text(city);
					$("#temp").text(temp);
					$("#date").text(date);
					$("#humidity").text(humidity+"%");
					
					$("#wind").text(wind+"km/h");
					$("#weather").text(weather);

				}
			

			},
			error: function(error){
				console.error(error);

			}
			

		});
		
	}

</script>

</body>
</html>