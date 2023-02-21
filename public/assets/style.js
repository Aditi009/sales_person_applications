
var showValidationErrors = (array, title) => {
  if (true) {
        for (var prop in array) {

      var div = document.createElement("div");
    //   div.setAttribute("class", "help-block");
      div.style.color = "#f96868";
      toastr.error(array[prop][0]);

      if (document.getElementsByName(prop).length == 0) {
        var split = prop.split("@")[0];
        if (split == "item_file") {
          toastr.error(array[prop][0]);
          return false;
        } else {
          toastr.error(
            "Inventory Items missing in Mascot " +
              prop.split(".")[0].split("@")[1]
          );
          return false;
        }
      }
      var element = document.querySelector("[name='" + prop + "']");
      if (element.hasAttribute("data-select2-id")) {
        element.parentNode.append(div);
      } else {
        insertAfter(div, element);
      }
    }
    return false;
  }

};
var insertAfter = (el, referenceNode) => {
  referenceNode.parentNode.insertBefore(el, referenceNode.nextSibling);
};
document.addEventListener("click", function (e) {
  if (e.target.classList.contains("ajax")) {
    var button = e.target.innerHTML;

    e.target.innerHTML = '<i class="fa fa-spinner fa-spin"></i>';
    e.target.disabled = true;
    // $('#voyager-loader').show();

    var data = {};
    var URL = e.target.form.getAttribute("action");
    var Method = e.target.form.getAttribute("method");
    var Id = e.target.form.getAttribute("id");
    if(Id == null){
      Id = "myapplicantform";
    }
    var form = document.getElementById(Id);
    var formData = new FormData(form);

    e.target.disabled = false;
    
    formData.append("_token", document.getElementById("token").content);

    fetch(URL, {
      method: Method,
      body: formData,
    }).then((response) => {
      response.json().then((data) => {
        $("#voyager-loader").hide();
        e.target.innerHTML = button;
        var errors = document.getElementsByClassName("help-block");
        for (var i = errors.length - 1; i >= 0; i--) {
          errors[i].parentNode.removeChild(errors[i]);
        }
        if (data.response == "errors") {
          e.target.disabled = false;
          $(".check").val("0");
          showValidationErrors(data.errors, data.title);
          if (
            data.title != "fabric-proposals-part-update" &&
            data.title != "fabric-proposals-part-add"
          ) {
            window.scrollTo(0, 0);
          }
        } else if (data.response == "success") {
          // e.target.disabled = true;
          alert("Saved Successfully");
        } else if (data.response == "failure") {
         
          toastr.error(data.message);
        }
      });
    });
  }
});
// For record deletion purposes
document.addEventListener("click", (e) => {
  if (e.target.classList.contains("data-delete")) {
    var Url = e.target.getAttribute("data-url");
    var id = e.target.getAttribute("data-id");
    swal({
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover this record!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        fetch(Url + "?id=" + id).then((response) => {
          response.json().then((response) => {
            if (response.response == "success") {
              if (e.target.getAttribute("data-type") == "project") {
                var data = JSON.parse(
                  $("#old_docx" + e.target.getAttribute("data-count")).val()
                );
                for (var i = data.length - 1; i >= 0; i--) {
                  if (data[i].id == e.target.getAttribute("data-id")) {
                    data.splice(i, 1);
                  }
                }
                $("#old_docx" + e.target.getAttribute("data-count")).val(
                  JSON.stringify(data)
                );
                e.target.parentNode.parentNode.parentNode.remove();
                return false;
              }
              if (e.target.getAttribute("data-type") == "pimage") {
                var data = JSON.parse(
                  $("#old_docx" + e.target.getAttribute("data-count")).val()
                );
                for (var i = data.length - 1; i >= 0; i--) {
                  if (data[i].id == e.target.getAttribute("data-id")) {
                    data.splice(i, 1);
                  }
                }
                $("#old_docx" + e.target.getAttribute("data-count")).val(
                  JSON.stringify(data)
                );
                e.target.parentNode.remove();
                return false;
              }
              swal(response.message, {
                icon: "success",
              }).then((response) => {
                if (response) {
                  location.reload();
                }
              });
            } else if (response.response == "failure") {
              var span = document.createElement("span");
              span.innerHTML =
                response.message +
                "<br>" +
                "Error Hint:" +
                response.log +
                "<br>";
              swal(span);
            }
          });
        });
      }
    });
  } else if (e.target.classList.contains("purchase-remove")) {
    var Url = e.target.getAttribute("data-url");
    var id = e.target.getAttribute("data-id");
    swal({
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover this record!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        fetch(Url + "?id=" + id).then((response) => {
          response.json().then((response) => {
            if (response.response == "success") {
              switch (response.title) {
                case "deletePSI":
                  swal(response.message, {
                    icon: "success",
                  });
                  e.target.parentNode.parentNode.remove();
                  break;
              }
            } else if (response.response == "fail") {
              var span = document.createElement("span");
              span.innerHTML =
                response.message +
                "<br>" +
                "Error Hint:" +
                response.log +
                "<br>";
              swal(span);
            }
          });
        });
      }
    });
  }
});

// For file upload purposes
document.addEventListener("change", (e) => {
  if (e.target.classList.contains("data-upload")) {
    var data = JSON.parse(
      document.getElementById("old_docx" + e.target.getAttribute("data-id"))
        .value
    );
    var Url = e.target.getAttribute("data-url");
    var formData = new FormData();
    formData.append("_token", document.getElementById("token").content);
    formData.append("image", e.target.files[0]);
    formData.append("project_id", e.target.getAttribute("data-id"));
    formData.append("image_id", e.target.getAttribute("data-image"));
    formData.append("costume_id", e.target.getAttribute("data-costume"));
    fetch(Url, {
      method: "POST",
      body: formData,
    }).then((response) => {
      response.json().then((response) => {
        if (response.response == "success") {
          switch (response.title) {
            case "requirement-update":
              for (var i = data.length - 1; i >= 0; i--) {
                if (data[i].id == e.target.getAttribute("data-image")) {
                  data.splice(i, 1);
                }
              }
              data.push(response.data);
              document.getElementById(
                "old_docx" + e.target.getAttribute("data-id")
              ).value = JSON.stringify(data);
              e.target.setAttribute("data-image", response.data.id);
              e.target.parentNode.parentNode.parentNode.getElementsByClassName(
                "image-uploaded"
              )[0].style.backgroundImage =
                "url(" + response.data.image_url + ")";
              break;
          }
        }
      });
    });
  }
});

var toastMessage = () => {
  if (document.URL.includes("?q=")) {
    toastr.success(decodeURI(window.location.search.split("=")[1]));

    window.history.pushState({}, document.title, "" + window.location.pathname);
  }

  if (document.URL.includes("&q=")) {
    toastr.success(decodeURI(window.location.search.split("=")[2]));
    const urlParams = new URLSearchParams(location.search);
    for (const [key, value] of urlParams) {
      let addQueryString = "";
      if (value != "" && value != null) {
        addQueryString = window.location.search.split("&q")[0];
        window.history.replaceState(
          {},
          document.title,
          "" + window.location.pathname + addQueryString
        );
      }
      //  if (value == 'table') {
      //  addQueryString = '?type=table';
      //  window.history.replaceState({}, document.title, "" + window.location.pathname+addQueryString);
      // } else if (value == 'packing') {
      //     addQueryString = '?type=packing';
      //     window.history.replaceState({}, document.title, "" + window.location.pathname+addQueryString);
      // } else if(value == '') {
      //     window.history.replaceState({}, document.title, "" + window.location.pathname+addQueryString);
      // } else if (value == 'mascot-enterprise-private-limited') {
      //      addQueryString = '?company=mascot-enterprise-private-limited';
      //     window.history.replaceState({}, document.title, "" + window.location.pathname+addQueryString);
      // }  else if (value == 'ccm-costume-rental-private-limited') {
      //      addQueryString = '?company=ccm-costume-rental-private-limited';
      //     window.history.replaceState({}, document.title, "" + window.location.pathname+addQueryString);
      // } else if (value == 'customade-costume-and-merchandise-private-limited') {
      //      addQueryString = '?company=customade-costume-and-merchandise-private-limited';
      //     window.history.replaceState({}, document.title, "" + window.location.pathname+addQueryString);
      // } else if (value == 'mascot' || value == 'costume' || value == 'prop') {
      //      addQueryString = window.location.search.split("&q")[0];
      //     window.history.replaceState({}, document.title, "" + window.location.pathname+addQueryString);
      // }
    }
  }
};

var number_only = () => {
  ["paste", "keypress"].forEach(function (type, index) {
    document.addEventListener(type, (e) => {
      if (e.target.classList.contains("number_only")) {
        if (e.type == "keypress") {
          if (!arr.includes(e.keyCode)) {
            e.preventDefault();
          }
        } else if (e.type == "paste") {
          const clipboardData = event.clipboardData || window.clipboardData;
          const pastedData = clipboardData.getData("Text");
          if (isNaN(pastedData)) {
            event.preventDefault();
          } else {
            return;
          }
        }
      }
    });
  });
};

var text_only = () => {
  ["paste", "keypress"].forEach(function (type, index) {
    document.addEventListener(type, (e) => {
      if (e.target.classList.contains("text_only")) {
        if (e.type == "keypress") {
          const specialCharKeys = [
            33, 34, 35, 36, 37, 38, 40, 41, 42, 43, 45, 46, 47, 58, 60, 62, 63,
            64, 94, 95, 123, 124, 125, 126,
          ];
          const allSpecialCharKeys = arr.concat(specialCharKeys);
          const uniqueKeys = Array.from(new Set(allSpecialCharKeys));
          if (uniqueKeys.includes(e.keyCode) /*|| e.shiftKey==1 */) {
            e.preventDefault();
          }
        } else if (e.type == "paste") {
          const clipboardData = event.clipboardData || window.clipboardData;
          const pastedData = clipboardData.getData("Text");
          const specialChars = /[ `!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
          const numbers = /\d/;
          if (specialChars.test(pastedData) || numbers.test(pastedData)) {
            e.preventDefault();
          }
        }
      }
    });
  });
};

var today = new Date();
var datePickerConfig;

$("body").on("focus", ".boot-date", function () {
  $(".datepicker").css("visibility", "visibile");
});

setTimeout(toastMessage, 500);
// toastMessage();
number_only();
text_only();

if (document.URL.includes("admin/customer-requirements")) {
  $(".input-tags").tagsinput();
}

if (document.URL.includes("admin/requested-items")) {
  if (document.getElementById("arrInvent")) {
    $(".input-tags").tagsinput({
      allowDuplicates: false,
      itemValue: "id",
      itemText: "text",
    });
    var data = JSON.parse(document.getElementById("arrInvent").value);
    for (var i = data.length - 1; i >= 0; i--) {
      $(".input-tags").tagsinput("add", data[i]);
    }
  }
}



// For updation purposes
document.addEventListener("click", (e) => {
  if (e.target.classList.contains("update")) {
    var data = {};
    var URL = e.target.form.getAttribute("action");
    var Method = e.target.form.getAttribute("method");
    var Id = e.target.form.getAttribute("id");
    var form = document.getElementById(Id);
    var formData = new FormData(form);
    formData.append("_token", document.getElementById("token").content);
    fetch(URL, {
      method: Method,
      body: formData,
    }).then((response) => {
      response.json().then((data) => {
        // e.target.disabled = false;
        // e.target.innerHTML = button;
        var errors = document.getElementsByClassName("help-block");
        for (var i = errors.length - 1; i >= 0; i--) {
          errors[i].parentNode.removeChild(errors[i]);
        }
        if (data.response == "errors") {
          showValidationErrors(data.errors, data.title);
        } else if (data.response == "success") {
          switch (data.title) {
            case "updatePurchase":
              toastr.success(data.message);
              break;
          }
        } else if (data.response == "failure") {
          toastr.error(data.message);
        }
      });
    });
    return false;
  }
});

function appendCostumeData(formId, formData) {
  var form = $("#" + formId);
  var costumePartCount = form.find(".nav-link.parts").length;
  var index = form.find('input[name="costume_index"]').val();

  formData.append("costume_part_count$" + index, costumePartCount);

  for (let subIndex = 0; subIndex < costumePartCount; subIndex++) {
    var partInventoryCount = form.find(
      ".part-inventories-" + index + "-" + subIndex
    ).length;
    formData.append(
      "costume_part_inventory_count$" + index + "$" + subIndex,
      partInventoryCount
    );
  }

  return formData;
}

function getMascotJSONDatesArray() {
  var jsonDatesArr = [];
  var jsonDates = document.getElementsByClassName("jsonDates");

  for (var i = jsonDates.length - 1; i >= 0; i--) {
    var $lables = jsonDates[i].getElementsByClassName("timeline-label");
    var $input = jsonDates[i].getElementsByClassName("timeline-date");
    var $completed = jsonDates[i].getElementsByClassName("timeline-completed");
    var tempArr = [];

    for (var j = $lables.length - 1; j >= 0; j--) {
      var object = {};
      object.label = $lables[j].innerText.trim();
      object.date = $input[j].value;
      object.is_completed = $completed[j].checked ? true : false;

      tempArr.push(object);
    }
    jsonDatesArr[i] = tempArr;
  }

  return jsonDatesArr;
}

function getMascotPackagingChecklistArray() {
  var jsonPackageChecklist = [];
  var checklist = document.getElementsByClassName("json-packaging-checklist");

  for (var i = checklist.length - 1; i >= 0; i--) {
    var $lables = checklist[i].getElementsByClassName("package-label");
    var $input = checklist[i].getElementsByClassName("package-value");
    var tempArr = [];

    for (var j = $lables.length - 1; j >= 0; j--) {
      var object = {};
      object.label = $lables[j].innerText.trim();
      object.value = $input[j].value;

      tempArr.push(object);
    }

    jsonPackageChecklist[i] = tempArr;
  }

  return jsonPackageChecklist;
}

let showingTableInfoFontBold = {
  lengthMenu: "Show _MENU_",
  zeroRecords: "No record found",
  info: "Showing <b size='2' style='font-weight:800 !important'>_START_</b> to <b size='2' style='font-weight:800 !important'>_END_</b> of <b size='2' style='font-weight:800 !important'>_TOTAL_</b>",
  infoFiltered: "(filtered from _MAX_ total records)",
  infoEmpty:
    "Showing <font size='2' style='font-weight:800 !important'>0</font> to <b size='2' style='font-weight:800 !important'>_END_</b> of <b size='2' style='font-weight:800 !important'>_TOTAL_</b>",
};

function getMascotImageComments(costumeCount) {
  var mascotImageComment = [];

  for (var i = 0; i < costumeCount; i++) {
    var comments = [];
    var defaultImage = $("img#design" + i).attr("src");

    if ($(".mascot-image-comments-" + i).length > 0) {
      $(".mascot-image-comments-" + i).each(function () {
        var comment = $(this).val(),
          positionLeft = $(this).data("position-left"),
          positionTop = $(this).data("position-top");

        comments.push({
          comment: comment,
          position_left: positionLeft,
          position_top: positionTop,
        });
      });

      mascotImageComment[i] = comments;
    }
  }

  return mascotImageComment;
}

// For file upload purposes
document.addEventListener("change", (e) => {
  if (e.target.type == "date" && e.target.value != "") {
    var yesterday = new Date();
    yesterday.setDate(yesterday.getDate() - 1);
    var selectedDate = new Date(e.target.value);
    var selectedDateTimestamp = selectedDate.getTime();
    var yesterdayTimestamp = yesterday.getTime();

    if (selectedDateTimestamp >= yesterdayTimestamp) {
      e.target.value = e.target.value;
    } else {
      e.target.value = "";
      toastr.error("Past dates are disabled. Please select future date.");
    }
  }
});

function zeroPad(num) {
  return num.toString().padStart(2, "0");
}

// $(document).on('focus','input[name="daterange"], input[name="request_date_time"], input[name="daterange1"]',function(){
//     var currentTime = new Date();
//     // First Date Of the month
//     var startDateFrom = new Date(currentTime.getFullYear(),currentTime.getMonth(),1);
//     // Last Date Of the Month
//     var startDateTo = new Date(currentTime.getFullYear(),currentTime.getMonth() +1,0);

//     $(this).daterangepicker({
//         startDate: startDateFrom,
//         endDate: startDateTo,
//         autoApply: false,
//         locale: {
//             "format": "DD/MM/YYYY",
//         }
//     });
// });



function checkValue(str, max) {
  if (str.charAt(0) !== "0" || str == "00") {
    var num = parseInt(str);
    if (isNaN(num) || num <= 0 || num > max) num = 1;
    str =
      num > parseInt(max.toString().charAt(0)) && num.toString().length == 1
        ? "0" + num
        : num.toString();
  }

  return str;
}

function getLogoArray() {
  var arr = [];

  $(".artwork-processing-section")
    .find(".logo-image")
    .each(function () {
      var inputElement = $(this)
        .parent()
        .find(".img-buttons")
        .find('input[name="is_default_logo"]');
      var isChecked = inputElement.is(":checked");

      arr.push({ src: this.src, default: isChecked });
    });
  return arr;
}

function getCostumeArtworkProcessingArray() {
  var arr = [];

  $(".costume-artwork-proecessing-images").each(function () {
    var subArr = [];

    $(this)
      .find(".logo-image")
      .each(function () {
        var costumeIndex = $(this).data("costume-index");
        var inputElement = $(this)
          .parent()
          .find(".img-buttons")
          .find('input[name="is_default_logo' + costumeIndex + '"]');
        var isChecked = inputElement.is(":checked");

        subArr.push({ src: this.src, default: isChecked });
      });

    arr.push(subArr);
  });

  return arr;
}

// Start: image upload on selection
$(document).ready(function () {
  // $('body').on('change', 'input[type="file"]', function() {
  //     var $this           = $(this);
  //     var ref             = $(this).data('ref');
  //     var imageFolder     = $(this).data('image-folder');
  //     var target          = $(this).data('target');
  //     var files           = this.files;
  //     var Method          = "POST";
  //     var formData        = new FormData();
  //     var csrfToken       = $('#token').attr('content');
  //     var baseUrl         = $('#baseUrl').attr('content');
  //     var URL             = baseUrl + '/file-upload';
  //     var oldImages       = $('input[name="'+target+'"]').val();

  //     if(files.length) {

  //         $.each(files, function(index, value) {
  //             formData.append('files[]', value);
  //         });

  //         formData.append("_token", csrfToken);
  //         formData.append('folder_name', imageFolder);
  //         formData.append('old_images', oldImages);

  //         $.ajax({
  //             url: URL,
  //             type: Method,
  //             data: formData,
  //             dataType:'JSON',
  //             contentType: false,
  //             cache: false,
  //             processData: false,
  //             success: function(response){
  //                 if(response.status && response.data.length) {
  //                     $('input[name="'+target+'"]').val(JSON.stringify(response.data));
  //                     $this.val('');
  //                     files       = [];
  //                     $this.files = files;

  //                 } else {
  //                     // toastr.error(response.message);
  //                 }
  //             },
  //             error: function(jqXHR, textStatus, errorMessage) {
  //                 // toastr.error('Something went wrong.');
  //             }
  //         });

  //     } else {
  //         var id = $(this).attr('id');
  //         if (id.indexOf('ref_docx') > -1) {
  //           toastr.error('File format not supported');
  //         } else {
  //           toastr.error('Please select images.');
  //         }

  //     }
  // });

  // $('body').on('click', '.btn-link', function() {
  //     var target = $(this).data('target');
  //     $('.expansion-panel').each(function() {
  //         $(this).addClass('collapse');
  //         $(this).removeClass('show');
  //     });

  //     $(target).addClass('show');
  // });
  $(".collapse").collapse({
    toggle: false,
  });
});
// End: image upload on selection

// Start: update small sections
document.addEventListener("click", function (e) {
  if (e.target.classList.contains("update-section")) {
    var button = e.target.innerHTML;
    e.target.innerHTML = '<i class="fa fa-spinner fa-spin"></i>';
    e.target.disabled = true;
    var data = {};
    var URL = e.target.form.getAttribute("action");
    var Method = e.target.form.getAttribute("method");
    var Id = e.target.form.getAttribute("id");
    var classes = e.target.form.getAttribute("class");
    var classArr = classes.split(" ");
    var form = document.getElementById(Id);
    var formData = new FormData(e.target.form);

    if (classArr.includes("update-artwork")) {
      /** Update costume artwork */
      var costumeArtworkProcessingArray = getCostumeArtworkProcessingArray();
      formData.append(
        "json_costume_artwork_processing",
        JSON.stringify(costumeArtworkProcessingArray)
      );
    } else if (classArr.includes("frm-add-costume-item")) {
      /** Add costume item */
      formData = appendCostumeData(e.target.form.id, formData);
      var jsonDatesArr = getMascotJSONDatesArray();
      var costumeArtworkProcessingArray = getCostumeArtworkProcessingArray();
      var imageTaggingArray = getImageTaggingArray();

      formData.append("jsonDates", JSON.stringify(jsonDatesArr));
      formData.append(
        "costume_image_tagging",
        JSON.stringify(imageTaggingArray)
      );
      formData.append(
        "json_costume_artwork_processing",
        JSON.stringify(costumeArtworkProcessingArray)
      );
    } else if (classArr.includes("update-progress-timeline")) {
      /** Update progress timelime */
      var jsonDatesArr = getMascotJSONDatesArray();
      formData.append("jsonDates", JSON.stringify(jsonDatesArr));
    } else if (classArr.includes("update-image-tagging")) {
      /** Update costume tagged image */
      var imageTaggingArray = getImageTaggingArray();
      formData.append(
        "costume_image_tagging",
        JSON.stringify(imageTaggingArray)
      );
    } else if (classArr.includes("update-costume-part")) {
      /** Update costume parts */
      var cForm = $("#" + Id);
      var index = cForm.find('input[name="costume_index"]').val();
      var costumePartCount = cForm.find("a.costume-part-link-" + index).length;

      formData.append("costume_part_count$" + index, costumePartCount);

      for (let subIndex = 0; subIndex < costumePartCount; subIndex++) {
        var partInventoryCount = cForm.find(
          ".part-inventories-" + index + "-" + subIndex
        ).length;
        formData.append(
          "costume_part_inventory_count$" + index + "$" + subIndex,
          partInventoryCount
        );
      }
    } else if (classArr.includes("frm-add-mascot-item")) {
      /** add mascot item */
      var custumeCount = $(".nav-link.costumes").length,
        jsonDatesArr = getMascotJSONDatesArray(),
        jsonMascotImageComments = getMascotImageComments(custumeCount),
        logosArr = getLogoArray(),
        assignedInventory = $("#assignedInventory").val(),
        costumeArtworkProcessingArray = getCostumeArtworkProcessingArray();

      formData.append("jsonDates", JSON.stringify(jsonDatesArr));
      formData.append(
        "image_comments",
        JSON.stringify(jsonMascotImageComments)
      );
      formData.append("json_logos", JSON.stringify(logosArr));
      formData.append("assignedInventory", assignedInventory);
      formData.append(
        "json_costume_artwork_processing",
        JSON.stringify(costumeArtworkProcessingArray)
      );
    } else if (classArr.includes("update-mascot-body-part")) {
      var custumeCount = $(".nav-link.costumes").length;
      var jsonMascotImageComments = getMascotImageComments(custumeCount);
      var assignedInventory = $("#assignedInventory").val();

      formData.append(
        "image_comments",
        JSON.stringify(jsonMascotImageComments)
      );
      formData.append("assignedInventory", assignedInventory);
    } else if (classArr.includes("add-prop-item")) {
      /** Add costume item */
      formData = appendCostumeData(e.target.form.id, formData);
      var jsonDatesArr = getMascotJSONDatesArray();
      var costumeArtworkProcessingArray = getCostumeArtworkProcessingArray();
      var jsonPackageChecklist = getMascotPackagingChecklistArray();

      formData.append("jsonDates", JSON.stringify(jsonDatesArr));
      formData.append(
        "json_costume_artwork_processing",
        JSON.stringify(costumeArtworkProcessingArray)
      );
      formData.append(
        "json_packaging_checklist",
        JSON.stringify(jsonPackageChecklist)
      );
    } else if (classArr.includes("update-packaging-checklist")) {
      var jsonPackageChecklist = getMascotPackagingChecklistArray();

      formData.append(
        "json_packaging_checklist",
        JSON.stringify(jsonPackageChecklist)
      );
    }

    formData.append("_token", document.getElementById("token").content);

    fetch(URL, {
      method: Method,
      body: formData,
    }).then((response) => {
      response.json().then((data) => {
        e.target.disabled = false;
        e.target.innerHTML = button;

        var errors = document.getElementsByClassName("help-block");
        for (var i = errors.length - 1; i >= 0; i--) {
          errors[i].parentNode.removeChild(errors[i]);
        }

        if (data.response == "errors") {
          showValidationErrors(data.errors, data.title);
          console.log("0");
          $(".check").val("0");
          window.scrollTo(0, 0);
        } else if (data.response == "success") {
          if (data.title == "reload") {
            window.location.href = data.redirect_url + "?q=" + data.message;
          } else {
            toastr.success(data.message);
          }
        } else if (data.response == "failure") {
          toastr.error(data.message);
        }
      });
    });
  }
});
// End: update small sections

function getImageTaggingArray() {
  var taggingArray = [];
  var jsonTaggingArray = document.getElementsByClassName(
    "costume-image-tagging"
  );

  for (var i = jsonTaggingArray.length - 1; i >= 0; i--) {
    var $commentType =
      jsonTaggingArray[i].getElementsByClassName("comment-type");
    var $comment = jsonTaggingArray[i].getElementsByClassName("comment");
    var tempArr = [];

    for (var j = $comment.length - 1; j >= 0; j--) {
      var object = {};
      var commentData = $comment[j].dataset;

      object.comment_type = $commentType[j].value;
      object.comment = $comment[j].value.trim();
      object.position_left = commentData.positionLeft;
      object.postion_right = commentData.positionTop;

      tempArr.push(object);
    }
    taggingArray[i] = tempArr;
  }

  return taggingArray;
}

function getTalentMeasurements() {
  var talentsMeasurements = $(".talents");
  var talentsData = [];

  talentsMeasurements.each(function (index, value) {
    var talents = [];
    var measurementId = $(this).data("measurement-id");

    $(value)
      .find(".quality-repetition-content")
      .each(function (sIndex, sValue) {
        var measurements = [];
        var stageDate = $(sValue).find(".stage-date").val();

        $(sValue)
          .find(".measurement-row")
          .each(function (s1Index, s1Value) {
            var object = new Object();
            var propertyName = $(s1Value).find("th").html();
            var inputs = $(s1Value).find("input");
            var mData = [];

            object["column_name"] = propertyName;

            inputs.each(function (s2Index, s2Value) {
              var pName = $(s2Value).attr("name");
              var pValue = $(s2Value).val();

              object[pName] = pValue;
            });

            measurements.push(object);
          });

        talents.push({ stage_date: stageDate, repetitions: measurements });
      });

    talentsData.push({ measurement_id: measurementId, measurements: talents });
  });

  return JSON.stringify(talentsData);
}

$(document).on("focus", ".time", function () {
  $(this).timepicker({
    timeFormat: "HH:mm",
    interval: 30,
    dynamic: false,
    dropdown: true,
    scrollbar: true,
  });
});

// Check if customer contact numbers are valid
function checkCustomersValidMessages(formId) {
  var errorMessages = $(".contact-number-div");
  var isContactNumbersValid = false;

  errorMessages.each(function () {
    let input = $(this).find("input").val();
    let message = $(this).find(".error-message").text();

    if (input && !message) {
      isContactNumbersValid = true;
    } else {
      isContactNumbersValid = false;
    }
  });

  return isContactNumbersValid;
}

document.addEventListener("click", function (e) {
  if (e.target.classList.contains("ajax-update")) {
    var button = e.target.innerHTML;

    e.target.innerHTML = '<i class="fa fa-spinner fa-spin"></i>';
    e.target.disabled = true;

    var data = {};
    var URL = e.target.form.getAttribute("action");
    var Method = e.target.form.getAttribute("method");
    var Id = e.target.form.getAttribute("id");
    var form = document.getElementById(Id);
    var classes = e.target.form.getAttribute("class");
    classes = classes.split(" ");
    var formData = new FormData(form);

    if (classes.includes("update-talent-measurements")) {
      var talentMeasurement = getTalentMeasurementRepetions(Id);

      formData.append("measurements_repititions", talentMeasurement);
    }

    formData.append("_token", document.getElementById("token").content);

    fetch(URL, {
      method: Method,
      body: formData,
    }).then((response) => {
      response.json().then((data) => {
        $("#voyager-loader").hide();
        e.target.disabled = false;
        e.target.innerHTML = button;
        var errors = document.getElementsByClassName("help-block");
        for (var i = errors.length - 1; i >= 0; i--) {
          errors[i].parentNode.removeChild(errors[i]);
        }

        if (data.response == "errors") {
          showValidationErrors(data.errors, data.title);
          window.scrollTo(0, 0);
        } else if (data.response == "success") {
          toastr.success(data.message);
        } else if (data.response == "failure") {
          toastr.error(data.message);
        }
      });
    });
  }
});

// initialize project status popover
function initProjectStatusPopover() {
  $(".change-project-status").popover({
    placement: "bottom",
    // title: 'Status',
    animation: true,
    trigger: "click",
    html: true,
    content: function () {
      return $("#statusPopoverHtml").html();
    },
  });
}

//Project assign table
$("body").on("click", ".trigger-assign-team-modal", function () {
  let targetModal = $(this).attr("data-target-div");
  $(targetModal).modal("show");
});

document.addEventListener("click", function (e) {
  if (e.target.classList.contains("update-inventory")) {
    var button = e.target.innerHTML;
    e.target.innerHTML = '<i class="fa fa-spinner fa-spin"></i>';
    e.target.disabled = true;
    var data = {};
    var URL = e.target.form.getAttribute("action");
    var Method = e.target.form.getAttribute("method");
    var Id = e.target.form.getAttribute("id");
    var classes = e.target.form.getAttribute("class");
    var classArr = classes.split(" ");
    var form = document.getElementById(Id);
    var formData = new FormData(e.target.form);

    formData.append("_token", document.getElementById("token").content);

    fetch(URL, {
      method: Method,
      body: formData,
    }).then((response) => {
      response.json().then((data) => {
        e.target.disabled = false;
        e.target.innerHTML = button;

        var errors = document.getElementsByClassName("help-block");
        for (var i = errors.length - 1; i >= 0; i--) {
          errors[i].parentNode.removeChild(errors[i]);
        }

        if (data.response == "errors") {
          showValidationErrors(data.errors, data.title);
          window.scrollTo(0, 0);
        } else if (data.response == "success") {
          toastr.success(data.message);
        } else if (data.response == "failure") {
          toastr.error(data.message);
          window.scrollTo(0, 0);
        }
      });
    });
  }
});

function dataURLtoFile(dataurl, filename) {
  var arr = dataurl.split(","),
    mime = arr[0].match(/:(.*?);/)[1],
    bstr = atob(arr[1]),
    n = bstr.length,
    u8arr = new Uint8Array(n);

  while (n--) {
    u8arr[n] = bstr.charCodeAt(n);
  }

  return new File([u8arr], filename, { type: mime });
}

$("body").on("click", 'button[data-dismiss="alert"]', function () {
  let modalId = $(this).attr("data-modal-id");
  if (typeof modalId !== undefined) {
    swal({
      title: "Are you sure?",
      text: "",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        $("#" + modalId).modal("hide");
      }
    });
  }
});

/**start: model js code for all**/
function addClass() {
  var modalDialog = $(this).find(".modal-dialog");

  // Applying the top margin on modal to align it vertically center
  $("body").addClass("modal-overlay");
}

function removeClass() {
  var modalDialog = $(this).find(".modal-dialog");

  // Applying the top margin on modal to align it vertically center
  $("body").removeClass("modal-overlay");
}
// Align modal when it is displayed
$("body").on("show.bs.modal", ".modal", function (e) {
  if (e.namespace == "bs.modal") {
    addClass();
  }
});

$("body").on("hide.bs.modal", ".modal", function (e) {
  if (e.namespace == "bs.modal") {
    removeClass();
  }
});

$(document).ready(function () {
  $('[data-toggle="tooltip"]').tooltip();
  $("body").addClass("add-height");
  setTimeout(function () {
    $("body").removeClass("add-height");
  }, 200);
});

/** Generate random number */
function generateRandomNumber() {
  return Math.floor(Math.random() * 10000000000);
}


/** Delete owl carousel item */
function deleteCarouselItem(carouselQuery, randomNumber) {
  var carousel = $(carouselQuery);
  var items = carousel.find(".owl-item");
  var deletedItemIndex = [];

  if (items.length) {
    items.each(function (index, item) {
      if ($(this).find(".delete-btn").data("random") == randomNumber) {
        deletedItemIndex.push(index);
      }
    });
  }

  if (deletedItemIndex.length) {
    carousel
      .trigger("remove.owl.carousel", deletedItemIndex)
      .trigger("refresh.owl.carousel");
  }
}
/**end: model js code for all**/
/** Show lightbox image **/
$(document).ready(function () {
  "use strict";
  $("body").on("click", ".lightbox", function () {
    var imgsrc = $(this).attr("data-src");
    // var imgsrc = $(this).attr('src');
    $("body").append(
      "<div class='img-popup'><div class='close-lightbox'><span class='cross'>&times;</div><img src='" +
        imgsrc +
        "' class='lightbox'></div>"
    );
    $(".close-lightbox, .img-popup").click(function () {
      $(".img-popup")
        .fadeOut(500, function () {
          $(this).remove();
        })
        .addClass("lightboxfadeout");
    });
  });
  $("body").on("click", ".lightbox", function () {
    $(".img-popup").fadeIn(500);
  });
});
$(
  ".reset-form, .all_reset-form, .approved_reset-form, .pending_reset-form, .denied_reset-form, .purchased_reset-form"
).on("click", function () {
  $(".daterange-div").show();
});


// set input type number positive value only
$('input[type="number"]').attr("min", 0);
// time convert to hours and minutes
function timeConvertUsingMillseconds(millseconds, time_type) {
  let h = Math.floor(millseconds / 1000 / 60 / 60);
  let m = Math.floor((millseconds / 1000 / 60 / 60 - h) * 60);
  let s = Math.floor(((millseconds / 1000 / 60 / 60 - h) * 60 - m) * 60);
  switch (time_type) {
    case "h":
      return h;
      break;
    case "m":
      return m;
      break;
    case "s":
      return s;
      break;
  }
}

// stop enter key
function stopEnterKey() {
  $(document).on("keypress", 'input[name="search_text"]', function (e) {
    if (e.which == 13) e.preventDefault();
  });
}

//Show all data of table
$(function () {
  $(".show_all").click();
});

//multiple click on delete button solution

$("body").on("click", ".message-send", function () {
  setTimeout(function () {
    disableButton();
  }, 0);
});

function disableButton() {
  $(".message-send").prop("disabled", true);
}

// $('input').attr('maxLength',20)

$("#delete_form").submit(function () {
  $(this).find("input[type='submit']").prop("disabled", true);
});

var getUrlParameter = function getUrlParameter(sParam) {
  var sPageURL = window.location.search.substring(1),
    sURLVariables = sPageURL.split("&"),
    sParameterName,
    i;

  for (i = 0; i < sURLVariables.length; i++) {
    sParameterName = sURLVariables[i].split("=");

    if (sParameterName[0] === sParam) {
      return sParameterName[1] === undefined
        ? true
        : decodeURIComponent(sParameterName[1]);
    }
  }
  return false;
};

//funcyion for single decimal value
$(".single-decimal").on("input", function () {
  let value = this.value;
  let result = value
    .replace(/[^0-9-.]/g, "")
    .replace(/(?!^)-/g, "")
    // prevent inserting dots after the first one
    .replace(/([^.]*\.[^.]*)\./g, "$1");
  this.value = result;
});
function submitClicked() {
  setTimeout(function () {
    $("#submit-button").prop("disabled", true).val("Wait...");
  }, 100);
}

$(".taginputes").on("beforeItemRemove", function (e) {
  e.cancel = true; //set cancel to false..
});



