$(document).ready(function () {
    
    // Insert Start Here
        $(document).on("submit", "#insertForm", function(e){
        e.preventDefault();
        // alert("clicked");
        // console.log("clicked");

         let formdata=new FormData(this);
        formdata.append("action", "insertF");
        formdata.append("insertF", "nuurdiin");
        // console.log(formdata);

        $.ajax({
            type: "POST",
            url: "apis/users_api.php",
            data: formdata,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (response) {
                //console.log(response.message);
                if(response.status=="success"){
                    Swal.fire({
                        title: "Good job!",
                        text: response.message,
                        icon: "success"
                      });
                      readrequest();
                      $("#insertForm")[0].reset( );
                   
                }else if(response.status=="error"){
                    Swal.fire({
                        title: "I'M Sorry!",
                        text: response.message,
                        icon: "error"
                      });
                }
                
            }
        });

        });

            // Insert Start Here

                // Read Start Here
                function readrequest(){
                        $.ajax({
                            type: "POST",
                            url: "apis/users_api.php",
                            data: {"action" : "read", "read":"nuurdiin"},
                            dataType: "html",
                            success: function (response) {
                                //console.log(response);
                                $("#readBody").html(response);
                                
                            }
                        });
                }

                readrequest();
                    // Read End Here

                    // Delete Start Here
                      
    $(document).on("click", "#btnDelete", function(e){
        e.preventDefault()
        //console.log("clicked");
        let UserId=$(this).attr("user_id");
        //console.log(StudentId);
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
          $.ajax({
            type: "POST",
            url: "apis/users_api.php",
            data: {"action" : "delete", "user_id": UserId},
            dataType: "json",
            success: function (response) {
                //console.log(response.message);
                if(response.status=="success"){
                    Swal.fire({
                        title: "Good job!",
                        text: response.message,
                        icon: "success"
                      });
                      readrequest();
                }else if(response.status=="error"){
                    Swal.fire({
                        title: "Good job!",
                        text: response.message,
                        icon: "error"
                      });
            }
        }
            });
        
            }
        });
    })
 
                    // Delete End Here


                    // Read Update Start Here
                         //read update start here
        $(document).on("click", "#updateBtn", function(e){
            e.preventDefault();
           //console.log("clicked");
           let UserId = $(this).attr("user_id");
          // console.log(StudentId);
          $.ajax({
            type: "POST",
            url: "apis/users_api.php",
            data: {"action":"readupdate", "user_id":UserId},
            dataType: "html",
            success: function (response) {
               // console.log(response);
               $("#updateModalBody").html(response);
                
            }
          });
     })
      //read update end here

                    // Read Update End Here


});