<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Mail</title>
    <style>
.mail{
                margin: auto;
                width: 50%;
                background-color: #F5F5F5;
                padding: 15px;         
      }      
      .button {
  background-color: #4E73DF; /* Green */
  border: none;
  color: white;
  text-align: center;
  text-decoration: none;
  cursor: pointer;
  border-radius: 4px;
  padding: 10px 20px;
}
      

</style>
</head>
<body>
    <div class="mail">    
        <h2>{{$details['title']}}</h2>
        <h4>{{$details['body']}}</h4>
        <div style="display: flex;
                    justify-content: center;
                    align-items: center;
                    margin-top:3rem;
                    margin-left:12rem;
                    ">
                    <?php echo '<a class="button" style="color: white;" href="http://localhost:3000/setPassword/'.$details['token'].'">Change your Password</a>'?>
                    
        </div>
        
        <p>Thank You</p>
    </div>

</body>
</html>