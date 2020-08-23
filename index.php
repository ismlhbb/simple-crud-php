<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.21/datatables.min.css" />
    <title>Simple CRUD | PHP</title>

</head>

<body>
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <!-- Brand -->
        <a class="navbar-brand" href="#">Simple CRUD</a>

        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
            </ul>
        </div>
    </nav>


    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="text-center font-weight-normal my-3">Simple CRUD App Using PHP-OOP, PDO-MySQL</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <h4 class="mt-2">All Students</h4>
            </div>
            <div class="col-lg-6">
                <button type="button" class="btn btn-primary m-1 float-right" data-toggle="modal" data-target="#addModal">
                    <i class="fa fa-user-plus fa-lg"></i>&nbsp;Add New Student
                </button>
                <a href="action.php?export=excel" class="btn btn-success m-1 float-right">
                    <i class="fa fa-table fa-lg"></i>&nbsp;Export Data to Excel</a>
            </div>
        </div>
        <hr class="my-1">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive" id="showStudent">
                    <h3 class="text-center" style="margin-top:150px;">Loading...</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Add New Student Modal -->
    <div class="modal fade" id="addModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add New Student</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body px-4">
                    <form action="" method="post" id="form-data">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Name" required>
                        </div>
                        <div class="form-group">
                            <label for="nim">Nomor Induk Mahasiswa (NIM)</label>
                            <input type="number" name="nim" class="form-control" placeholder="NIM" required>
                        </div>
                        <div class="form-group">
                            <label for="major">Major</label>
                            <input type="text" name="major" class="form-control" placeholder="Major" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="create" id="create" value="Add New Student!" class="btn btn-primary btn-block">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- End of Add New Student Modal -->

    <!-- Edit Student Modal -->
    <div class="modal fade" id="editModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Student</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body px-4">
                    <form action="" method="post" id="edit-form-data">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" name="name" class="form-control" id="name" required>
                        </div>
                        <div class="form-group">
                            <label for="nim">Nomor Induk Mahasiswa (NIM)</label>
                            <input type="number" name="nim" class="form-control" id="nim" required>
                        </div>
                        <div class="form-group">
                            <label for="major">Major</label>
                            <input type="text" name="major" class="form-control" id="major" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="update" id="update" value="Edit Student!" class="btn btn-danger btn-block">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- End of Edit Student Modal -->

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Datatables -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.21/datatables.min.js"></script>
    <!-- Sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- MyScript -->
    <!-- Datatable script -->
    <script type="text/javascript">
        $(document).ready(function() {
            showAllStudents();

            function showAllStudents() {
                $.ajax({
                    url: "action.php",
                    type: "POST",
                    data: {
                        action: "view"
                    },
                    success: function(response) {
                        $("#showStudent").html(response);
                        $("table").DataTable({
                            order: [0, 'desc']
                        });
                        // console.log(response);
                    }
                });
            }

            // 'Create' ajax request
            $("#create").click(function(e) {
                if ($("#form-data")[0].checkValidity()) {
                    e.preventDefault();
                    $.ajax({
                        url: "action.php",
                        type: "POST",
                        data: $("#form-data").serialize() + "&action=create", // grab all input field value
                        success: function(response) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Student Added Successfully!',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $("#addModal").modal('hide');
                            $("#form-data")[0].reset();
                            showAllStudents();
                        }
                    });
                }
            });
            // End of 'Create' ajax request
            // Edit Student
            $("body").on("click", ".editBtn", function(e) {
                e.preventDefault();
                edit_id = $(this).attr('id');
                $.ajax({
                    url: "action.php",
                    type: "POST",
                    data: {
                        edit_id: edit_id
                    },
                    success: function(response) {
                        data = JSON.parse(response);
                        console.log(data);
                        $("#id").val(data.id);
                        $("#name").val(data.name);
                        $("#nim").val(data.nim);
                        $("#major").val(data.major);
                    }
                });
            });
            // End of Edit Student
            // 'Update' ajax request
            $("#update").click(function(e) {
                if ($("#edit-form-data")[0].checkValidity()) {
                    e.preventDefault();
                    $.ajax({
                        url: "action.php",
                        type: "POST",
                        data: $("#edit-form-data").serialize() + "&action=update", // grab all input field value
                        success: function(response) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Student Updated Successfully!',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $("#editModal").modal('hide');
                            $("#edit-form-data")[0].reset();
                            showAllStudents();
                        }
                    });
                }
            });
            // End of 'Update' ajax request
            // 'Delete' ajax request
            $("body").on("click", ".delBtn", function(e) {
                e.preventDefault(); // stop refreshing whole page
                var tr = $(this).closest('tr');
                del_id = $(this).attr('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "action.php",
                            type: "POST",
                            data: {
                                del_id: del_id
                            },
                            success: function(response) {
                                tr.css('background-color', '#d31623');
                                Swal.fire(
                                    'Deleted!',
                                    'Student has been deleted.',
                                    'success'
                                )
                                showAllStudents();
                            }
                        });
                    }
                });
            });
            // End of 'Delete' ajax request
            // Show student details
            $("body").on("click", ".infoBtn", function(e) {
                e.preventDefault();
                info_id = $(this).attr('id');
                $.ajax({
                    url: "action.php",
                    type: "POST",
                    data: {
                        info_id: info_id
                    },
                    success: function(response) {
                        // console.log(response);
                        data = JSON.parse(response); // conver json to javascript object
                        Swal.fire({
                            title: '<strong>Student Info : ID(' + data.id + ')</strong>',
                            icon: 'info',
                            html: '<b>Full Name : </b>' + data.name + ' <br><b> NIM : </b>' + data.nim + '<br><b>Major : </b>' + data.major,
                            showCancelButton: true
                        })
                    }
                });
            });
            // End of show student details

        });
    </script>
</body>

</html>