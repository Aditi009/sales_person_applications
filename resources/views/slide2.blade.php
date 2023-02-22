<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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

        .mysection button {
            height: 40px;
            background-color: blue;
            border: none;
            color: white;
            font: 22px;
            cursor: pointer;
            width: 100px
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
        <form action="{{ route('store-applicant') }}" id='store-phone' method="POST">
            @csrf
            <div id="contentContainer" style="justify-content: center;
            display: flex;">
                <img src="{{asset('assets/images/Screenshot from 2023-02-22 18-37-00 (1).png')}}">
            </div>
        </form>
    </div>
</body>

</html>
