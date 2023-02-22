<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
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



        <div id="contentContainer" style="justify-content: center;
            display: flex;">
            <img src="{{ $images[0] }}" alt="Image 1">

        </div>
        <section class="mysection">
            {{-- <button id="prev-btn">Previous</button> --}}
            <button id="next-btn">Next</button>
        </section>

    </div>
</body>
<script>
    $(document).ready(function() {
        var images = {!! json_encode($images) !!};
        var currentImage = 0;
        var totalImages = images.length;

        $('#prev-btn').click(function() {
            currentImage--;
            if (currentImage < 0) {
                currentImage = totalImages - 1;
            }
            $('#contentContainer img').attr('src', images[currentImage]);
        });

        $('#next-btn').click(function() {
            currentImage++;
            if (currentImage >= totalImages) {
                currentImage = 0;
            }
            $('#contentContainer img').attr('src', images[currentImage]);
        });
    });
</script>


</html>
