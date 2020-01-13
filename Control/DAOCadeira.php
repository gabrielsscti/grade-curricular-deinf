<?php
class DAOCadeira{
    public static $table_name = "cadeira";

    public function __construct(){
    }

    private function getWhereStatement($statement){
        return ($statement) ? " WHERE {$statement}" : null;
    }

    private function getTableName($table){
        $prefix = DB_PREFIX;
        if(isset($prefix))
            return $prefix . '_' . $table;
        return $table;
    }

    private function execute($query){
        $link = DBConnect();
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        DBClose($link);
        return $result;
    }

    private function read($params = null, $fields="*"){
        $table = $this->getTableName(DAOCadeira::$table_name);
        $params = ($params) ? " {$params}":null;
        $query = "SELECT {$fields} FROM {$table}{$params}";
        $result = $this->execute($query);
        $data = null;
        if(!mysqli_num_rows($result))
            return false;
        else
            while($res=mysqli_fetch_assoc($result))
                $data[]=$res;
        return $data;
    }

    public static function getMaxPeriodo(){
        $dc = new DAOCadeira();
        $data = $dc->read(null, "max(periodo) as periodo");
        return $data[0]["periodo"];
    }

    public static function getMaxGrupos(){
        $dc = new DAOCadeira();
        $data = $dc->read(null, "max(grupo) as grupo");
        return $data[0]["grupo"];
    }

    public function getCadeirasObrigatorias(){
        $dataCadeira = $this->read("WHERE periodo IS NOT NULL ORDER BY periodo ASC");
        $cadeiras = array();
        foreach($dataCadeira as $i){
            array_push($cadeiras, $this->getCadeiraFromArray($i));

        }
        return $cadeiras;
    }

    public function getPreReqsByReqId($id){
        $dcc = new DAOCadeiraCadeira();
        $preReqData = $dcc->getCadeiraCadeiraFromFatherId($id);
        $r = array();
        foreach($preReqData as $preReq)
            array_push($r, $this->getCadeiraById($preReq->getIdPreRequisito()));
        return $r;
    }

    public function getCadeiraById($id){
        $dataCadeira = $this->read("WHERE idCadeira = " . $id);
        return $this->getCadeiraFromArray($dataCadeira[0]);
    }

    private function getCadeiraFromArray($cadeira){
        return new Cadeira(
            $cadeira["idCadeira"],
            $cadeira["nome"],
            $cadeira["departamento"],
            $cadeira["creditos"],
            $cadeira["codigo"],
            $cadeira["iseletiva"],
            $cadeira["grupo"],
            $cadeira["periodo"],
            $cadeira["ementa"]
        );
    }

    public function getCadeirasEletivas(){
        $dataCadeira = $this->read("WHERE periodo IS NULL ORDER BY grupo ASC");
        $r = array();
        foreach($dataCadeira as $i){
            $cadeira = $this->getCadeiraFromArray($i);
            if(!isset($r[$cadeira->getGrupo()]))
                $r[$cadeira->getGrupo()] = array();
            array_push($r[$cadeira->getGrupo()], $this->getCadeiraFromArray($i));
        }
        return $r;
    }
}
    

    

    
/*
    function DBInsert($table, array $data){
        $table = getTableName($table);
        $data = DBEscape($data);
        $query = "INSERT INTO {$data}({$fields}) VALUES({$values})";
        return DBExecute($query);

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
    }*/
?>