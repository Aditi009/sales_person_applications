<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="{{ asset('assets/style.css') }}" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <title>Document</title>
    <style>
        body {
            padding: 0px;
            margin: 0px;
            background-color: #191f2f;
        }


        .mysection {
            display: flex;
            height: 100px;
            width: 100%;
            align-items: center;
            justify-content: center;
        }

        input:focus {
            outline: none;
        }
    </style>
</head>

<body>
    <div id="formviewer">
        <div></div>
        <div id="overlay"></div>
        <div id="contentContainer" style="justify-content: center;
            display: flex;    margin-top: 10%;">
            <img src="{{ asset('assets/images/end.jpeg') }}" alt="Image 1">
        </div>
    </div>
    <script>
        setTimeout(function(){
               window.location.href = "{{url('/')}}" 
            },5000)
    </script>
</body>

</html>
