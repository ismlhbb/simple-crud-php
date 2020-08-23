<?php
// Controller Page
require_once 'db.php';
$db = new Database();
if (isset($_POST['action']) && $_POST['action'] == "view") {
    $output =  '';
    $data = $db->read();
    if ($db->totalRowCount() > 0) {
        $output .=
            '<table class="table table-striped table-sm table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>Name</th>
                        <th>NIM</th>
                        <th>Major</th>
                        <th>Action</th>
                    </tr>
                </thead>
            <tbody>';
        $no = 1;
        foreach ($data as $row) {
            $output .= '<tr class="text-center">
                <td>' . $no . '</td>
                <td>' . $row['name'] . '</td>
                <td>' . $row['nim'] . '</td>
                <td>' . $row['major'] . '</td>
                <td>
                    <a href="#" title="View Details" class="text-success infoBtn" id="' . $row['id'] . '"><i class="fa fa-info-circle fa-lg"></i></a>&nbsp;&nbsp;
                    <a href="#" title="Edit Student" class="text-primary editBtn" id="' . $row['id'] . '" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit fa-lg"></i></a>&nbsp;&nbsp;
                    <a href="#" title="Delete Student" class="text-danger delBtn" id="' . $row['id'] . '"><i class="fa fa-trash fa-lg"></i></a>&nbsp;&nbsp;
                </td></tr>
            ';
            $no++;
        }
        $output .= '</tbody></table>';
        echo $output;
    } else {
        echo '<h3 class="text-center mt-5">:( There is no student to show!</h3>';
    }
}

if (isset($_POST['action']) && $_POST['action'] == "create") {
    $name = $_POST['name'];
    $nim = $_POST['nim'];
    $major = $_POST['major'];

    $db->create($name, $nim, $major);
}

if (isset($_POST['edit_id'])) {
    $id = $_POST['edit_id'];
    $row = $db->getStudentById($id);
    echo json_encode($row);
}

if (isset($_POST['action']) && $_POST['action'] == "update") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $nim = $_POST['nim'];
    $major = $_POST['major'];

    $db->update($id, $name, $nim, $major);
}

if (isset($_POST['del_id'])) {
    $id = $_POST['del_id'];

    $db->delete($id);
}

if (isset($_POST['info_id'])) {
    $id = $_POST['info_id'];

    $row = $db->getStudentById($id);
    echo json_encode($row);
}

if (isset($_GET['export']) && $_GET['export'] == "excel") {
    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=student.xls");
    header("Pragma: no-catch");
    header("Expires: 0");

    $data = $db->read();
    echo '
    <table border ="1">';
    echo '
    <tr>
        <th>ID</th>
        <th>Full Name</th>
        <th>NIM</th>
        <th>Major</th>
    </tr>';
    foreach ($data as $row) {
        echo '
        <tr>
            <td>' . $row['id'] . '</td>
            <td>' . $row['name'] . '</td>
            <td>' . $row['nim'] . '</td>
            <td>' . $row['major'] . '</td>
        </tr>';
    }
    echo '
    </table>';
}
