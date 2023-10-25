<?php
class CustomPDOManager extends PDOManagerClass {
    public function __construct(string $DBName)
    {
        parent::__construct($DBName);
    }
    
    public function displayAll($table) {
        $data = $this->findAll($table);
        
        echo '<table border="1">';
        echo '<tr>';
        
        foreach ($data[0] as $column => $value) {
            echo '<th>' . htmlspecialchars($column) . '</th>';
        }
        echo '</tr>';
        
        foreach ($data as $row) {
            echo '<tr>';
            foreach ($row as $value) {
                echo '<td>' . htmlspecialchars($value) . '</td>';
            }
            echo '</tr>';
        }
        
        echo '</table>';
    }
    
    public function displayBy($table, $column, $value, $order = null) {
        $conditions = [$column => $value];
        $data = $this->findBy($table, $conditions, $order);
        echo '<table border="1">';
        echo '<tr>';
        
        foreach ($data[0] as $column => $value) {
            echo '<th>' . htmlspecialchars($column) . '</th>';
        }
        echo '</tr>';
        
        foreach ($data as $row) {
            echo '<tr>';
            foreach ($row as $value) {
                echo '<td>' . htmlspecialchars($value) . '</td>';
            }
            echo '</tr>';
        }
        echo '</table>';
    }
}