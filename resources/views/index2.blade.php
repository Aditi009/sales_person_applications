<!DOCTYPE html>
<html style="width: 100%; height: 100%;">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}" id="token"/>

    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="formasset/assets/formviewer.css">
    <script src="formasset/assets/formviewer.js" type="text/javascript"></script>
    <script src="formasset/assets/formvuapi.js" type="text/javascript"></script>

    <!-- happy script -->
    <link href="{{ asset('assets/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="{{ asset('assets/style.js') }}" ></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- happy's script end -->


    <script type="text/javascript">
(function() {
"use strict";

/**
 * Shorthand helper function to getElementById
 * @param id
 * @returns {Element}
 */
var d = function (id) {
    return document.getElementById(id);
};

var ClassHelper = (function() {
    return {
        addClass: function(ele, name) {
            var classes = ele.className.length !== 0 ? ele.className.split(" ") : [];
            var index = classes.indexOf(name);
            if (index === -1) {
                classes.push(name);
                ele.className = classes.join(" ");
            }
        },

        removeClass: function(ele, name) {
            var classes = ele.className.length !== 0 ? ele.className.split(" ") : [];
            var index = classes.indexOf(name);
            if (index !== -1) {
                classes.splice(index, 1);
            }
            ele.className = classes.join(" ");
        }
    };
})();

var Button = {};

FormViewer.on('ready', function(data) {
    // Grab buttons
    Button.zoomIn = d('btnZoomIn');
    Button.zoomOut = d('btnZoomOut');

    if (Button.zoomIn) {
        Button.zoomIn.onclick = function(e) { FormViewer.zoomIn(); e.preventDefault(); };
    }
    if (Button.zoomOut) {
        Button.zoomOut.onclick = function(e) { FormViewer.zoomOut(); e.preventDefault(); };
    }

    document.title = data.title ? data.title : data.fileName;
    var pageLabels = data.pageLabels;
    var btnPage = d('btnPage');
    if (btnPage != null) {
        btnPage.innerHTML = pageLabels.length ? pageLabels[data.page - 1] : data.page;
        btnPage.title = data.page + " of " + data.pagecount;

        FormViewer.on('pagechange', function(data) {
            d('btnPage').innerHTML = pageLabels.length ? pageLabels[data.page - 1] : data.page;
            d('btnPage').title = data.page + " of " + data.pagecount;
        });
    }

    if (idrform.app) {
        idrform.app.execFunc = idrform.app.execMenuItem;
        idrform.app.execMenuItem = function (str) {
            switch (str.toUpperCase()) {
                case "FIRSTPAGE":
                    idrform.app.activeDocs[0].pageNum = 0;
                    FormViewer.goToPage(1);
                    break;
                case "LASTPAGE":
                    idrform.app.activeDocs[0].pageNum = FormViewer.config.pagecount - 1;
                    FormViewer.goToPage(FormViewer.config.pagecount);
                    break;
                case "NEXTPAGE":
                    idrform.app.activeDocs[0].pageNum++;
                    FormViewer.next();
                    break;
                case "PREVPAGE":
                    idrform.app.activeDocs[0].pageNum--;
                    FormViewer.prev();
                    break;
                default:
                    idrform.app.execFunc(str);
                    break;
            }
        }
    }

    document.addEventListener('keydown', function (e) {
        if (e.target != null) {
            switch (e.target.constructor) {
                case HTMLInputElement:
                case HTMLTextAreaElement:
                case HTMLVideoElement:
                case HTMLAudioElement:
                case HTMLSelectElement:
                    return;
                default:
                    break;
            }
        }
        switch (e.keyCode) {
            case 33: // Page Up
                FormViewer.prev();
                e.preventDefault();
                break;
            case 34: // Page Down
                FormViewer.next();
                e.preventDefault();
                break;
            case 37: // Left Arrow
                data.isR2L ? FormViewer.next() : FormViewer.prev();
                e.preventDefault();
                break;
            case 39: // Right Arrow
                data.isR2L ? FormViewer.prev() : FormViewer.next();
                e.preventDefault();
                break;
            case 36: // Home
                FormViewer.goToPage(1);
                e.preventDefault();
                break;
            case 35: // End
                FormViewer.goToPage(data.pagecount);
                e.preventDefault();
                break;
        }
    });
});

window.addEventListener("beforeprint", function(event) {
    FormViewer.setZoom(FormViewer.ZOOM_AUTO);
});

})();
</script>
<style type="text/css">
.btn{border:0 none; height:30px; padding:0; width:30px; background-color:transparent; display:inline-block; margin:7px 5px 0; vertical-align:top; cursor:pointer; color:#fff;}
.btn:hover{background-color:#0e1319; color:#eddbd9; border-radius:5px;}
.page{box-shadow: 1px 1px 4px rgba(0, 0, 0, 0.3);}
#formviewer{bottom:0; left:0; right:0; position:absolute; top:40px; background:#0000 none repeat scroll 0 0;}
body{padding:0px; margin:0px; background-color:#191f2f;}


.mysection{
    display:flex;
    height:100px;
    width:100%;
    align-items:center;
    justify-content:center;
}
.mysection button{
    height: 40px;
    background-color: #5bc6fe;
    border: none;
    color: white;
    text-transform: uppercase;
    font-size: 16px;
    font: 22px;
    cursor: pointer;
    font-weight: bold;
    width: 100px;

}

input:focus {
  outline: none;
}

#form11_1{
    padding-left:10px !important;
}

</style>
</head>
<body style="margin: 0;" onload='idrform.init()'>
<script type="text/javascript" src="formasset/js/formvuacroform.js"></script>

<div id="formviewer">
<div></div>
<div id="overlay"></div>
<form action="{{route('store-applicant')}}" id='store-phone' method="POST">
    @csrf
<div id="contentContainer">
<div id="page1" style="width: 909px; height: 1286px; margin-top:20px;" class="page">
<div class="page-inner" style="width: 909px; height: 1286px;">

<div id="p1" class="pageArea" style="overflow: hidden; position: relative; width: 909px; height: 1286px; margin-top:auto; margin-left:auto; margin-right:auto; background-color: white;">
<script type="text/javascript">
//global variables that can be used by ALL the functions on this page.
var is64;
var inputs;
var states = ['On.png', 'Off.png', 'DownOn.png', 'DownOff.png', 'RollOn.png', 'RollOff.png'];
var states64 = ['imageOn', 'imageOff', 'imageDownOn', 'imageDownOff', 'imageRollOn', 'imageRollOff'];

function setImage(input, state) {
    if (inputs[input].getAttribute('images').charAt(state) === '1') {
        document.getElementById(inputs[input].getAttribute('id') + "_img").src = getSrc(input, state);
    }
}

function getSrc(input, state) {
    var src;
    if (is64) {
        src = inputs[input].getAttribute(states64[state]);
    } else {
        src = inputs[input].getAttribute('imageName') + states[state];
    }
    return src;
}

function replaceChecks(isBase64) {

    is64 = isBase64;
    //get all the input fields on the page
    inputs = document.getElementsByTagName('input');

    //cycle trough the input fields
    for(var i=0; i<inputs.length; i++) {
        if(inputs[i].hasAttribute('images'))

        //check if the input is a checkbox
            if(inputs[i].getAttribute('class') !== 'idr-hidden' && inputs[i].getAttribute('data-imageAdded') !== 'true'
                && (inputs[i].getAttribute('type') === 'checkbox' || inputs[i].getAttribute('type') === 'radio')) {

                //create a new image
                var img = document.createElement('img');

                //check if the checkbox is checked
                if(inputs[i].checked) {
                    if(inputs[i].getAttribute('images').charAt(0) === '1')
                        img.src = getSrc(i, 0);
                } else {
                    if(inputs[i].getAttribute('images').charAt(1) === '1')
                        img.src = getSrc(i, 1);
                }

                //set image ID
                img.id = inputs[i].getAttribute('id') + "_img";

                //set action associations
                let imageIndex = i;
                img.addEventListener("click", function(event) {
                    checkClick(imageIndex);
                });
                img.addEventListener("mousedown", function(event) {
                    checkDown(imageIndex);
                });
                img.addEventListener("mouseover", function(event) {
                    checkOver(imageIndex);
                });
                img.addEventListener("mouseup", function(event) {
                    checkRelease(imageIndex);
                });
                img.addEventListener("mouseout", function(event) {
                    checkRelease(imageIndex);
                });

                img.style.position = "absolute";
                var style = window.getComputedStyle(inputs[i]);
                img.style.top = style.top;
                img.style.left = style.left;
                img.style.width = style.width;
                img.style.height = style.height;
                img.style.zIndex = style.zIndex;

                //place image in front of the checkbox
                inputs[i].parentNode.insertBefore(img, inputs[i]);
                inputs[i].setAttribute('data-imageAdded','true');

                //hide the checkbox
                inputs[i].style.display='none';
            }
    }
}

//change the checkbox status and the replacement image
function checkClick(i) {
    if(!inputs[i].hasAttribute('images')) return;
    if(inputs[i].checked) {
        inputs[i].checked = '';
        setImage(i, 1);
    } else {
        inputs[i].checked = 'checked';

        setImage(i, 0);

        if(inputs[i].getAttribute('name') !== null){
            for(var index=0; index<inputs.length; index++) {
                if(index !== i && inputs[index].getAttribute('name') === inputs[i].getAttribute('name')){
                    inputs[index].checked = '';
                    setImage(index, 1);
                }
            }
        }
    }
    inputs[i].dispatchEvent(new Event('click'));
}

function checkRelease(i) {
    if(!inputs[i].hasAttribute('images')) return;
    if(inputs[i].checked) {
        setImage(i, 0);
    } else {
        setImage(i, 1);
    }
    inputs[i].dispatchEvent(new Event('mouseup'));
}

function checkDown(i) {
    if(!inputs[i].hasAttribute('images')) return;
    if(inputs[i].checked) {
        setImage(i, 2);
    } else {
        setImage(i, 3);
    }
    inputs[i].dispatchEvent(new Event('mousedown'));
}

function checkOver(i) {
    if(!inputs[i].hasAttribute('images')) return;
    if(inputs[i].checked) {
        setImage(i, 4);
    } else {
        setImage(i, 5);
    }
    inputs[i].dispatchEvent(new Event('mouseover'));
}

</script>


<!-- Begin shared CSS values -->
<style class="shared-css" type="text/css" >
.t {
	transform-origin: bottom left;
	z-index: 2;
	position: absolute;
	white-space: pre;
	overflow: visible;
	line-height: 1.5;
}
.text-container {
	white-space: pre;
}
@supports (-webkit-touch-callout: none) {
	.text-container {
		white-space: normal;
	}
}
</style>
<!-- End shared CSS values -->


<!-- Begin inline CSS -->
<style type="text/css" >

#t1_1{left:248px;bottom:1177px;letter-spacing:0.15px;}
#t2_1{left:654px;bottom:1178px;letter-spacing:-0.21px;}
#t3_1{left:849px;bottom:1249px;letter-spacing:0.13px;}
#t4_1{left:67px;bottom:8px;letter-spacing:-0.06px;word-spacing:0.03px;}
#t5_1{left:571px;bottom:8px;letter-spacing:-0.12px;word-spacing:0.08px;}
#t6_1{left:151px;bottom:1137px;letter-spacing:0.19px;}
#t7_1{left:39px;bottom:627px;letter-spacing:0.03px;}
#t8_1{left:600px;bottom:634px;letter-spacing:-0.04px;word-spacing:0.09px;}
#t9_1{left:600px;bottom:620px;letter-spacing:0.03px;}
#ta_1{left:148px;bottom:1097px;letter-spacing:0.14px;word-spacing:0.06px;}
#tb_1{left:157px;bottom:1083px;letter-spacing:0.22px;}
#tc_1{left:587px;bottom:1098px;letter-spacing:0.14px;word-spacing:0.06px;}
#td_1{left:598px;bottom:1084px;letter-spacing:0.18px;}
#te_1{left:151px;bottom:1055px;letter-spacing:0.14px;word-spacing:0.06px;}
#tf_1{left:161px;bottom:1041px;letter-spacing:0.22px;}
#tg_1{left:399px;bottom:1053px;letter-spacing:0.14px;word-spacing:0.06px;}
#th_1{left:411px;bottom:1039px;letter-spacing:0.18px;}
#ti_1{left:647px;bottom:1053px;letter-spacing:0.14px;word-spacing:0.06px;}
#tj_1{left:658px;bottom:1039px;letter-spacing:0.18px;}
#tk_1{left:60px;bottom:966px;letter-spacing:0.05px;}
#tl_1{left:64px;bottom:966px;letter-spacing:-0.03px;word-spacing:0.08px;}
#tm_1{left:280px;bottom:966px;letter-spacing:-0.01px;word-spacing:0.05px;}
#tn_1{left:495px;bottom:966px;letter-spacing:-0.15px;word-spacing:0.2px;}
#to_1{left:711px;bottom:966px;letter-spacing:0.05px;}
#tp_1{left:59px;bottom:880px;letter-spacing:0.05px;}
#tq_1{left:63px;bottom:880px;letter-spacing:0.03px;}
#tr_1{left:279px;bottom:880px;letter-spacing:0.03px;}
#ts_1{left:494px;bottom:880px;letter-spacing:0.02px;}
#tt_1{left:710px;bottom:880px;letter-spacing:0.05px;}
#tu_1{left:59px;bottom:837px;letter-spacing:0.05px;}
#tv_1{left:63px;bottom:837px;letter-spacing:0.03px;word-spacing:0.02px;}
#tw_1{left:66px;bottom:760px;letter-spacing:0.06px;}
#tx_1{left:239px;bottom:760px;letter-spacing:0.05px;}
#ty_1{left:411px;bottom:760px;letter-spacing:0.05px;}
#tz_1{left:170px;bottom:627px;letter-spacing:0.06px;}
#t10_1{left:323px;bottom:627px;letter-spacing:0.05px;}
#t11_1{left:473px;bottom:627px;letter-spacing:0.05px;}
#t12_1{left:584px;bottom:760px;letter-spacing:0.05px;}
#t13_1{left:66px;bottom:714px;letter-spacing:0.05px;}
#t14_1{left:239px;bottom:714px;letter-spacing:0.05px;}
#t15_1{left:411px;bottom:714px;letter-spacing:0.05px;}
#t16_1{left:584px;bottom:714px;letter-spacing:0.05px;}
#t17_1{left:757px;bottom:760px;letter-spacing:0.05px;}
#t18_1{left:279px;bottom:837px;letter-spacing:0.01px;word-spacing:0.04px;}
#t19_1{left:494px;bottom:837px;letter-spacing:0.03px;word-spacing:0.01px;}
#t1a_1{left:710px;bottom:837px;letter-spacing:0.01px;word-spacing:0.04px;}
#t1b_1{left:546px;bottom:1138px;letter-spacing:-0.07px;}
#t1c_1{left:622px;bottom:1138px;letter-spacing:0.36px;}
#t1d_1{left:699px;bottom:1138px;letter-spacing:-0.38px;}
#t1e_1{left:775px;bottom:1138px;letter-spacing:0.35px;}
#t1f_1{left:433px;bottom:1138px;letter-spacing:0.15px;}
#t1g_1{left:33px;bottom:1003px;letter-spacing:-0.4px;}
#t1h_1{left:34px;bottom:920px;letter-spacing:-0.23px;}
#t1i_1{left:34px;bottom:792px;letter-spacing:-0.28px;word-spacing:0.02px;}
#t1j_1{left:33px;bottom:668px;letter-spacing:-0.27px;word-spacing:0.02px;}
#t1k_1{left:699px;bottom:924px;letter-spacing:0.04px;word-spacing:0.01px;}
#t1l_1{left:268px;bottom:671px;letter-spacing:0.04px;}
#t1m_1{left:502px;bottom:672px;letter-spacing:0.05px;}
#t1n_1{left:66px;bottom:706px;letter-spacing:-0.22px;}
#t1o_1{left:413px;bottom:706px;letter-spacing:-0.21px;}
#t1p_1{left:170px;bottom:713px;}
#t1q_1{left:344px;bottom:713px;}
#t1r_1{left:508px;bottom:718px;letter-spacing:0.22px;}
#t1s_1{left:766px;bottom:671px;letter-spacing:0.1px;}
#t1t_1{left:33px;bottom:573px;letter-spacing:-0.22px;}
#t1u_1{left:41px;bottom:529px;letter-spacing:0.09px;}
#t1v_1{left:37px;bottom:483px;letter-spacing:0.2px;}
#t1w_1{left:244px;bottom:528px;letter-spacing:0.23px;}
#t1x_1{left:37px;bottom:388px;letter-spacing:0.17px;word-spacing:0.02px;}
#t1y_1{left:37px;bottom:341px;letter-spacing:0.18px;}
#t1z_1{left:464px;bottom:388px;letter-spacing:0.16px;word-spacing:0.02px;}
#t20_1{left:260px;bottom:483px;letter-spacing:0.1px;}
#t21_1{left:534px;bottom:435px;letter-spacing:0.2px;}
#t22_1{left:558px;bottom:342px;letter-spacing:0.13px;}
#t23_1{left:246px;bottom:435px;letter-spacing:0.18px;}
#t24_1{left:702px;bottom:529px;letter-spacing:0.17px;}
#t25_1{left:863px;bottom:579px;}
#t26_1{left:622px;bottom:579px;letter-spacing:0.04px;word-spacing:0.01px;}
#t27_1{left:460px;bottom:579px;letter-spacing:0.18px;}
#t28_1{left:559px;bottom:579px;letter-spacing:0.16px;}
#t29_1{left:33px;bottom:285px;letter-spacing:-0.22px;}
#t2a_1{left:41px;bottom:240px;letter-spacing:0.09px;}
#t2b_1{left:37px;bottom:195px;letter-spacing:0.2px;}
#t2c_1{left:244px;bottom:240px;letter-spacing:0.23px;}
#t2d_1{left:37px;bottom:99px;letter-spacing:0.17px;word-spacing:0.02px;}
#t2e_1{left:37px;bottom:52px;letter-spacing:0.18px;}
#t2f_1{left:464px;bottom:99px;letter-spacing:0.16px;word-spacing:0.02px;}
#t2g_1{left:260px;bottom:194px;letter-spacing:0.1px;}
#t2h_1{left:534px;bottom:146px;letter-spacing:0.2px;}
#t2i_1{left:558px;bottom:53px;letter-spacing:0.13px;}
#t2j_1{left:246px;bottom:146px;letter-spacing:0.18px;}
#t2k_1{left:702px;bottom:240px;letter-spacing:0.17px;}
#t2l_1{left:863px;bottom:290px;}
#t2m_1{left:622px;bottom:290px;letter-spacing:0.04px;word-spacing:0.01px;}
#t2n_1{left:460px;bottom:290px;letter-spacing:0.18px;}
#t2o_1{left:559px;bottom:290px;letter-spacing:0.16px;}

.s1{font-size:38px;font-family:RenogareSoft-Regular_ay;color:#19618A;}
.s2{font-size:38px;font-family:RenogareSoft-Regular_ay;color:#FFF;}
.s3{font-size:13px;font-family:RenogareSoft-Regular_ay;color:#FFF;}
.s4{font-size:10px;font-family:RenogareSoft-Regular_ay;color:#737478;}
.s5{font-size:13px;font-family:RenogareSoft-Regular_ay;color:#7B7A7E;}
.s6{font-size:12px;font-family:RenogareSoft-Regular_ay;color:#7B7A7E;}
.s7{font-size:12px;font-family:RenogareSoft-Regular_ay;color:#FFF;}
.s8{font-size:18px;font-family:RenogareSoft-Regular_ay;color:#024067;}
.s9{font-size:9px;font-family:Galvji-Oblique_b0;color:#7B7A7E;}
.sa{font-size:15px;font-family:RenogareSoft-Regular_ay;color:#FFF;}
.sb{font-size:9px;font-family:RenogareSoft-Regular_ay;color:#FFF;}
.sc{font-size:13px;font-family:RenogareSoft-Regular_ay;color:#236275;}
.t.v0_1{transform:scaleX(1.058);}
#form1_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 205px;	top: 121px;	width: 208px;	height: 32px;	color: rgb(94,93,80);	text-align: left;	background: transparent;	border: none;	font: normal 15px Helvetica, Arial, sans-serif;}
#form2_1{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 510px;	top: 124px;	width: 28px;	height: 28px;	color: rgb(0,255,0);	text-align: left;	background: transparent;	font: normal 18px Wingdings, 'Zapf Dingbats';}
#form3_1{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 585px;	top: 124px;	width: 28px;	height: 28px;	color: rgb(0,255,0);	text-align: left;	background: transparent;	font: normal 18px Wingdings, 'Zapf Dingbats';}
#form4_1{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 665px;	top: 124px;	width: 28px;	height: 28px;	color: rgb(0,255,0);	text-align: left;	background: transparent;	font: normal 21px Wingdings, 'Zapf Dingbats';}
#form5_1{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 740px;	top: 124px;	width: 28px;	height: 28px;	color: rgb(0,255,0);	text-align: left;	background: transparent;	font: normal 21px Wingdings, 'Zapf Dingbats';}
#form6_1{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 819px;	top: 124px;	width: 28px;	height: 28px;	color: rgb(0,255,0);	text-align: left;	background: transparent;	font: normal 21px Wingdings, 'Zapf Dingbats';}
#form7_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 246px;	top: 167px;	width: 323px;	height: 34px;	color: rgb(94,93,96);	text-align: left;	background: transparent;	border: none;	font: normal 15px Helvetica, Arial, sans-serif;}
#form8_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 248px;	top: 211px;	width: 130px;	height: 32px;	color: rgb(94,93,96);	text-align: left;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form9_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 850px;	top: 121px;	width: 26px;	height: 32px;	color: rgb(94,93,96);	text-align: left;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form10_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 495px;	top: 211px;	width: 132px;	height: 32px;	color: rgb(94,93,96);	text-align: left;	background: transparent;	border: none;	font: normal 15px Helvetica, Arial, sans-serif;}
#form11_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 680px;	top: 167px;	width: 194px;	height: 32px;	color: rgb(94,93,96);	text-align: left;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form12_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 746px;	top: 211px;	width: 129px;	height: 32px;	color: rgb(94,93,96);	text-align: left;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form13_1{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 32px;	top: 295px;	width: 28px;	height: 28px;	color: rgb(0,255,0);	text-align: left;	background: transparent;	font: normal 21px Wingdings, 'Zapf Dingbats';}
#form14_1{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 249px;	top: 295px;	width: 28px;	height: 28px;	color: rgb(0,255,0);	text-align: left;	background: transparent;	font: normal 21px Wingdings, 'Zapf Dingbats';}
#form15_1{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 463px;	top: 295px;	width: 28px;	height: 28px;	color: rgb(0,255,0);	text-align: left;	background: transparent;	font: normal 21px Wingdings, 'Zapf Dingbats';}
#form16_1{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 680px;	top: 295px;	width: 28px;	height: 28px;	color: rgb(0,255,0);	text-align: left;	background: transparent;	font: normal 21px Wingdings, 'Zapf Dingbats';}
#form17_1{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 32px;	top: 382px;	width: 28px;	height: 28px;	color: rgb(0,255,0);	text-align: left;	background: transparent;	font: normal 21px Wingdings, 'Zapf Dingbats';}
#form18_1{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 32px;	top: 426px;	width: 28px;	height: 28px;	color: rgb(0,255,0);	text-align: left;	background: transparent;	font: normal 21px Wingdings, 'Zapf Dingbats';}
#form19_1{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 248px;	top: 382px;	width: 28px;	height: 28px;	color: rgb(0,255,0);	text-align: left;	background: transparent;	font: normal 21px Wingdings, 'Zapf Dingbats';}
#form20_1{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 248px;	top: 426px;	width: 28px;	height: 28px;	color: rgb(0,255,0);	text-align: left;	background: transparent;	font: normal 21px Wingdings, 'Zapf Dingbats';}
#form21_1{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 463px;	top: 382px;	width: 28px;	height: 28px;	color: rgb(0,255,0);	text-align: left;	background: transparent;	font: normal 18px Wingdings, 'Zapf Dingbats';}
#form22_1{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 465px;	top: 426px;	width: 28px;	height: 28px;	color: rgb(0,255,0);	text-align: left;	background: transparent;	font: normal 18px Wingdings, 'Zapf Dingbats';}
#form23_1{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 680px;	top: 382px;	width: 28px;	height: 28px;	color: rgb(0,255,0);	text-align: left;	background: transparent;	font: normal 21px Wingdings, 'Zapf Dingbats';}
#form24_1{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 680px;	top: 426px;	width: 28px;	height: 28px;	color: rgb(0,255,0);	text-align: left;	background: transparent;	font: normal 21px Wingdings, 'Zapf Dingbats';}
#form25_1{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 35px;	top: 501px;	width: 28px;	height: 28px;	color: rgb(0,255,0);	text-align: left;	background: transparent;	font: normal 21px Wingdings, 'Zapf Dingbats';}
#form26_1{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 35px;	top: 547px;	width: 28px;	height: 28px;	color: rgb(0,255,0);	text-align: left;	background: transparent;	font: normal 21px Wingdings, 'Zapf Dingbats';}
#form27_1{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 208px;	top: 501px;	width: 28px;	height: 28px;	color: rgb(0,255,0);	text-align: left;	background: transparent;	font: normal 21px Wingdings, 'Zapf Dingbats';}
#form28_1{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 208px;	top: 547px;	width: 28px;	height: 28px;	color: rgb(0,255,0);	text-align: left;	background: transparent;	font: normal 21px Wingdings, 'Zapf Dingbats';}
#form29_1{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 381px;	top: 501px;	width: 28px;	height: 28px;	color: rgb(0,255,0);	text-align: left;	background: transparent;	font: normal 21px Wingdings, 'Zapf Dingbats';}
#form30_1{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 381px;	top: 547px;	width: 28px;	height: 28px;	color: rgb(0,255,0);	text-align: left;	background: transparent;	font: normal 21px Wingdings, 'Zapf Dingbats';}
#form31_1{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 553px;	top: 547px;	width: 28px;	height: 28px;	color: rgb(0,255,0);	text-align: left;	background: transparent;	font: normal 21px Wingdings, 'Zapf Dingbats';}
#form32_1{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 553px;	top: 501px;	width: 28px;	height: 28px;	color: rgb(0,255,0);	text-align: left;	background: transparent;	font: normal 21px Wingdings, 'Zapf Dingbats';}
#form33_1{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 726px;	top: 501px;	width: 28px;	height: 28px;	color: rgb(0,255,0);	text-align: left;	background: transparent;	font: normal 21px Wingdings, 'Zapf Dingbats';}
#form34_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 342px;	top: 587px;	width: 142px;	height: 32px;	color: rgb(0,0,0);	text-align: left;	background: transparent;	border: none;	font: normal 18px Arial, Helvetica, sans-serif;}
#form35_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 579px;	top: 585px;	width: 136px;	height: 32px;	color: rgb(0,0,0);	text-align: left;	background: transparent;	border: none;	font: normal 18px Arial, Helvetica, sans-serif;}
#form36_1{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 734px;	top: 590px;	width: 28px;	height: 28px;	color: rgb(0,0,0);	text-align: left;	background-color: rgb(255,255,255);	font: normal 21px Wingdings, 'Zapf Dingbats';}
#form37_1{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 139px;	top: 634px;	width: 28px;	height: 28px;	color: rgb(0,255,0);	text-align: left;	background: transparent;	font: normal 21px Wingdings, 'Zapf Dingbats';}
#form38_1{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 292px;	top: 634px;	width: 28px;	height: 28px;	color: rgb(0,255,0);	text-align: left;	background: transparent;	font: normal 21px Wingdings, 'Zapf Dingbats';}
#form39_1{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 442px;	top: 634px;	width: 28px;	height: 28px;	color: rgb(0,255,0);	text-align: left;	background: transparent;	font: normal 21px Wingdings, 'Zapf Dingbats';}
#form40_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 720px;	top: 631px;	width: 153px;	height: 32px;	color: rgb(0,0,0);	text-align: left;	background: transparent;	border: none;	font: normal 18px Arial, Helvetica, sans-serif;}
#form41_1{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 429px;	top: 682px;	width: 28px;	height: 28px;	color: rgb(0,255,0);	text-align: left;	background: transparent;	font: normal 21px Wingdings, 'Zapf Dingbats';}
#form42_1{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 529px;	top: 683px;	width: 28px;	height: 28px;	color: rgb(0,255,0);	text-align: left;	background: transparent;	font: normal 18px Wingdings, 'Zapf Dingbats';}
#form43_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 816px;	top: 682px;	width: 43px;	height: 32px;	color: rgb(94,93,96);	text-align: left;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#title1{	z-index: 2;	padding: 0px;	position: absolute;	left: 95px;	top: 729px;	width: 127px;	height: 32px;	color: rgb(94,93,96);	text-align: left;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#name1{	z-index: 2;	padding: 0px;	position: absolute;	left: 309px;	top: 729px;	width: 373px;	height: 32px;	color: rgb(94,93,96);	text-align: left;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#dob1{	z-index: 2;	padding: 0px;	position: absolute;	left: 763px;	top: 729px;	width: 110px;	height: 32px;	color: rgb(94,93,96);	text-align: left;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#gender1{	z-index: 2;	padding: 0px;	position: absolute;	left: 110px;	top: 775px;	width: 129px;	height: 32px;	color: rgb(94,93,96);	text-align: left;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#address1{	z-index: 2;	padding: 0px;	position: absolute;	left: 339px;	top: 775px;	width: 533px;	height: 32px;	color: rgb(94,93,96);	text-align: left;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form49_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 32px;	top: 821px;	width: 196px;	height: 32px;	color: rgb(94,93,96);	text-align: left;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#post1{	z-index: 2;	padding: 0px;	position: absolute;	left: 385px;	top: 821px;	width: 129px;	height: 32px;	color: rgb(94,93,96);	text-align: left;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#customer_id1{	z-index: 2;	padding: 0px;	position: absolute;	left: 645px;	top: 821px;	width: 228px;	height: 32px;	color: rgb(94,93,96);	text-align: left;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#phone_no1{	z-index: 2;	padding: 0px;	position: absolute;	left: 129px;	top: 869px;	width: 321px;	height: 32px;	color: rgb(94,93,96);	text-align: left;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#mobile_no1{	z-index: 2;	padding: 0px;	position: absolute;	left: 559px;	top: 869px;	width: 313px;	height: 32px;	color: rgb(94,93,96);	text-align: left;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#email1{	z-index: 2;	padding: 0px;	position: absolute;	left: 99px;	top: 915px;	width: 442px;	height: 32px;	color: rgb(94,93,96);	text-align: left;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#application_id1{	z-index: 2;	padding: 0px;	position: absolute;	left: 671px;	top: 915px;	width: 203px;	height: 32px;	color: rgb(94,93,96);	text-align: left;	background: transparent;	border: none;	font: normal 15px Helvetica, Arial, sans-serif;}
#form56_1{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 429px;	top: 972px;	width: 28px;	height: 28px;	color: rgb(0,255,0);	text-align: left;	background: transparent;	font: normal 15px Wingdings, 'Zapf Dingbats';}
#form57_1{	z-index: 2;	border-style: none;	padding: 0px;	position: absolute;	left: 527px;	top: 972px;	width: 28px;	height: 28px;	color: rgb(0,255,0);	text-align: left;	background: transparent;	font: normal 15px Wingdings, 'Zapf Dingbats';}
#form58_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 818px;	top: 969px;	width: 46px;	height: 32px;	color: rgb(94,93,96);	text-align: left;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#title2{	z-index: 2;	padding: 0px;	position: absolute;	left: 96px;	top: 1018px;	width: 127px;	height: 32px;	color: rgb(94,93,96);	text-align: left;	background: transparent;	border: none;	font: normal 15px Helvetica, Arial, sans-serif;}
#name2{	z-index: 2;	padding: 0px;	position: absolute;	left: 309px;	top: 1016px;	width: 371px;	height: 32px;	color: rgb(94,93,96);	text-align: left;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#dob2{	z-index: 2;	padding: 0px;	position: absolute;	left: 763px;	top: 1018px;	width: 110px;	height: 32px;	color: rgb(94,93,96);	text-align: left;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#gender2{	z-index: 2;	padding: 0px;	position: absolute;	left: 112px;	top: 1064px;	width: 129px;	height: 32px;	color: rgb(94,93,96);	text-align: left;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#address2{	z-index: 2;	padding: 0px;	position: absolute;	left: 341px;	top: 1064px;	width: 533px;	height: 32px;	color: rgb(94,93,96);	text-align: left;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#form64_1{	z-index: 2;	padding: 0px;	position: absolute;	left: 34px;	top: 1111px;	width: 193px;	height: 32px;	color: rgb(94,93,96);	text-align: left;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#post2{	z-index: 2;	padding: 0px;	position: absolute;	left: 385px;	top: 1109px;	width: 129px;	height: 32px;	color: rgb(94,93,96);	text-align: left;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#customer_id2{	z-index: 2;	padding: 0px;	position: absolute;	left: 645px;	top: 1109px;	width: 228px;	height: 32px;	color: rgb(94,93,96);	text-align: left;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#phone_no2{	z-index: 2;	padding: 0px;	position: absolute;	left: 129px;	top: 1158px;	width: 318px;	height: 32px;	color: rgb(94,93,96);	text-align: left;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#mobile_no2{	z-index: 2;	padding: 0px;	position: absolute;	left: 562px;	top: 1158px;	width: 310px;	height: 32px;	color: rgb(94,93,96);	text-align: left;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#email2{	z-index: 2;	padding: 0px;	position: absolute;	left: 99px;	top: 1204px;	width: 440px;	height: 32px;	color: rgb(94,93,96);	text-align: left;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}
#application2{	z-index: 2;	padding: 0px;	position: absolute;	left: 674px;	top: 1206px;	width: 203px;	height: 32px;	color: rgb(94,93,96);	text-align: left;	background: transparent;	border: none;	font: normal 15px 'Times New Roman', Times, serif;}

</style>
<!-- End inline CSS -->

<!-- Begin embedded font definitions -->
<style id="fonts1" type="text/css" >

@font-face {
	font-family: Galvji-Oblique_b0;
	src: url("formasset/fonts/Galvji-Oblique_b0.woff") format("woff");
}

@font-face {
	font-family: RenogareSoft-Regular_ay;
	src: url("formasset/fonts/Galvji-Oblique_b0.woff") format("woff");
	src: url("formasset/fonts/RenogareSoft-Regular_ay.woff") format("woff");
}

</style>
<!-- End embedded font definitions -->

<!-- Begin page background -->
<div id="pg1Overlay" style="width:100%; height:100%; position:absolute; z-index:1; background-color:rgba(0,0,0,0); -webkit-user-select: none;"></div>
<div id="pg1" style="-webkit-user-select: none;"><object width="909" height="1286" data="formasset/1/1.svg" type="image/svg+xml" id="pdf1" style="width:909px; height:1286px; -moz-transform:scale(1); z-index: 0;"></object></div>
<!-- End page background -->


<!-- Begin text definitions (Positioned/styled in CSS) -->
<div class="text-container"><span id="t1_1" class="t s1">Sales Application </span><span id="t2_1" class="t s2">PERSONAL </span>
<span id="t3_1" class="t s3">Page 1 </span>
<span id="t4_1" class="t s4">v3.2 13082563 SAP - StrykerFusion Corporation - 86 / 500 High St. Maitland NSW 2320. Phone </span><span id="t5_1" class="t s4">02 4030 5542 - P.O Box 2127 Green Hills NSW 2323 </span>
<span id="t6_1" class="t s3">Date: </span>
<span id="t7_1" class="t s5">Package/s: </span>
<span id="t8_1" class="t s5">Package Total </span>
<span id="t9_1" class="t s5">Amount: </span>
<span id="ta_1" class="t s3">Sale Agent </span>
<span id="tb_1" class="t s3">Number: </span>
<span id="tc_1" class="t s3">Sale Agent </span>
<span id="td_1" class="t s3">Postion: </span>
<span id="te_1" class="t s3">Sale Agent </span>
<span id="tf_1" class="t s3">Number: </span>
<span id="tg_1" class="t s3">Sale Agent </span>
<span id="th_1" class="t s3">Postion: </span>
<span id="ti_1" class="t s3">Sale Agent </span>
<span id="tj_1" class="t s3">Postion: </span>
<span id="tl_1" class="t s5">New Account </span><span id="tm_1" class="t s5">Existing Account </span><span id="tn_1" class="t s5">Top Up </span><span id="to_1" class="t s5">Partner </span>
<span id="tq_1" class="t s5">Broadcast </span><span id="tr_1" class="t s5">ScarcityCoin </span><span id="ts_1" class="t s5">StrykerCoin </span><span id="tt_1" class="t s5">OcitiGen </span>
<span id="tv_1" class="t s5">Hubsite (Business) </span>
<span id="tw_1" class="t s5">$500 </span><span id="tx_1" class="t s5">$1,000 </span><span id="ty_1" class="t s5">$2,000 </span>
<span id="tz_1" class="t s5">$500 </span><span id="t10_1" class="t s5">$1,000 </span><span id="t11_1" class="t s5">$2,000 </span>
<span id="t12_1" class="t s5">$5,000 </span>
<span id="t13_1" class="t s5">$25,00 </span><span id="t14_1" class="t s5">$50,000 </span><span id="t15_1" class="t s5">$100,000 </span><span id="t16_1" class="t s5">Other </span>
<span id="t17_1" class="t s5">$10,000 </span>
<span id="t18_1" class="t s5">Foundation Club </span><span id="t19_1" class="t s5">Presidential Club </span><span id="t1a_1" class="t s5">Mortgage Accel. </span>
<span id="t1b_1" class="t v0_1 s6">US </span><span id="t1c_1" class="t v0_1 s6">UK </span><span id="t1d_1" class="t v0_1 s6">AU </span><span id="t1e_1" class="t v0_1 s6">NZ </span><span id="t1f_1" class="t v0_1 s7">Division: </span>
<span id="t1g_1" class="t s8">Type </span>
<span id="t1h_1" class="t s8">Service &amp; Products </span>
<span id="t1i_1" class="t s8">Sale Amount </span>
<span id="t1j_1" class="t s8">Package Details </span>
<span id="t1k_1" class="t s5">Can Click more than one </span>
<span id="t1l_1" class="t s5">Bonus 1: </span><span id="t1m_1" class="t s5">Bonus 2: </span>
<span id="t1n_1" class="t s9">Foundation Club </span><span id="t1o_1" class="t s9">Presidentiak Club </span>
<span id="t1p_1" class="t sa">F </span><span id="t1q_1" class="t sa">F </span>
<span id="t1r_1" class="t sb">VIP </span>
<span id="t1s_1" class="t sc">Not Applicable </span>
<span id="t1t_1" class="t s8">Sales Details - Applicant 1 </span>
<span id="t1u_1" class="t s5">Title: </span>
<span id="t1v_1" class="t s5">Gender: </span>
<span id="t1w_1" class="t s5">Name: </span>
<span id="t1x_1" class="t s5">Phone No.: </span>
<span id="t1y_1" class="t s5">Email: </span>
<span id="t1z_1" class="t s5">Mobile No.: </span>
<span id="t20_1" class="t s5">Address: </span>
<span id="t21_1" class="t s5">Customer ID: </span>
<span id="t22_1" class="t s7">Application ID: </span>
<span id="t23_1" class="t s5">Post or Zip Code: </span>
<span id="t24_1" class="t s5">D.O.B: </span>
<span id="t25_1" class="t s5">% </span><span id="t26_1" class="t s5">Percentage of Ownership </span><span id="t27_1" class="t s5">Joint </span><span id="t28_1" class="t s5">Single </span>
<span id="t29_1" class="t s8">Sales Details - Applicant 2 </span>
<span id="t2a_1" class="t s5">Title: </span>
<span id="t2b_1" class="t s5">Gender: </span>
<span id="t2c_1" class="t s5">Name: </span>
<span id="t2d_1" class="t s5">Phone No.: </span>
<span id="t2e_1" class="t s5">Email: </span>
<span id="t2f_1" class="t s5">Mobile No.: </span>
<span id="t2g_1" class="t s5">Address: </span>
<span id="t2h_1" class="t s5">Customer ID: </span>
<span id="t2i_1" class="t s7">Application ID: </span>
<span id="t2j_1" class="t s5">Post or Zip Code: </span>
<span id="t2k_1" class="t s5">D.O.B: </span>
<span id="t2l_1" class="t s5">% </span><span id="t2m_1" class="t s5">Percentage of Ownership </span><span id="t2n_1" class="t s5">Joint </span><span id="t2o_1" class="t s5">Single </span></div>
<!-- End text definitions -->


<!-- Begin Form Data -->
<input id="form1_1" type="text" tabindex="1" value="<?php echo date('d/m/y',time()); ?>" data-objref="4 0 R" data-field-name="Text1" readonly/>
<input id="form2_1" type="radio" name="location" tabindex="2" value="" data-objref="5 0 R" data-field-name="Check Box2" imageName="formasset/1/form/6 0 R" images="110100"/>
<input id="form3_1" type="radio" name="location" tabindex="3" value="" data-objref="6 0 R" data-field-name="Check Box3" imageName="formasset/1/form/6 0 R" images="110100"/>
<input id="form4_1" type="radio" name="location" tabindex="4" data-objref="7 0 R" data-field-name="Check Box4" value="Yes" imageName="formasset/1/form/7 0 R" images="110100"/>
<input id="form5_1" type="radio" name="location" tabindex="5" data-objref="8 0 R" data-field-name="Check Box5" value="Yes" imageName="formasset/1/form/8 0 R" images="110100"/>
<input id="form6_1" type="radio" name="location" tabindex="6" data-objref="9 0 R" data-field-name="Check Box6" value="Yes" imageName="formasset/1/form/9 0 R" images="110100"/>
<input id="form7_1" type="text" tabindex="7" value="" data-objref="10 0 R" data-field-name="Text7"/>
<input id="form8_1" type="text" tabindex="8" value="" data-objref="11 0 R" data-field-name="Text8"/>
<input id="form9_1" type="text" tabindex="9" value="" data-objref="12 0 R" data-field-name="Text9"/>
<input id="form10_1" type="text" tabindex="10" value="" data-objref="13 0 R" data-field-name="Text10"/>
<input id="form11_1" type="text" tabindex="11" value="" data-objref="14 0 R" data-field-name="Text11"/>
<input id="form12_1" type="text" tabindex="12" value="" data-objref="15 0 R" data-field-name="Text12"/>
<input id="form13_1" type="checkbox" tabindex="13" data-objref="16 0 R" data-field-name="Check Box13" name="type" value="new_account" imageName="formasset/1/form/16 0 R" images="110100"/>
<input id="form14_1" type="checkbox" tabindex="14" data-objref="17 0 R" data-field-name="Check Box14" name="type"  value="exists_account" imageName="formasset/1/form/17 0 R" images="110100"/>
<input id="form15_1" type="checkbox" tabindex="15" data-objref="18 0 R" data-field-name="Check Box15"  name="type"  value="topup" imageName="formasset/1/form/18 0 R" images="110100"/>
<input id="form16_1" type="checkbox" tabindex="16" data-objref="19 0 R" data-field-name="Check Box16"  name="type"  value="partner" imageName="formasset/1/form/19 0 R" images="110100"/>
<input id="form17_1" type="checkbox" tabindex="17" name="service_product" data-objref="20 0 R" data-field-name="Check Box17" value="broadcast" imageName="formasset/1/form/20 0 R" images="110100"/>
<input id="form18_1" type="checkbox" tabindex="18"  name="service_product" data-objref="21 0 R" data-field-name="Check Box18" value="hubsite" imageName="formasset/1/form/21 0 R" images="110100"/>
<input id="form19_1" type="checkbox" tabindex="19"  name="service_product" data-objref="22 0 R" data-field-name="Check Box19" value="scarcityCoin" imageName="formasset/1/form/22 0 R" images="110100"/>
<input id="form20_1" type="checkbox" tabindex="20"  name="service_product" data-objref="23 0 R" data-field-name="Check Box20" value="FoundationClub" imageName="formasset/1/form/23 0 R" images="110100"/>
<input id="form21_1" type="checkbox" tabindex="21"  name="service_product" value="StrykerCoin" data-objref="24 0 R" data-field-name="Check Box21" imageName="formasset/1/form/24 0 R" images="110100"/>
<input id="form22_1" type="checkbox" tabindex="22"   name="service_product"value="Presidential Club" data-objref="25 0 R" data-field-name="Check Box22" imageName="formasset/1/form/25 0 R" images="110100"/>
<input id="form23_1" type="checkbox" tabindex="23"   name="service_product"data-objref="26 0 R" data-field-name="Check Box23" value="OcitiGen" imageName="formasset/1/form/26 0 R" images="110100"/>
<input id="form24_1" type="checkbox" tabindex="24"   name="service_product"data-objref="27 0 R" data-field-name="Check Box24" value="Mortgage Accel" imageName="formasset/1/form/27 0 R" images="110100"/>
<input id="form25_1" type="checkbox" tabindex="25" name="sale_amount" data-objref="28 0 R" data-field-name="Check Box25" value="500" imageName="formasset/1/form/28 0 R" images="110100"/>
<input id="form26_1" type="checkbox" tabindex="26" name="sale_amount" data-objref="29 0 R" data-field-name="Check Box26" value="25,00" imageName="formasset/1/form/29 0 R" images="110100"/>
<input id="form27_1" type="checkbox" tabindex="27" name="sale_amount" data-objref="30 0 R" data-field-name="Check Box27" value="1,000" imageName="formasset/1/form/30 0 R" images="110100"/>
<input id="form28_1" type="checkbox" tabindex="28" name="sale_amount" data-objref="31 0 R" data-field-name="Check Box28" value="50,000" imageName="formasset/1/form/31 0 R" images="110100"/>
<input id="form29_1" type="checkbox" tabindex="29" name="sale_amount" data-objref="32 0 R" data-field-name="Check Box29" value="2,000" imageName="formasset/1/form/32 0 R" images="110100"/>
<input id="form30_1" type="checkbox" tabindex="30" name="sale_amount" data-objref="33 0 R" data-field-name="Check Box30" value="100,000" imageName="formasset/1/form/33 0 R" images="110100"/>
<input id="form31_1" type="checkbox" tabindex="31" name="sale_amount" data-objref="34 0 R" data-field-name="Check Box31" value="other" imageName="formasset/1/form/34 0 R" images="110100"/>

<input id="form32_1" type="checkbox" tabindex="32" name="sale_amount" data-objref="35 0 R" data-field-name="Check Box32" value="5,000" imageName="formasset/1/form/35 0 R" images="110100"/>
<input id="form33_1" type="checkbox" tabindex="33"  name="sale_amount" data-objref="36 0 R" data-field-name="Check Box33" value="10,000" imageName="formasset/1/form/36 0 R" images="110100"/>
<input id="form34_1" type="text" tabindex="34" value="" data-objref="37 0 R" data-field-name="Text34"/>
<input id="form35_1" type="text" tabindex="35" value="" data-objref="38 0 R" data-field-name="Text35"/>
<input id="form36_1" type="checkbox" tabindex="36" data-objref="39 0 R" data-field-name="Check Box36" value="Yes" imageName="formasset/1/form/39 0 R" images="110100"/>
<input id="form37_1" type="checkbox" tabindex="37" value="500" name="package_detail" value="500" data-objref="16 0 R" data-field-name="Check Box37" imageName="formasset/1/form/16 0 R" images="110100" />
<input id="form38_1" type="checkbox" tabindex="38"   value="1000"  name="package_detail" value="1000" data-objref="31 0 R" data-field-name="Check Box38" imageName="formasset/1/form/16 0 R" images="110100" />
<input id="form39_1" type="checkbox" tabindex="39"   value="2000" name="package_detail"  value="2000" data-objref="42 0 R" data-field-name="Check Box39" imageName="formasset/1/form/16 0 R" images="110100" />
<input id="form40_1" type="text" tabindex="40" value="" data-objref="43 0 R" data-field-name="Text40"/>
<input id="form41_1" type="checkbox" tabindex="41" data-objref="44 0 R" data-field-name="Check Box41" value="Yes" imageName="formasset/1/form/30 0 R" images="110100"/>
<input id="form42_1" type="checkbox" tabindex="42" value="Yes" data-objref="45 0 R" data-field-name="Check Box42" imageName="formasset/1/form/45 0 R" images="110100" />
<input id="form43_1" type="text" tabindex="43" value="" data-objref="46 0 R" data-field-name="Text43"/>
<input id="title1" name="title1" type="text" tabindex="44"  value="{{$data?$data->title:''}}"  data-objref="47 0 R" data-field-name="Text44"/>
<input id="name1" name="name1" type="text" tabindex="45"  value="{{$data?$data->name:''}}" data-objref="48 0 R" data-field-name="Text45"/>
<input id="dob1" name="dob1" type="date"  value="12/08/2021"  tabindex="46"  data-objref="49 0 R" data-field-name="Text46"/>
<input id="gender1" name="gender1"  type="text" tabindex="47" value="{{$data?$data->gender:''}}" data-objref="50 0 R" data-field-name="Text47"/>
<input id="address1" name="address1" type="text" tabindex="48" value="{{$data?$data->address:''}}" data-objref="51 0 R" data-field-name="Text48"/>
<input id="form49_1" type="text" tabindex="49" value="" data-objref="52 0 R" data-field-name="Text49"/>
<input id="post1" name="post1" type="text" tabindex="50" value="{{$data?$data->post_or_zip:''}}" data-objref="53 0 R" data-field-name="Text50"/>
<input id="customer_id1" name="customer_id1" type="text" tabindex="51" value="{{$data?$data->customer_id:''}}" data-objref="54 0 R" data-field-name="Text51"/>
<input id="phone_no1" name="phone_no1" type="text" tabindex="52" value="{{$data?$data->phone_no:''}}" data-objref="55 0 R" data-field-name="Text52"/>
<input id="mobile_no1" name="mobile_no1" type="text" tabindex="53" value="{{$data?$data->mobile_no:''}}" data-objref="56 0 R" data-field-name="Text53"/>
<input id="email1" list="email" name="email1" type="text" tabindex="54" value="{{$email?$email:$data->email}}" data-objref="57 0 R" data-field-name="Text54"/>
<datalist id="email">
</datalist>

 
<input id="application_id1" name="application_id1" type="text" tabindex="55" value="<?php echo 'SA'.rand(00000,999999) ?>" data-objref="58 0 R" data-field-name="Text55" />
<input id="form56_1" type="checkbox" tabindex="56" data-objref="59 0 R" data-field-name="Check Box56" value="Yes" imageName="formasset/1/form/59 0 R" images="110100"/>
<input id="form57_1" type="checkbox" tabindex="57" data-objref="60 0 R" data-field-name="Check Box57" value="Yes" imageName="formasset/1/form/60 0 R" images="110100"/>
<input id="form58_1" type="text" tabindex="58" value="" data-objref="61 0 R" data-field-name="Text58"/>
<input id="title2" name="title2" type="text" tabindex="59" value="" data-objref="62 0 R" data-field-name="Text59"/>
<input id="name2" name="name2" type="text" tabindex="60" value="" data-objref="63 0 R" data-field-name="Text60"/>
<input id="dob2" name="dob2" type="date" tabindex="61" value="" data-objref="64 0 R" data-field-name="Text61"/>
<input id="gender2" name="gender2" type="text" tabindex="62" value="" data-objref="65 0 R" data-field-name="Text62"/>
<input id="address2" name="address2" type="text" tabindex="63" value="" data-objref="66 0 R" data-field-name="Text63"/>
<input id="form64_1" type="text" tabindex="64" value="" data-objref="67 0 R" data-field-name="Text64"/>
<input id="post2" name="post2" type="text" tabindex="65" value="" data-objref="68 0 R" data-field-name="Text65"/>
<input id="customer_id2" name="customer_id2" type="text" tabindex="66" value="" data-objref="69 0 R" data-field-name="Text66"/>
<input id="phone_no2" name="phone_no2" type="text" tabindex="67" value="" data-objref="70 0 R" data-field-name="Text67"/>
<input id="mobile_no2" name="mobile_no2" type="text" tabindex="68" value="" data-objref="71 0 R" data-field-name="Text68"/>
<input id="email2" list="email3"  name="email2" type="text" tabindex="69" value="" data-objref="72 0 R" data-field-name="Text69"/>
<datalist id="email3">
</datalist>
<input id="application2" name="application2" type="text" tabindex="70" value="<?php echo 'SA'.rand(00000,999999) ?>" data-objref="73 0 R" data-field-name="Text70"/>

<!-- End Form Data -->

<!-- call to setup Radio and Checkboxes as images, without this call images dont work for them -->
<script type="text/javascript">replaceChecks(false);</script>

</div>

</div>
</div>
</div>
<section class="mysection">

<button type="button" class="ajax">Submit</button>
<button type="button" id="nxtbtn"  onclick="location.href = '{{route('slide2')}}';"  >Next</button>

</section>
</form>
</div>

<script src="formasset/config.js" type="text/javascript"></script>
<script type="text/javascript">FormViewer.setup();</script>


<script>
        var fetchApplicat = "{{route('fetch-app1')}}";
        var fetchApplicatlist = "{{route('fetch-emaillist')}}";
   
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
        $.ajax({
        url: fetchApplicat,
        type: "GET",
        data: {'email':email},
        dataType:'JSON',
        
        success: function(response){
            if(response.status){
                $('#name1').val(response.data.name)
                $('#name1').prop('disabled', true);
                $('#title1').val(response.data.title)
                $('#title1').prop('disabled', true);
                $('#dob1').val(response.data.dob)
                $('#dob1').prop('disabled', true);

                $('#gender1').val(response.data.gender)
                $('#gender1').prop('disabled', true);

                $('#address1').val(response.data.address)
                $('#address1').prop('disabled', true);

                $('#post1').val(response.data.post_or_zip)
                $('#post1').prop('disabled', true);

                $('#phone_no1').val(response.data.phone_no)
                $('#phone_no1').prop('disabled', true);

                $('#mobile_no1').val(response.data.mobile_no)
                $('#mobile_no1').prop('disabled', true);

                $('#customer_id1').val(response.data.customer_id)
                $('#customer_id1').prop('disabled', true);

                //$('#email1').val(response.data.email)
                $('#application_id1').val(response.data.application_id)
                $('#application_id1').prop('disabled', true);

            }else{
                // $('#name1').val('');
                $('#name1').prop('disabled', false);
                // $('#title1').val('');
                $('#title1').prop('disabled', false);
                // $('#dob1').val('');
                $('#dob1').prop('disabled', false);
                // $('#gender1').val('');
                $('#gender1').prop('disabled', false);
                // $('#address1').val('');
                $('#address1').prop('disabled', false);
                // $('#post1').val('');
                $('#post1').prop('disabled', false);
                // $('#phone_no1').val('');
                $('#phone_no1').prop('disabled', false);
                // $('#mobile_no1').val('');
                $('#mobile_no1').prop('disabled', false);
                // $('#customer_id1').val('');
                $('#customer_id1').prop('disabled', false);
               // $('#email2').val(response.data.email)
                // $('#application_id1').val('');
                $('#application_id1').prop('disabled', false);
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
                // $('#name1').val(response.data.name)
                // $('#title1').val(response.data.title)
                // $('#dob1').val(response.data.dob)
                // $('#gender1').val(response.data.gender)
                // $('#address1').val(response.data.address)
                // $('#post1').val(response.data.post_or_zip)
                // $('#phone_no1').val(response.data.phone_no)
                // $('#mobile_no1').val(response.data.mobile_no)
                // $('#customer_id1').val(response.data.customer_id)
                // $('#application_id1').val(response.data.application_id)
                //$('#email1').val(response.data.email)

            }
        }
        })

        
    
    });

    $("#email2").on("change",function(){
        email = $(this).val()
        console.log($(this).attr('name'))
        $.ajax({
        url: fetchApplicat,
        type: "GET",
        data: {'email':email},
        dataType:'JSON',
        
        success: function(response){
            if(response.status){
                $('#name2').val(response.data.name);
                $('#name2').prop('disabled', true);
                $('#title2').val(response.data.title);
                $('#title2').prop('disabled', true);
                $('#dob2').val(response.data.dob);
                $('#dob2').prop('disabled', true);
                $('#gender2').val(response.data.gender);
                $('#gender2').prop('disabled', true);
                $('#address2').val(response.data.address);
                $('#address2').prop('disabled', true);
                $('#post2').val(response.data.post_or_zip);
                $('#post2').prop('disabled', true);
                $('#phone_no2').val(response.data.phone_no);
                $('#phone_no2').prop('disabled', true);
                $('#mobile_no2').val(response.data.mobile_no);
                $('#mobile_no2').prop('disabled', true);
                $('#customer_id2').val(response.data.customer_id);
                $('#customer_id2').prop('disabled', true);
               // $('#email2').val(response.data.email)
                $('#application2').val(response.data.application_id);
                $('#application2').prop('disabled', true);
            }else{
                // $('#name2').val('');
                $('#name2').prop('disabled', false);
                // $('#title2').val('');
                $('#title2').prop('disabled', false);
                // $('#dob2').val('');
                $('#dob2').prop('disabled', false);
                // $('#gender2').val('');
                $('#gender2').prop('disabled', false);
                // $('#address2').val('');
                $('#address2').prop('disabled', false);
                // $('#post2').val('');
                $('#post2').prop('disabled', false);
                // $('#phone_no2').val('');
                $('#phone_no2').prop('disabled', false);
                // $('#mobile_no2').val('');
                $('#mobile_no2').prop('disabled', false);
                // $('#customer_id2').val('');
                $('#customer_id2').prop('disabled', false);
               // $('#email2').val(response.data.email)
                // $('#application2').val('');
                $('#application2').prop('disabled', false);
            }
        }
        }) });
        $("#mobile_no2").on("change",function(){
        mobile = $(this).val()
        console.log($(this).attr('name'))
        $.ajax({
        url: fetchApplicat,
        type: "GET",
        data: {'mobile':mobile},
        dataType:'JSON',
        
        success: function(response){
            if(response.status){
                // $('#name2').val(response.data.name)
                // $('#title2').val(response.data.title)
                // $('#dob2').val(response.data.dob)
                // $('#gender2').val(response.data.gender)
                // $('#address2').val(response.data.address)
                // $('#post2').val(response.data.post_or_zip)
                // $('#phone_no2').val(response.data.phone_no)
                // $('#mobile_no2').val(response.data.mobile_no)
                // $('#customer_id2').val(response.data.customer_id)
                // $('#email2').val(response.data.email)
                // $('#application2').val(response.data.application_id)
            }
        }
        }) });

        $("#email1").on("input", function() {
            var email = $(this).val();
            checkEmailSuggetion('#email',email);
        });

        $("#email2").on("input", function() {
            var email = $(this).val();
            checkEmailSuggetion('#email3',email);
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
                    $('#email').html($html);
                    response.data.forEach((element)=>{
                        emails.push(element.email);
                        $html = $html + '<option value="' + element.email + '"/>';
                    });
                    $(id).html($html);
                    console.log(emails);
                    
                }

            }
        }
        });
        }
    </script>

</body>
</html>
