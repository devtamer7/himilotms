

$(document).ready(function () {


    // Read
    function read()
    {
        $.ajax({
            type: "POST",
            url: "./apis/permessions_api.php",
            data: {"action":"permessionRead"},
            dataType: "html",
            success: function (response) {
                $("#permissionTableBody").html(response);
            }
        });
    }

    read();

    // Insert Request
    $("#permessionForm").submit(function (e) { 
        e.preventDefault();
        let formData = new FormData(this);
        formData.append("action","permessionInsert");
        $.ajax({
            type: "POST",
            url: "./apis/permessions_api.php",
            data: formData,
            dataType: "json",
            processData : false,
            contentType:false,
            success: function (response) {
            
                    Swal.fire({
                title: response.status,      // e.g. "success" or "error"
                text: response.message,
                icon: response.status       // make sure server returns 'success'/'error' etc.
            }).then(function () {
                // reset form only on success
                if (response.status === "success") {
                     read();
                    $("#permessionForm").reset(); // native reset
                  
                }

                // optional: refresh table / UI here
                // loadPermissions(); // your function to reload list
            });

            }
        });
    });

    // Delete
    
});