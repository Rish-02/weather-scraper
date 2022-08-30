<?php
  $weather= "";
  $error= "";
  if($_GET){

    if($_GET['city']){
      $city= str_replace(' ','', $_GET['city']);

    $file_headers = @get_headers("https://www.weather-forecast.com/locations/".$city."/forecasts/latest");
    
    
    if($file_headers[0] == 'HTTP/1.1 404 Not Found'){
      $error = "City not found";
    } else{

    $forecastPage = file_get_contents("https://www.weather-forecast.com/locations/".$city."/forecasts/latest");
    
    $pageArray = explode('</div><p class="b-forecast__table-description-content"><span class="phrase">',$forecastPage);
    $secondpageArray= explode('</span></p>',$pageArray[1]);
    $weather = $secondpageArray[0];
    }
    }

  }

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Weather Scraper</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style type ="text/css">
    body{
        background-image: url('shell2.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        height:100vh;
        color: white;
        }
    .container{
        text-align: center;
        margin: 5rem%;
        margin-top:15%;
        color: white;
    }    
    input{
      margin-top:2%;
    }

    </style>
  </head>
  <body>
    <div class="container">
      <h1><strong>What's The Weather?</strong></h1>
      <form>
        <div class="form-group">
          <label for="city"><strong>Enter the name of a place</strong></label><br>
    <input type="text" name= "city" style="width:300px" id="city" placeholder="Eg. Bangalore, London, Paris." value="<?php if($_GET){ echo $_GET['city'];} ?>">
</div>
<button type="submit" class="btn btn-primary">Submit</button>
</form><br>
    <div class="weather"><?php
      if($weather) {
        echo '<div class="alert alert-success" roles="alert">'.$weather.'</div>';
      } elseif($error) {
        echo '<div class="alert alert-danger" roles="alert">'.$error.'</div>';
      }
    ?></div>

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
