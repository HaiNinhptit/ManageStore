<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
  <script src="{{asset('js/bootstrap.min.js')}}"></script>
  <script src="{{asset('jquery/jquery.min.js')}}"></script>
</head>
<body>

<div class="container">
  <h2>List User</h2>           
  <table class="table table-bordered">
    <thead>
      <tr>
        <th style="text-align:center;">Name</th>
        <th style="text-align:center;">Email</th>
        <th style="text-align:center;" colspan="3">Action</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>John</td>
        <td>Email</td>
        <td><button type="button" class="btn btn-success">Default</button></td>
        <td><button type="button" class="btn btn-success">Default</button></td>
        <td><button type="button" class="btn btn-success">Default</button></td>
      </tr>
      <tr>
        <td>Mary</td>
        <td>Moe</td>
        <td><button type="button" class="btn btn-success">Default</button></td>
        <td><button type="button" class="btn btn-success">Default</button></td>
        <td><button type="button" class="btn btn-success">Default</button></td>
      </tr>
      <tr>
        <td>July</td>
        <td>Dooley</td>
        <td><button type="button" class="btn btn-success">Default</button></td>
        <td><button type="button" class="btn btn-success">Default</button></td>
        <td><button type="button" class="btn btn-success">Default</button></td>
      </tr>
    </tbody>
  </table>
</div>

</body>
</html>
