{{-- <!DOCTYPE html>
<html>
<head>
    <title>Import Export Excel to database Example</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
</head>
<body>
   
<div class="container">
    <div class="card bg-light mt-3">
    <div class="card-header">
        Import Attribute
        </div>
        <div class="card-body">
            <form action="{{route('attributestore')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control">
                <br>
                <button class="btn btn-success">Import Attribute Data</button> 
            </form>
        </div>
    </div>
</div>
</body>
</html>  --}}

{{-- <html>
<head>
<title>Import Excel File in Laravel</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<br />

<div class="container">
 <h3 align="center">Import Excel File in Laravel</h3>
  <br />
 @if(count($errors) > 0)
  <div class="alert alert-danger">
   Upload Validation Error<br><br>
   <ul>
    @foreach($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
   </ul>
  </div>
 @endif

 @if($message = Session::get('success'))
 <div class="alert alert-success alert-block">
  <button type="button" class="close" data-dismiss="alert">×</button>
         <strong>{{ $message }}</strong>
 </div>
 @endif
 <form method="post" enctype="multipart/form-data" action="{{ url('/import_excel/import') }}">
  {{ csrf_field() }}
  <div class="form-group">
   <table class="table">
    <tr>
     <td width="40%" align="right"><label>Select File for Upload</label></td>
     <td width="30">
      <input type="file" name="select_file" />
     </td>
     <td width="30%" align="left">
      <input type="submit" name="upload" class="btn btn-primary" value="Upload">
     </td>
    </tr>
    <tr>
     <td width="40%" align="right"></td>
     <td width="30"><span class="text-muted">.xls, .xslx</span></td>
     <td width="30%" align="left"></td>
    </tr>
   </table>
  </div>
 </form>
 
 <br />
 <div class="panel panel-default">
  <div class="panel-heading">
   <h3 class="panel-title">Customer Data</h3>
  </div>
  <div class="panel-body">
   <div class="table-responsive">
    <table class="table table-bordered table-striped">
     <tr>
      <th>Label</th>
      <th>Suggestion</th>
      <th>Type</th>
      <th>Required</th>    
     </tr>
     @foreach($data as $row)
     <tr>
      <td>{{ $row->label }}</td>
      <td>{{ $row->suggestion }}</td>
      <td>{{ $row->type }}</td>
      <td>{{ $row->required }}</td>     
     </tr>
     @endforeach
    </table>
   </div>
  </div>
 </div>
</div>
</body>
</html> --}}


<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Import Export Excel & CSV to Database in Laravel 7</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5 text-center">
        <h2 class="mb-4">
            Import and Export Attribute
        </h2>

        <form action="{{ url('/import_excel/import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">
                <div class="custom-file text-left">
                    <input type="file" name="file" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
            </div>
            <button class="btn btn-primary">Import data</button>
            <a class="btn btn-success" href="{{ url('import_excel') }}">Export data</a>
          
            <a class="btn btn-secondary" href="{{ url('sample/AttributeCollection.xlsx') }}">Download Sample</a>
        </form>
    </div>
</body>

</html>