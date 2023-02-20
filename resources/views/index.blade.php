<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    	<!-- Toastr -->
	
    <title>Document</title>
    <link href="{{ asset('assets/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="{{ asset('assets/style.js') }}" ></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" id="token"/>

</head>

<body>
  <form  action="{{route('store-applicant')}}" id='store-phone' method="POST">
    @csrf
    <div class="container border-1" style="padding:3px">
    <div class="container section-one">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group d-flex p-1">
                    <label class="btn btn-title">Date:</label>
                    <input type="text" class="ml-5 form-control">
                </div>
            </div>
            <div class="col-md-9">
                <div class="row d-flex">
                    <label class="btn btn-title">Division:</label>
                    <div class="checkbox-container" style="">
                        <input type="checkbox">
                        <span>US</span>
                    </div>
                    <div class="checkbox-container" style="">
                        <input type="checkbox">
                        <span>UK</span>
                    </div>
                    <div class="checkbox-container" style="">
                        <input type="checkbox">
                        <span>AU</span>
                    </div>
                    <div class="checkbox-container" style="">
                        <input type="checkbox">
                        <span>NZ</span>
                    </div>
                    <div class="checkbox-container" style="">
                        <input type="checkbox">
                        <span>DD</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="form-group d-flex p-1">
                    <label class="btn btn-title">Sale Agent Number:</label>
                    <input type="text" class="ml-5 form-control">
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group d-flex p-1">
                    <label class="btn btn-title">Sale Agent Person:</label>
                    <input type="text" class="ml-5 form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group d-flex p-1">
                    <label class="btn btn-title">Sale Agent Number:</label>
                    <input type="text" class="ml-5 form-control">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group d-flex p-1">
                    <label class="btn btn-title">Sale Agent Position:</label>
                    <input type="text" class="ml-5 form-control">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group d-flex p-1">
                    <label class="btn btn-title">Sale Agent Position:</label>
                    <input type="text" class="ml-5 form-control">
                </div>
            </div>
        </div>
    </div>

    <div class="container section-two">
        <h3 class="cus-h3">Type</h3>
        <div class="row">
            <div class="col-md-3">
                <div class="checkbox-container" style="">
                    <input type="checkbox">
                    <span>DD</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="checkbox-container" style="">
                    <input type="checkbox">
                    <span>DD</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="checkbox-container" style="">
                    <input type="checkbox">
                    <span>DD</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="checkbox-container" style="">
                    <input type="checkbox">
                    <span>DD</span>
                </div>
            </div>

        </div>
    </div>


    <div class="container section-two">
        <h3 class="cus-h3">Service & Products</h3>
        <div class="row">
            <div class="col-md-3">
                <div class="checkbox-container" style="">
                    <input type="checkbox">
                    <span>DD</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="checkbox-container" style="">
                    <input type="checkbox">
                    <span>DD</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="checkbox-container" style="">
                    <input type="checkbox">
                    <span>DD</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="checkbox-container" style="">
                    <input type="checkbox">
                    <span>DD</span>
                </div>
            </div>

        </div>
        <div class="row mt-2">
            <div class="col-md-3">
                <div class="checkbox-container" style="">
                    <input type="checkbox">
                    <span>DD</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="checkbox-container" style="">
                    <input type="checkbox">
                    <span>DD</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="checkbox-container" style="">
                    <input type="checkbox">
                    <span>DD</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="checkbox-container" style="">
                    <input type="checkbox">
                    <span>DD</span>
                </div>
            </div>

        </div>
    </div>

    <div class="container section-three">
        <h3 class="cus-h3">Sale Amount</h3>
        <div class="row">
            <div class="col-md-2">
                <div class="checkbox-container" style="">
                    <input type="checkbox">
                    <span>$500</span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="checkbox-container" style="">
                    <input type="checkbox">
                    <span>$1000</span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="checkbox-container" style="">
                    <input type="checkbox">
                    <span>$2000</span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="checkbox-container" style="">
                    <input type="checkbox">
                    <span>$5000</span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="checkbox-container" style="">
                    <input type="checkbox">
                    <span>$10000</span>
                </div>
            </div>

        </div>
        <div class="row mt-2">
            <div class="col-md-2">
                <div class="checkbox-container" style="">
                    <input type="checkbox">
                    <span>DD</span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="checkbox-container" style="">
                    <input type="checkbox">
                    <span>DD</span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="checkbox-container" style="">
                    <input type="checkbox">
                    <span>DD</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="checkbox-container" style="">
                    <input type="checkbox">
                    <span>Other</span>
                </div>
            </div>

        </div>
    </div>

    <div class="container section-four">
        <div class="row">
            <div class="col-md-3">
                <h3 class="bold">Package Detail</h3>
            </div>
            <div class="col-md-3">
                <div class="form-group d-flex p-15">
                    <label class="btn btn-title">Bonus 1:</label>
                    <input type="text" class="ml-5 form-control">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group d-flex p-15">
                    <label class="btn btn-title">Bonus 2:</label>
                    <input type="text" class="ml-5 form-control">
                </div>
            </div>
            <div class="col-md-3 p-15">
                <div class="checkbox-container-3 p-5" style="">
                    <input type="checkbox">
                    <span>Not Applicable</span>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-2">
                <div class="form-group d-flex">
                    <label class="btn btn-title">Package/s:</label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="checkbox-container" style="">
                    <input type="checkbox">
                    <span>$500</span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="checkbox-container" style="">
                    <input type="checkbox">
                    <span>$1000</span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="checkbox-container" style="">
                    <input type="checkbox">
                    <span>$2000</span>
                </div>
            </div>
            <div class="col-md-2">
                <label class="btn btn-title">Package Total
                    Amount: </label>
            </div>
            <div class="col-md-2">
                <input type="text" class="ml-5 form-control">
            </div>

        </div>

    </div>

    <div class="container section-five">
        <div class="row">
            <div class="col-md-4">
                <h3 class="bold">Sale Details - Applicant 1</h3>
            </div>
            <div class="col-md-2 p-15">
                <div class="checkbox-container" style="">
                    <input type="checkbox" name="joint1">
                    <span>Joint</span>
                </div>
            </div>
            <div class="col-md-2 p-15">
                <div class="checkbox-container" style="">
                    <input type="checkbox" class="form-check-input" name="single1">
                    <span>Single</span>
                </div>
            </div>
            <div class="col-md-2 p-15">
                <label class="btn btn-title">Percentage Of Owner </label>
            </div>
            <div class="col-md-2 p-15">
                <div class="checkbox-container percen"  style="">
                    <input type="text"  id="percentage1" name="percentage1" class="form-control">
                    <span>%</span>
                </div>
            </div>

        </div>
       
        <div class="row">
            <div class="col-md-4">
                <div class="form-group d-flex p-1">
                    <label class="btn btn-title">Title:</label>
                    <input type="text" id="title1" name="title1" class="ml-5 form-control">
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group d-flex p-1">
                    <label class="btn btn-title">Name:</label>
                    <input type="text" id="name1" name="name1" class="ml-5 form-control">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group d-flex p-1">
                    <label class="btn btn-title">DOB:</label>
                    <input type="text" id="dob1" name="dob1" class="ml-5 form-control">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-5">
                <div class="form-group d-flex p-1">
                    <label class="btn btn-title">Gender:</label>
                    <input type="text" id="gender1" name="gender1" class="ml-5 form-control">
                </div>
            </div>
            <div class="col-md-7">
                <div class="form-group d-flex p-1">
                    <label class="btn btn-title">Address:</label>
                    <input type="text" id="address1" name="address1" class="ml-5 form-control">
                </div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group d-flex p-1">
                    <input type="text" class="ml-5 form-control">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group d-flex p-1">
                    <label class="btn btn-title">Post or Zip code:</label>
                    <input type="text" id="post1" name="post1" class="ml-5 form-control">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group d-flex p-1">
                    <label class="btn btn-title">Customer ID:</label>
                    <input type="text"  name="customer_id1" id="customer_id1" class="ml-5 form-control">
                </div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="form-group d-flex p-1">
                    <label class="btn btn-title">Phone No:</label>
                    <input type="text" name="phone_no1" id="phone_no1" class="ml-5 form-control">
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group d-flex p-1">
                    <label class="btn btn-title">Mobile No:</label>
                    <input type="text" name="mobile_no1" id="mobile_no1" class="ml-5 form-control mobile_no1 ">
                </div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="form-group d-flex p-1">
                    <label class="btn btn-title">Email:</label>
                    <input type="text" name="email1" id="email1" class="ml-5 form-control email1">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group d-flex p-1">
                    <label class="btn btn-title application-btn">Application ID:</label>
                    <input type="text" name="application_id1"  id="application_id1" class="ml-5 form-control application-input">
                </div>
            </div>
            
        </div>

    </div>
    <div class="container section-six">
        <div class="row">
            <div class="col-md-4">
                <h3 class="bold">Sale Details - Applicant 2</h3>
            </div>
            <div class="col-md-2 p-15">
                <div class="checkbox-container" style="">
                    <input type="checkbox" name="joint2">
                    <span>Joint</span>
                </div>
            </div>
            <div class="col-md-2 p-15">
                <div class="checkbox-container" style="">
                    <input type="checkbox" name="single2">
                    <span>Single</span>
                </div>
            </div>
            <div class="col-md-2 p-15">
                <label class="btn btn-title">Percentage Of Owner </label>
            </div>
            <div class="col-md-2 p-15">
                <div class="checkbox-container percen" style="">
                    <input type="text" name="percentage2" class="form-control">
                    <span>%</span>
                </div>
            </div>

        </div>
       
        <div class="row">
            <div class="col-md-4">
                <div class="form-group d-flex p-1">
                    <label class="btn btn-title">Title:</label>
                    <input type="text" name="title2" class="ml-5 form-control">
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group d-flex p-1">
                    <label class="btn btn-title">Name:</label>
                    <input type="text" name="name2" class="ml-5 form-control">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group d-flex p-1">
                    <label class="btn btn-title">DOB:</label>
                    <input type="text" name="dob2" class="ml-5 form-control">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-5">
                <div class="form-group d-flex p-1">
                    <label class="btn btn-title">Gender:</label>
                    <input type="text" name="gender2" class="ml-5 form-control">
                </div>
            </div>
            <div class="col-md-7">
                <div class="form-group d-flex p-1">
                    <label class="btn btn-title">Address:</label>
                    <input type="text" name="address2" class="ml-5 form-control">
                </div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group d-flex p-1">
                    <input type="text" class="ml-5 form-control">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group d-flex p-1">
                    <label class="btn btn-title">Post or Zip code:</label>
                    <input type="text" name="post2" class="ml-5 form-control">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group d-flex p-1">
                    <label class="btn btn-title">Customer ID:</label>
                    <input type="text" name="customer_id2" class="ml-5 form-control">
                </div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="form-group d-flex p-1">
                    <label class="btn btn-title">Phone No:</label>
                    <input type="text" name="phone_no2" class="ml-5 form-control">
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group d-flex p-1">
                    <label class="btn btn-title">Mobile No:</label>
                    <input type="text" name="mobile_no2" class="ml-5 form-control">
                </div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="form-group d-flex p-1">
                    <label class="btn btn-title">Email:</label>
                    <input type="text" name="email2" class="ml-5 form-control">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group d-flex p-1">
                    <label class="btn btn-title application-btn">Application ID:</label>
                    <input type="text" name="application2" class="ml-5 form-control application-input">
             
                </div>
            </div>
            
        </div>
     <button type="button" class="btn btn-primary ajax" >Submit</button>
    </div>
</form>  
</div>
    <script>
        var fetchApplicat = "{{route('fetch-app1')}}";
   
        $(document).ready(function() {
			toastr.options = {
				'closeButton': true,
				'debug': false,
				'newestOnTop': false,
				'progressBar': false,
				'positionClass': 'toast-top-right',
				'preventDuplicates': false,
				'showDuration': '1000',
				'hideDuration': '1000',
				'timeOut': '5000',
				'extendedTimeOut': '1000',
				'showEasing': 'swing',
				'hideEasing': 'linear',
				'showMethod': 'fadeIn',
				'hideMethod': 'fadeOut',
			}
		});
    $("#email1").on("change",function(){
        email = $(this).val()
        console.log($(this).attr('name'))
        $.ajax({
        url: fetchApplicat,
        type: "GET",
        data: {'email':email},
        dataType:'JSON',
        
        success: function(response){
            if(response.status){
                $('#name1').val(response.data.name)
                $('#title1').val(response.data.title)
                $('#dob1').val(response.data.dob)
                $('#gender1').val(response.data.gender)
                $('#address1').val(response.data.address)
                $('#post1').val(response.data.post_or_zip)
                $('#phone_no1').val(response.data.phone_no)
                $('#mobile_no1').val(response.data.mobile_no)
                $('#customer_id1').val(response.data.customer_id)
                $('#email1').val(response.data.email)
                $('#application_id1').val(response.data.application_id)
            }
        }
        }) });
        $("#mobile_no1").on("change",function(){
        mobile = $(this).val()
        console.log($(this).attr('name'))
        $.ajax({
        url: fetchApplicat,
        type: "GET",
        data: {'mobile':mobile},
        dataType:'JSON',
        
        success: function(response){
            if(response.status){
                $('#name1').val(response.data.name)
                $('#title1').val(response.data.title)
                $('#dob1').val(response.data.dob)
                $('#gender1').val(response.data.gender)
                $('#address1').val(response.data.address)
                $('#post1').val(response.data.post_or_zip)
                $('#phone_no1').val(response.data.phone_no)
                $('#mobile_no1').val(response.data.mobile_no)
                $('#customer_id1').val(response.data.customer_id)
                $('#application_id1').val(response.data.application_id)
                $('#email1').val(response.data.email)

            }
        }
        }) });
    </script>
</body>

</html>
