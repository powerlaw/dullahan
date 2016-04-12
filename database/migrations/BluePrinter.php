<?php
/**
 * Created by PhpStorm.
 * User: xieyi
 * Date: 15/5/6
 * Time: 下午8:05
 */



use Illuminate\Database\Query\Grammars\MySqlGrammar;

class BluePrinter {
    protected static $verbs = [
        'select','insert','update','delete','replace','create','alter','drop'
    ];
    const CREATE_DATABASE_IF_NOT_EXISTS='create_database_if_not_exists';
    const CREATE_TABLE_IF_NOT_EXISTS='create_table_if_not_exists';
    const DROP_TABLE_IF_EXISTS='drop_table_if_exists';

    protected $sqls=[];
    protected $grammar;
    protected  static $instance;
    public function __construct($sql,$options=[])
    {
        $this->setSqls($sql);
        if (isset($options['grammar'])){
            $this->grammar = $options['grammar'];
        }else{
            $this->grammar = new MySqlGrammar();
        }
        return $this;
    }

    public function setSqls($sqls)
    {
        if (is_array($sqls))
        {
            $this->sqls = $sqls;
        }else{
            $this->sqls = [$sqls];
        }
        $this->sqls = $sqls;
    }



    public static function instance($sql,$options=[])
    {
        if (static::$instance)
        {
            static::$instance->setSqls($sql);
        }else{
            static::$instance = new static($sql,$options);
        }
        return static::$instance;
    }
    public function addClause($name)
    {
        $method = camel_case($name);
        $parameters = array_slice(func_get_args(),1);
        $clause = call_user_func_array(array($this,$method),$parameters);
        $this->mergeAtBefore($clause);
        return $this;
    }
    public function getClause($name,$upper=true)
    {
        $method = camel_case($name);
        $parameters = array_slice(func_get_args(),1);
        $clause = call_user_func_array(array($this,$method),$parameters);
        return $upper ? $this->_uppercase($clause) : $this->_lowercase($clause);
    }
    private function mergeAtBefore($sql)
    {
        !is_array($sql) && $sql = [$sql];
        $this->sqls = array_merge($sql,$this->sqls);
    }
    private function mergeAtAfter($sql)
    {
        !is_array($sql) && $sql = [$sql];
        $this->sqls = array_merge($this->sqls,$sql);
    }

    protected function createDatabaseIfNotExists($database)
    {
        return "create database {$this->wrap($database)} if not exists";
    }
    protected function createTableIfNotExists($table)
    {
        return "create table {$this->wrap($table)} if not exists";
    }
    protected function dropTableIfExists($table)
    {
        return "drop table if exists {$this->wrap($table)}";
    }
    protected function wrap($name,$isTable=true)
    {
        if ($isTable){
            return $this->grammar->wrapTable($name);
        }else{
            return $this->grammar->wrap($name);
        }
//        $wrap = '`';
//        $name = str_replace($wrap,'',$name);
//        $names = explode('.',$name);
//        array_walk($names,function(&$val) use ($wrap){
//            $val = $wrap.$val.$wrap;
//        });
//        $name = implode('.',$names);
//        return $name;
    }
    protected function _uppercase($sql)
    {
        return $this->changecase('strtoupper',$sql);
    }
    protected function _lowercase($sql)
    {
        return $this->changecase('strtolower',$sql);
    }
    protected function _newline($sql)
    {
        if(!ends_with($sql,"\n") && !ends_with($sql,';')){
            $sql .= ';';
        }elseif(!ends_with($sql,"\n")){
            $sql .= "\n";
        }
        return $sql;
    }
    protected function _semicolon($sql)
    {
        if(!ends_with($sql,"\n") && !ends_with($sql,';')){
            $sql .= ';';
        }
        return $sql;
    }
    private function changecase($method,$sql)
    {
        if (preg_match_all( '/`.+?`/',$sql,$matches)){
            $sql = preg_replace('/`.+?`/','%s',$sql);
//            $sql = $method($sql);
            $matches = $matches[0];
//            foreach($matches as $key=>$val)
//            {
//                $matches[$key] = $method($val);
//            }
            $sql = vsprintf($sql, $matches);
        }
        return $sql;
    }
    protected function _prettify($sql)
    {
//        return \SqlFormatter::format($sql);
        $verb = $this->parseVerb($sql);
        $method = 'prettify'.ucfirst($verb);
        if (method_exists($this,$method)){
            return $this->{$method}($sql);
        }
        return $sql;
    }

    public function __call($method, $parameters)
    {
        $parameters = array_merge([$method],$parameters);
        if (method_exists($this,$method)){
            return $this->{$method};
        }
        call_user_func_array(array($this,'each'),$parameters);
        return $this;
    }

    public static function __callStatic($method, $parameters)
    {
        $parameters = array_merge([$method],$parameters);
        if (method_exists(static::$instance,$method)){
            return static::$instance->{$method};
        }
        return call_user_func_array(array(static::$instance,'_'.$method),$parameters);
    }

    public function toText()
    {
        $this->semicolon()
            ->newline()
            ->uppercase()
            ->prettify();
        return $this->__toString();
    }
    public function __toString()
    {
        return implode('',$this->sqls);
    }

    protected function parseVerb($sql)
    {
        foreach (self::$verbs as $verb)
        {
            if (preg_match('/^\s*'.$verb.'/',$sql)){
                return $verb;
            }
        }
        return false;
    }

    protected function prettifyCreate($sql)
    {
        $offset = strpos($sql,'(');
        if ($offset!==false){
            $sql = substr($sql,0,$offset)."(\n   ".substr($sql,$offset+1);
            $offset = strrpos($sql,')');
            $sql = substr($sql,0,$offset)."\n)".substr($sql,$offset+1);
            $sql = preg_replace('/,/',",\n  ",$sql);
        }
        return $sql;
    }
    protected function prettifyInsert($sql)
    {
        return $sql;
    }
    protected function prettifyUpdate($sql)
    {
        return $sql;
    }
    protected function prettifySelect($sql)
    {
        return $sql;
    }
    protected function prettifyDelete($sql)
    {
        return $sql;
    }
    protected function each($method)
    {
        $params = array_slice(func_get_args(),1);
        $method = '_'.$method;
        foreach($this->sqls as $key=>$val)
        {
//            call_user_func_array(array($this,'_'.$method),$params);
            $this->sqls[$key] = $this->{$method}($val);
        }
        return $this;
    }
} 