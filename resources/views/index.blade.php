<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <link href="{{ asset('assets/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="{{ asset('assets/style.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</head>

<body>
    <div class="container container-card">
        <div class="card text-center" style="width:500px">

            <div class="card-body">
                <form action="{{route('find-email')}}" method="get">
                    @csrf
                <div class="form-group">
                    <label>Enter Your Email</label>
                    <input list="email34" type="text" class="form-control" name="email" id="email" placeholder="email@gmail.com">
                    <datalist id="email34">
                    </datalist>
                </div>
                <button type="submit" class="btn" style="color: white;
                height: 45px;
                background: #2DCDDF;
                font-size: 18px;
                width: 100px;">Next</button>
                </form>
            </div>

        </div>
    </div>
</body>
<script>
    $('input:checked').removeAttr('checked');

    var fetchApplicatlist = "{{route('fetch-emaillist')}}";
      $("#email").on("input", function() {
            var email = $(this).val();
            checkEmailSuggetion('#email34',email);
      });
     function checkEmailSuggetion(id,s_word){
     $.ajax({
        url: fetchApplicatlist,
        type: "GET",
        data: {'email':s_word},
        dataType:'JSON',
        
        success: function(response){
            if(response.status){
                //$('#name2').val(response.data)
                if(response.data.length > 0){
                    console.log("Data available");
                    var emails = [];
                    var $html = '';
                    $('#email34').html($html);
                    response.data.forEach((element)=>{
                        emails.push(element.email);
                        $html = $html + '<option value="' + element.email + '"/>';
                    });
                    $('#email34').html($html);
                    console.log(emails,"hjj");
                }
        }
    }
    });
}
</script>

</html>
