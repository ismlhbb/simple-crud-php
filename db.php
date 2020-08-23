<?php
// Model page | dsn stands for data source network | ob stands for object | stmt stands for statements
class Database
{
    private $dsn = "mysql:host=localhost;dbname=simplecrud2php";
    private $username = "root";
    private $password = "";
    public $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO($this->dsn, $this->username, $this->password);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function create($name, $nim, $major)
    {
        $sql = "INSERT INTO students (name, nim, major) VALUES (:name,:nim,:major)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['name' => $name, 'nim' => $nim, 'major' => $major]);
        return true;
    }
    public function read()
    {
        $data = array();
        $sql = "SELECT * FROM students";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $data[] = $row;
        }
        return $data;
    }
    public function getStudentById($id) // untuk memanggil data dari tabel beradasarkan id yang dikirim
    {
        $sql = "SELECT * FROM students WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function update($id, $name, $nim, $major)
    {
        $sql = "UPDATE students SET name=:name, nim=:nim, major=:major WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['name' => $name, 'nim' => $nim, 'major' => $major, 'id' => $id]);
        return true;
    }

    public function delete($id)
    {
        $sql = "DELETE FROM students WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return true;
    }

    public function totalRowCount()
    {
        $sql = "SELECT * FROM students";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $t_rows = $stmt->rowCount();
        return $t_rows;
    }
}
// $ob = new Database();
// echo $ob->totalRowCount(); // ini untuk menghitung jumlah record
// print_r($ob->read()); // ini untuk mengambil data dari database
