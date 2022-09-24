
<!DOCTYPE html>
<html>
<head>
    <title>@yield('page-title') Contact book</title>
    <link rel="icon" type="views/png" href="{{ asset('Fav_Icon.png') }}" />
    <style>
        img{
            border-radius: 50%;   
        }

        thead{
            background:#000000;
            color:#ffffff
        }

        tr:nth-child(even) {
  background-color: #f8f9fa;
}

th, td {
  text-align: center;
  padding: 5px;
}


    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"/>
    
</head>

<body>
    <center><img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('Con_Book_Logo_Blue.svg'))) }}"  width="169px" height="34px"></center>
    <p></p>
    </div>
        <table class="table table-striped ">
            <thead >
                <tr >
                    <th scope="col">ID</th>
                    <th scope="col">Image</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                </tr>
            </thead>
            <tbody>

                @foreach($contact ?? '' as $data)
                <tr>
                    <th scope="row">{{ $data->id }}</th>
                    <td>
                        @if($data->image != "")
                        <img src="{{ $data->image }}"width= "38px", height= "38px"  /></td>
                        @else
                        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('Avatar.svg'))) }}"width= "38px", height= "38px"  /></td>
                        @endif
                    <td>{{ $data->first_name }}</td>
                    <td>{{ $data->last_name }}</td>
                    <td>{{ $data->email }}</td>
                    <td>{{ $data->phone }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>