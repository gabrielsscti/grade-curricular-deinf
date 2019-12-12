<?php
    function getTableName($table){
        $prefix = DB_PREFIX;
        if(isset($prefix))
            return $prefix . '_' . $table;
        return $table;
    }

    function getWhereStatement($statement){
        return ($statement) ? " WHERE {$statement}" : null;
    }

    function DBDelete($table, $where = null){
        $table = getTableName($table);
        $where = getWhereStatement($where);
        $query = "DELETE FROM {$table}{$query}";
        return DBExecute($query);
    }

    function DBUpdate($table, array $data, $where = null){
        $table = getTableName($table);
        $where = getWhereStatement($statement);
        $fields = null;
        foreach($data as $key => $value)
            if($value)
                $fields[]= "{$key} = '{$value}'";
        
        $fields = implode(', ', $fields);
        $query = "UPDATE {$table} SET {$fields}{$where}";
        return DBExecute($query);
    }

    function DBRead($table, $params = null, $fields="*"){
        $params = ($params) ? " {$params}":null;
        $query = "SELECT {$fields} FROM {$table}{$params}";
        $result = DBExecute($query);
        $data = null;
        if(!mysqli_num_rows($result))
            return false;
        else
            while($res=mysqli_fetch_assoc($result))
                $data[]=$res;
        return $data;
    }

    function DBInsert($table, array $data){
        $table = getTableName($table);
        $data = DBEscape($data);
        $query = "INSERT INTO {$data}({$fields}) VALUES({$values})";
        return DBExecute($query);

    }

    function DBExecute($query){
        $link = DBConnect();
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        DBClose($link);
        return $result;
    }
?>