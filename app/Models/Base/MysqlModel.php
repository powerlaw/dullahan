<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Query\Expression;
//use App\Models\Mysql\Traits\NamingTable;
//use App\Models\Mysql\Traits\GenerateId;
//use App\Models\Mysql\Traits\TransformTime;
//use App\Models\Mysql\Traits\WriteOperation;
//use App\Models\Mysql\Traits\BuildRelations;

use ID;

class MysqlModel extends Model
{

    const RETURN_EXECUTE_RESULT = 0;
    const RETURN_ID = 1;
    const RETURN_AFFECTED_ROWS = 2;
    const RETURN_NATURE_ID = 3;

    protected $appName;
    protected $connection = 'mysql';
    protected $database;
    protected $table;

    protected $displayAttributes = ['*'];
    protected $pivot = false;

    public function getSelect($fields=[],$exclude=[])
    {
        $select = $this->displayAttributes;
        if (!empty($fields)){
            if(is_string($fields)){
                $select = array_intersect($select,explode(',',$fields));
            }elseif(is_array($fields)){
                $select = array_intersect($select,$fields);
            }
        }
        return array_diff($select,$exclude);
    }

    //Override
    public function getTable()
    {
        if (isset($this->table)) {
            $table = $this->table;
        }elseif (config('database.table_plural',false) && !$this->pivot){
            $table = str_replace('\\', '', Str::snake(Str::plural(class_basename($this))));
        }else{
            $table = str_replace('\\', '', Str::snake(class_basename($this)));
        }
        $table = $this->getDatabase().'.'.$table;
        return $table;
    }
    public function getDatabase()
    {
        if (empty($this->database)){
            $connection = $this->getConnectionName();
            $this->database = config("database.connections.$connection.database");
        }
        return $this->database;
    }
    public function getConnectionName()
    {
        if (empty($this->connection)){
            $this->connection = config('database.default','mysql');
        }
        return $this->connection;
    }

    public function wrap($name)
    {
        $wrap = '`';
        $name = str_replace($wrap,'',$name);
        //        $name = $this->getConnection()->getSchemaGrammar()->wrapTable($name);
        $names = explode('.',$name);
        array_walk($names,function(&$val) use ($wrap){
            $val = $wrap.$val.$wrap;
        });
        $name = implode('.',$names);
        return $name;
    }
    public function getRawTable()
    {
        return parent::getTable();
    }

    public static function fullTableName()
    {
        $obj = new static();
        return $obj->getTable();
    }

    protected $useNatureKey = true;

    protected $natureKey;

    public function setUseNatureKey($useNatureKey)
    {
        $this->useNatureKey = $useNatureKey;
    }
    public function genNatureKey()
    {
        return ID::gen();
    }
    public function getNatureKey()
    {
        return $this->{$this->getNatureKeyName()};
    }

    public function getNatureKeyName()
    {
        if (!$this->useNatureKey){
            return $this->primaryKey;
        }
        if (isset($this->natureKey)){
            return $this->natureKey;
        }
        if (isset($this->useNatureKey)){
            if (isset($this->table)) {
                $this->natureKey = str_replace('\\', '', Str::snake($this->table)).'_id';
            }else{
                $this->natureKey = str_replace('\\', '', Str::snake(class_basename($this))).'_id';
            }
        }
        return $this->natureKey;
    }

    public function getKeyName()
    {
        if ($this->useNatureKey){
            return $this->getNatureKeyName();
        }else{
            return $this->primaryKey;
        }
    }

    //Override
    public function getCreatedAtAttribute($date)
    {
        return strtotime($date);
    }
    //Override
    public function getUpdatedAtAttribute($date)
    {
        return strtotime($date);
    }


    public function save(array $options = [])
    {
        $query = $this->newQueryWithoutScopes();

        if ($this->fireModelEvent('saving') === false) {
            return false;
        }

        if ($this->exists) {
            $saved = $this->performUpdate($query, $options);
        }
        else {
//            $saved = $this->performInsert($query, $options);
            $natureKeyName = $this->getNatureKeyName();
            if ($this->useNatureKey && !isset($this->{$natureKeyName})){
                $this->{$natureKeyName} = $this->genNatureKey();
            }
            if ($this->fireModelEvent('creating') === false)
            {
                $saved = false;
            }else{
                if ($this->timestamps && array_get($options, 'timestamps', true))
                {
                    $this->updateTimestamps();
                }
                $attributes = $this->attributes;
                if ($this->getIncrementing())
                {
                    $id = $query->insertGetId($attributes, $keyName = 'id');
                    $this->setAttribute($keyName, $id);
                }
                else
                {
                    $query->insert($attributes);
                }
                $this->exists = true;
                $this->fireModelEvent('created', false);
                $saved = true;
            }
        }
        if ($saved) {
            $this->finishSave($options);
        }
        return $saved;
    }

    public function update(array $attributes = [], array $options = [])
    {
        $attributes[self::UPDATED_AT] = date('Y-m-d H:i:s');
        $this->updateTimestamps();
        parent::update($attributes,$options);
    }

    public function insertGetNatureId($values,$return=self::RETURN_NATURE_ID)
    {
        return $this->insertExtend('insert',$values,$return);
    }
    //Override
    public function insertGetId($values,$return=self::RETURN_ID)
    {
        return $this->insertExtend('insert',$values,$return);
    }
    //Override
    public function insert($values,$return=self::RETURN_ID)
    {
        return $this->insertExtend('insert',$values,$return);
    }

    public function insertOnDuplicateKeyUpdate($insertValues,$updateValues,$return=self::RETURN_AFFECTED_ROWS)
    {
        return $this->insertExtend('insertOnDuplicateKeyUpdate',$insertValues,$updateValues,$return);
    }

    public function insertIgnore($values,$return=self::RETURN_AFFECTED_ROWS)
    {
        return $this->insertExtend('insertIgnore',$values,$return);
    }

    public function replace($values,$return=self::RETURN_ID)
    {
        return $this->insertExtend('replace',$values,$return);
    }

    protected  function insertExtend($type,$values,$return=self::RETURN_ID)
    {
        $time = date('Y-m-d H:i:s');
        $values[self::UPDATED_AT] = $time;
        $this->updateTimestamps();

        $natureKeyName = $this->getNatureKeyName();
        if ($this->useNatureKey && !isset($insertValues[$natureKeyName])){
            $natureKeyValue = $this->genNatureKey();
            $this->{$natureKeyName} = $values[$natureKeyName] = $natureKeyValue;
            $this->syncOriginalAttribute($natureKeyName);
        }

        $query = $this->newBaseQueryBuilder();
        $query->from($this->getTable());

        if (empty($values)) return true;

        if ( ! is_array(reset($values)))
        {
            $values = array($values);
        }
        else
        {
            foreach ($values as $key => $value)
            {
                ksort($value); $values[$key] = $value;
            }
        }
        $bindings = array();
        foreach ($values as $record)
        {
            foreach ($record as $value)
            {
                $bindings[] = $value;
            }
        }
        $sql = $query->getGrammar()->compileInsert($query, $values);
        switch($type)
        {
            case 'insert':
                $return = func_get_arg(2);
            default:
                break;
            case 'insertIgnore':
                $sql = 'insert ignore'.substr($sql,6);
                $return = func_get_arg(2);
                break;
            case 'replace':
                $sql = 'replace'.substr($sql,6);
                $return = func_get_arg(2);
                break;
            case 'insertOnDuplicateKeyUpdate':
                $columns = array();
                $updateValues = func_get_arg(2);
                $updateBindings = array_values(array_merge($updateValues, $query->getBindings()));
                $bindings = array_merge($bindings,$updateBindings);
                foreach ($updateValues as $key => $value)
                {
                    $columns[] = $query->getGrammar()->wrap($key).' = '.$query->getGrammar()->parameter($value);
                }
                $columns = implode(', ', $columns);
                $sql .= ' on duplicate key update '.$columns;
                $return = func_get_arg(3);
                break;
        }

        $bindings = array_values(array_filter($bindings, function($binding)
        {
            return ! $binding instanceof Expression;
        }));

        switch($return)
        {
            case self::RETURN_EXECUTE_RESULT:
                return $query->getConnection()->statement($sql, $bindings);
            case self::RETURN_ID:
                $query->getConnection()->statement($sql, $bindings);
                return $query->getProcessor()->processInsertGetId($query, $sql, $values,null);
            case self::RETURN_NATURE_ID:
                $query->getConnection()->statement($sql, $bindings);
                return $this->{$bizIdName};
            case self::RETURN_AFFECTED_ROWS:
            default:
                return $query->getConnection()->affectingStatement($sql, $bindings);
        }
    }


    public $parentKey = 'parent_id';

    public function hasMany($related, $foreignKey = null, $localKey = null)
    {
        $related = $this->namespaced($related);
        if (!$this->useNatureKey) return parent::hasMany($related, $foreignKey, $localKey);

        $natureKeyName = $this->getNatureKeyName();
        $foreignKey = isset($foreignKey) ? $foreignKey : $natureKeyName;
        $localKey = isset($localKey) ? $localKey : $natureKeyName;
        return parent::hasMany($related, $foreignKey, $localKey);
    }

    public function hasOne($related, $foreignKey = null, $localKey = null)
    {
        $related = $this->namespaced($related);
        if (!$this->useNatureKey) return parent::hasMany($related, $foreignKey, $localKey);

        $natureKeyName = $this->getNatureKeyName();
        $foreignKey = isset($foreignKey) ? $foreignKey : $natureKeyName;
        $localKey = isset($localKey) ? $localKey : $natureKeyName;
        return parent::hasOne($related, $foreignKey, $localKey);
    }

    public function hasManyThrough($related, $through, $firstKey = null, $secondKey = null, $localKey= null)
    {
        $related = $this->namespaced($related);
        $through = $this->namespaced($through);
        if (!$this->useNatureKey) return parent::hasManyThrough($related, $through, $firstKey, $secondKey, $localKey);
        $firstKey = isset($firstKey) ? $firstKey : $this->getNatureKeyName();
        $secondKey = isset($secondKey) ? $secondKey : (new $through)->getNatureKeyName();
        return parent::hasManyThrough($related, $through, $firstKey, $secondKey, $localKey);
    }

    public function belongsTo($related, $foreignKey = null, $otherKey = null, $relation = null)
    {
        $related = $this->namespaced($related);
        if (!$this->useNatureKey) return parent::belongsTo($related, $foreignKey, $otherKey, $relation);
        $natureKeyName = $related::getNatureKeyName();
        $foreignKey = isset($foreignKey) ? $foreignKey : $natureKeyName;
        $otherKey = isset($otherKey) ? $otherKey : $natureKeyName;
        return parent::belongsTo($related, $foreignKey, $otherKey, $relation);
    }

    public function belongsToMany($related, $table = null, $foreignKey = null, $otherKey = null, $relation = null)
    {
        $related = $this->namespaced($related);
        if (!$table) $table = $this->pivotname(get_class($this),$related);
        if (!$this->useNatureKey) return parent::belongsToMany($related, $table, $foreignKey, $otherKey, $relation);
        $foreignKey = isset($foreignKey) ? $foreignKey : $this->getNatureKeyName();
        $otherKey = isset($otherKey) ? $otherKey : (new $related)->getNatureKeyName();
        return parent::belongsToMany($related, $table, $foreignKey, $otherKey, $relation);
    }

    public function morphMany($related, $name, $type = null, $id = null, $localKey = null)
    {
        return parent::morphMany($related, $name, $type, $id, $localKey);
    }

    public function morphOne($related, $name, $type = null, $id = null, $localKey = null)
    {
        return parent::morphOne($related, $name, $type, $id, $localKey);
    }

    public function morphTo($name = null, $type = null, $id = null)
    {
        return parent::morphTo($name, $type, $id);
    }

    public function morphToMany($related, $name, $table = null, $foreignKey = null, $otherKey = null, $inverse = false)
    {
        return parent::morphToMany($related, $name, $table, $foreignKey, $otherKey, $inverse);
    }

    public function parent()
    {
        return $this->belongsTo(__CLASS__,$this->parentKey, $this->getNatureKeyName());
    }
    public function children()
    {
        return $this->hasMany(__CLASS__, $this->parentKey, $this->getNatureKeyName());
    }
    private function pivotname($class1,$class2)
    {
        $class1 = $this->unnamespaced($class1);
        $class2 = $this->unnamespaced($class2);
        if ($class1<$class2){
            $pivot = $class1.'_'.$class2;
        }else{
            $pivot = $class2.'_'.$class1;
        }
        $pivot = strtolower($pivot);
        return $pivot;

    }
    private function namespaced($class=__CLASS__)
    {
        if (is_object($class)) $class = get_class($class);
        if (!str_contains($class,'\\'))
        {
            $namespace = str_replace('/','\\',dirname(str_replace('\\Base','/',__CLASS__)));
            $class = $namespace.'\\'.$class;
        }
        return $class;
    }
    private function unnamespaced($class=__CLASS__)
    {
        if (is_object($class)) $class = get_class($class);
        $namespace = str_replace('/','\\',dirname(str_replace('\\Base','/',__CLASS__)));
        return trim(str_replace($namespace,'',$class),'\\');
    }

}
