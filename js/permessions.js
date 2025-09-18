

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
    $(document).on("click","#deleteP",function(e)
    {
      Swal.fire({
  title: "Are you sure?",
  text: "You won't be able to revert this!",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Yes, delete it!"
}).then((result) => {
  if (result.isConfirmed) {
       let id = $("#deleteP").attr("userId");

    $.ajax({
            type: "POST",
            url: "./apis/permessions_api.php",
            data: {"action":"permessionDelete","id":id},
            dataType: "json",
            success: function (response) {
                
      Swal.fire({
                title: response.status,      // e.g. "success" or "error"
                text: response.message,
                icon: response.status       // make sure server returns 'success'/'error' etc.
            }).then(function () {
                // reset form only on success
                if (response.status === "success") {
                     read();
                   
                  
                }

                // optional: refresh table / UI here
                // loadPermissions(); // your function to reload list
            });
            }
        });

  }
});
    });
    

// Show Edit Modal with data
$(document).on("click", ".editP", function () {
    let id = $(this).data("id");
    let name = $(this).data("name");
    let dname = $(this).data("dname");
    let description = $(this).data("description");

    $("#editId").val(id);
    $("#editDName").val(dname);
    $("#editPermession").val(name);
    $("#editDescription").val(description);

    $("#editModal").removeClass("hidden");
});

// Close modal
function closeEditModal() {
    $("#editModal").addClass("hidden");
}

// Submit update
$("#permessionEditForm").submit(function (e) {
    e.preventDefault();
    let formData = new FormData(this);
    formData.append("action", "permessionUpdate");

    $.ajax({
        type: "POST",
        url: "./apis/permessions_api.php",
        data: formData,
        dataType: "json",
        processData: false,
        contentType: false,
        success: function (response) {
            Swal.fire({
                title: response.status,
                text: response.message,
                icon: response.status
            }).then(function () {
                if (response.status === "success") {
                    read();
                    closeEditModal();
                }
            });
        },
        error: function (xhr, status, error) {
            console.error("Update error:", error);
            Swal.fire("Error", "Server error occurred!", "error");
        }
    });
});


});