<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Vertical (basic) form</h2>
  <form action="{{action('DemoController@xuLy')}}" method="post">
  {{ csrf_field() }}
  Your name:<br>
  <input type="text" name="name" >
  <br>
  Your email:<br>
  <input type="email" name="email" >
  <br>
  Comment:<br>
  <textarea rows="5" name="comment"></textarea>
  <br><br>
  <button type="submit"> Submit </button>
</form> 
</div>

</body>
</html>

    