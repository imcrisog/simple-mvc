<?php

namespace App\Models;

use mysqli;

class Model {

    protected $db_host = MYSQL_DB_HOSTNAME;
    protected $db_username = MYSQL_DB_USERNAME;
    protected $db_password = MYSQL_DB_PASSWORD;
    protected $db_name = MYSQL_DB_NAME;

    protected $connection;
    protected $query;
    protected $table;

    public function __construct()
    {
        $this->connection();
    }

    public function connection()
    {
        $this->connection = new mysqli($this->db_host, $this->db_username, $this->db_password, $this->db_name);

        if ($this->connection->connect_error) {
            die("Error en la Conexion MySQL: {$this->connection->connect_error}");
        }
    }

    private function query($sql)
    {
        $this->query = $this->connection->query($sql);
        return $this;
    }

    public function first()
    {
        if (!$this->query) {
            $this->query = $this->connection->query("SELECT * FROM {$this->table}");
        }

        return $this->query->fetch_assoc();
    }

    public function get()
    {
        return $this->query->fetch_all(MYSQLI_ASSOC);
    }

    public function all()
    {
        $sql = "SELECT * FROM {$this->table}";
        $this->query($sql);
        return $this;
    }

    public function find($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = {$id}";
        return $this->query($sql)->first();
    }

    public function where($column, $op, $value = null)
    {
        if (!isset($value)) {
            $value = $op;
            $op = "=";
        }

        $sql = "SELECT * FROM {$this->table} WHERE {$column} {$op} '{$value}'";
        $this->query($sql);
        return $this;
    }

    public function create($data)
    {
        $data = $this->scape($data);

        if ($this->table == "users") {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        }

        $cols = array_keys($data);
        $cols = implode(", ", $cols);
        $vals = array_values($data);
        $vals = "'" . implode("', '", $vals) . "'";

        $sql = "INSERT INTO {$this->table} ({$cols}) VALUES ({$vals})";

        $this->query($sql);

        return $this->find($this->connection->insert_id);
    }

    public function update($id, $data)
    {
        $data = $this->scape($data);
        $fileds = [];

        foreach ($data as $key => $val) {
            $fields[] = "{$key} = '{$val}'";
        }

        $fields = implode(', ', $fields);

        $sql = "UPDATE {$this->table} SET {$fields} WHERE id = $id";

        $this->query($sql);
        return $this->find($id);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = {$id}";

        $this->query($sql);
    }

    /**
     * Todo con una Relacion Muchos a Muchos
     *
     * Obtener todos los valores de una relacion Muchos a Muchos
     *
     * @param string $table Nombre de la Tabla a relacionar
     * @param bool $contrary Si los nombres de las tablas se cambian de lugar. EJ: role_user si es true, user_role si es false
     * @param array $replace Nombre de la columna se reemplaza. EJ: ["name" => "role"]
     * @return this
     **/
    public function allWithMM(string $table, bool $contrary, array $replace = null)
    {
        $tf = trim($this->table, "s");
        $ts = trim($table, "s");
        if ($contrary) {
            $tj = $ts . "_" . $tf;
        } else {
            $tj = $tf . "_" . $ts;
        }

        if ($replace == null) {
            $tas = "*";
        } else {
            $tas = "{$replace[0]} AS {$replace[1]}";
        }

        $sql = "SELECT t.*, r.{$tas} FROM {$this->table} t INNER JOIN {$tj} ru ON t.id = ru.{$tf}_id INNER JOIN {$table} r ON ru.{$ts}_id = r.id";

        $this->query($sql);
        return $this;
    }

    private function scape($data)
    {
        foreach ($data as $key => $value) {
            $data[$key] = $this->connection->real_escape_string($value);
        }

        return $data;
    }
}