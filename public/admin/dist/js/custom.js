$(document).ready(function() {
   $("#current_pwd").keyup(function(){
    var current_pwd = $("#current_pwd").val();
    var verifyCurrentPwd = document.getElementById("verifyCurrentPwd");
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:'post',
        url:'/admin/check-current-password',
        data:{current_pwd:current_pwd},
        success:function(resp){
            if(resp == "false"){
                verifyCurrentPwd.style.color = "red";
                $("#verifyCurrentPwd").html('Current Password is Incorrect');
            }
            else if(resp == "true"){
                verifyCurrentPwd.style.color = "green";
                $("#verifyCurrentPwd").html('Current Password is Correct');
            }
        },error:function(){
            alert("Error");
        }
    })
   })

   $("#confirm_pwd").keyup(function(){
    var confirm_pwd = $("#confirm_pwd").val();
    var new_pwd = $("#new_pwd").val();
    var checkConfirmPwd = document.getElementById("checkConfirmPwd");
    if(new_pwd == confirm_pwd){
        checkConfirmPwd.style.color = "green";
        $("#checkConfirmPwd").html('New Password & Confirm Password is matched');
    }
    else{
        checkConfirmPwd.style.color = "red";
        $("#checkConfirmPwd").html('New Password & Confirm Password do not match');
    }
    
   })

   $(document).on("click",".updateCmsPageStatus",function(){
    var status = $(this).children("i").attr('status');
    var page_id = $(this).attr('page_id');
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:'post',
        url:'/admin/update-cms-page-status',
        data:{status:status,page_id:page_id},
        success:function(resp){
            if(resp['status'] == 0){
                $("#page-"+page_id).html("<i class='fas fa-toggle-off' style='color:grey' status='Inactive'></i>");
            }
            else if(resp['status'] == 1){
                $("#page-"+page_id).html("<i class='fas fa-toggle-on' style='color:#007bff' status='Active'></i>");
            }
        },error:function(){
            alert("Error");
        }
    })
   })


   $(document).on("click",".updateSubadminStatus",function(){
    var status = $(this).children("i").attr('status');
    var page_id = $(this).attr('page_id');
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:'post',
        url:'/admin/update-subadmin-status',
        data:{status:status,page_id:page_id},
        success:function(resp){
            if(resp['status'] == 0){
                $("#page-"+page_id).html("<i class='fas fa-toggle-off' style='color:grey' status='Inactive'></i>");
            }
            else if(resp['status'] == 1){
                $("#page-"+page_id).html("<i class='fas fa-toggle-on' style='color:#007bff' status='Active'></i>");
            }
        },error:function(){
            alert("Error");
        }
    })
   })


   

//    $(document).on("click",".confirmDelete",function(){
//     var name = $(this).attr('name');
//         if(confirm('Are you sure to delete this '+ name+'?')){
//             return true;
//         }
//     return false;
//    });

   $(document).on("click",".confirmDelete",function(){
    var record   = $(this).attr('record');
    var recordid = $(this).attr('recordid');
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
          window.location.href = "/admin/delete-"+record+"/"+recordid;
        }
      })

    });


    $(document).on("click",".SubadminconfirmDelete",function(){
        var record   = $(this).attr('record');
        var recordid = $(this).attr('recordid');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              )
              window.location.href = "/admin/delete-"+record+"/"+recordid;
            }
          })
    
        });

    

});