<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Student</title>

<link href="bootstrap.min.css" rel="stylesheet">
<script src="bootstrap.min.js"></script>
<link href="datatable.css" rel="stylesheet">

</head>
<body>

<script src="jquery.js"></script>
<script src="datatable.js"></script>
<script src="sweetalert.js"></script>
     
          <body class="p-4">

        <!-- Button to trigger modal -->
        <button type="button" class="btn btn-primary mb-5 float-end" data-bs-toggle="modal" data-bs-target="#addStudentModal">
            Add Student
        </button>

        <!-- Modal -->
        <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">

             <!-- Edit Student Modal -->
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addStudentModalLabel">Add Student</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="carForm">
                            <div class="mb-3">
                                <label for="name" class="form-label">Student Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter Student Name">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="phone" placeholder="Enter Student phone">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" placeholder="Enter Student address">
                            </div>
                            <div class="mb-3" id="listcourse">
                                <label for="course" class="form-label">Course Name</label>
                                <select  id="course">
                                </select>
                            </div>
                            <button type="button" class="btn btn-success" id="addnew">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="editStudentModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    
      <div class="modal-header">
        <h5 class="modal-title" id="editStudentModalLabel">Edit Student</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <div class="modal-body">
        <form id="editForm">
          <!-- Hidden ID -->
          <input type="hidden" id="edit_id">

          <div class="mb-3">
            <label for="edit_name" class="form-label">Student Name</label>
            <input type="text" class="form-control" id="edit_name" placeholder="Enter Student Name">
          </div>

          <div class="mb-3">
            <label for="edit_phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="edit_phone" placeholder="Enter Phone Number">
          </div>

          <div class="mb-3">
            <label for="edit_address" class="form-label">Address</label>
            <input type="text" class="form-control" id="edit_address" placeholder="Enter Address">
          </div>

          <div class="mb-3">
            <label for="edit_course" class="form-label">Course Name</label>
            <select class="form-select" id="edit_course">
            </select>
          </div>

          <button type="button" class="btn btn-primary" id="update">Update</button>
        </form>
      </div>

    </div>
  </div>
</div>
        
        <div id="studenttable"></div>
</body>

</body>
</html>

<script>

$(document).ready(function(){

    showstudent();

    function showstudent(){
        $.ajax({
            url: 'show_student_ajax.php' ,
            type: 'POST',
            data: {
                action : 'select'
            },
            success:function(response){
                console.log(response);
                $('#studenttable').html(response);
                $('#studentstables').DataTable();
            }
        });
    }
    
    
    $.ajax({
        url:'show_course.php',
        type:'POST',
        data :{
            action : 'select'
        },
        success:function(response){
            console.log(response);
            $('#course').html(response);
        }
    })

    

   /* $.ajax({
            type: "POST",
            url: "fetch_car.php",
            data: {
                action: 'select'
            },
            dataType: "json",
            success: function(response) {
                console.log(response)
                let html = '<table class="table table-bordered" id="carstables">';
                html += '<thead><tr><th>Car</th><th>Color</th><th>Action</th></tr></thead><tbody>';

                response.forEach(row => {
                    html += `<tr>
                 <td>${row.car}</td>
                 <td>${row.color}</td>
                 <td>
                   <button class="delete btn btn-danger btn-sm" value="${row.car_id}">Delete</button>
                   <button class="edit btn btn-success btn-sm" value="${row.car_id}" data-desc="${row.description}">Edit</button>
                 </td>
               </tr>`;
                });

                html += '</tbody></table>';
                $('#cartable').html(html);
                $('#carstables').DataTable();
            }
        });
    }

    */

    $('#addnew').on('click', function() {
        let name = $('#name').val().trim();
        let phone = $('#phone').val().trim();
        let address = $('#address').val().trim();
        let course = $('#course').val();
        if (name === "" || phone === "" || address === "" || course==="") {
            Swal.fire({
                icon: 'warning',
                title: 'Missing Data',
                text: 'Please fill in both fields.'
            });
        } else {
            $.ajax({
                url: 'addnewstudent_ajax.php',
                type: 'POST',
                data: {
                    name: name,
                    phone: phone,
                    address : address ,
                    course : course,
                    action: 'add'
                },
                success: function(response) {
                    console.log(response);
                    response = response.trim();
                    if (response === 'inserted') {
                        Swal.fire({
                        icon: 'success',
                        title: 'Student Added',
                        showConfirmButton: false,
                        timer: 1500
                        });
                        $('#addStudentModal').modal('hide');
                        $('#name').val('');
                        $('#phone').val('');
                        $('#address').val('');
                         showstudent()
                    } else if (response === 'exists') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Duplicate Code',
                            text: 'This code already exists.'
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An unexpected error occurred.'
                        });
                    }
                }
            });
        }
    });
 
    // Delete
    $(document).on('click', '.delete', function() {
        let student_id = $(this).val();
        Swal.fire({
            title: 'Are you sure?',
            text: "This record will be deleted permanently!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "delete_ajax.php",
                    data: {
                        student_id: student_id,
                        action: 'delete'
                    },
                    success: function(response) {
                        console.log(response);
                        response = response.trim();
                        if (response === 'deleted') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: 'Record has been deleted.',
                                timer: 1500,
                                showConfirmButton: false
                            });
                            showstudent();  
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Could not delete the record.'
                            });
                        }
                    }
                });
            }
        });
    });

    //update
    $(document).on('click', '.edit', function () {
    const student_id = $(this).val();

    $.ajax({
        url: 'get_student.php',
        type: 'POST',
        data: {
            action: 'get',
            student_id: student_id
        },
        success: function (response) {
            const data = response.trim().split('|');

            $('#edit_id').val(data[0]);
            $('#edit_phone').val(data[1]);
            $('#edit_address').val(data[2]);
            $('#edit_course').val(data[3]);
            $('#edit_name').val(data[4]);

            $.ajax({
                url: 'show_course.php',
                type: 'POST',
                data: { action: 'select' },
                success: function (html) {
                    $('#edit_course').html(html);
                    $('#edit_course').val(data[3]);
                    $('#editStudentModal').modal('show'); 
                }
            });
        }
    });
});

$('#update').on('click', function () {
    let id = $('#edit_id').val().trim();
    let name = $('#edit_name').val().trim();
    let phone = $('#edit_phone').val().trim();
    let address = $('#edit_address').val().trim();
    let course = $('#edit_course').val();

    if (name === "" || phone === "" || address === "" || course === "") {
        Swal.fire({
            icon: 'warning',
            title: 'Missing Data',
            text: 'Please fill in all fields.'
        });
    } else {
        $.ajax({
            url: 'updatestudent_ajax.php',
            type: 'POST',
            data: {
                id: id,
                name: name,
                phone: phone,
                address: address,
                course: course,
                action: 'update'
            },
            success: function (response) {
                console.log(response);
                response = response.trim();
                if (response === 'updated') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Updated!',
                        text: 'Student updated successfully.',
                        timer: 1500,
                        showConfirmButton: false
                    });
                    $('#editStudentModal').modal('hide');
                    showstudent(); // Refresh table
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Update failed.'
                    });
                }
            }
        });
    }
});


});


</script>