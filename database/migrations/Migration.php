<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration as IlluminateMigration;
use Powerlaw\Eunomia\Facades\Eunomia as ID;;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Grammars\MySqlGrammar;
use Illuminate\Database\Schema\Grammars\SQLiteGrammar;
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Schema;

class Migration extends IlluminateMigration {

    public static $EVENT_CREATE_SCHEMA = 'schema.create';
    public static $DIRECTORY_DATE_FORMAT = 'Ymd';
    public static $FILE_DATE_FORMAT = 'YmdHis';
    public static $PATH = 'sqls';

    public $blueprint;
    public $directory;
    public $file;
    public $sqliteFile;
    public $table;
    public $database;
    public $filesystem;
    public static $time;
    public static $createFile=false;
    public $closure;

    function __construct()
    {
        $this->filesystem = new Filesystem();
        $path = static::$PATH;
        if (!isset(self::$time)){
            self::$time=time();
		    DB::table('migrations')->truncate();
            $this->directory = base_path("database/{$path}/".date(static::$DIRECTORY_DATE_FORMAT,self::$time));
            $this->filesystem->makeDirectory($this->directory,0777,true,true);
        }
        Event::forget(static::$EVENT_CREATE_SCHEMA);
        Event::listen(static::$EVENT_CREATE_SCHEMA, array($this,'writeSqlFile'));
        $this->directory = base_path("database/{$path}/".date('Ymd',self::$time));
        $date = date(static::$FILE_DATE_FORMAT,self::$time);
        $this->file = $this->directory."/{$date}_schema.sql";
        $this->sqliteFile = $this->directory."/{$date}_SqliteCreateSchema.sql";
        Schema::dropIfExists($this->getTable());
    }

    public function getDatabase()
    {
        if (!isset($this->database)){
            $connection = Config::get('database.default');
            $this->database = Config::get("database.connections.$connection.database",'');
        }
        return $this->database;
    }
    public function getTable($withDB = true)
    {
        if (!isset($this->database)){
            $connection = Config::get('database.default');
            $this->database = Config::get("database.connections.$connection.database");
        }
        if (isset($this->database) && isset($this->table) && $withDB){
            return $this->database.'.'.$this->table;
        }elseif(isset($this->table)){
            return $this->table;
        }
        $table = get_class($this);
        $table = preg_replace('/^Create/','',$table);
        $table = preg_replace('/Table$/','',$table);
        $table = preg_replace('/Pivot$/','',$table);
        $table = snake_case($table);
        $this->table = $table;
        if ($withDB){
            return $this->database.'.'.$this->table;
        }else{
            return $this->table;
        }
    }

    public function down()
	{
		Schema::dropIfExists($this->getTable());
	}

    public function writeSqlFile($blueprint)
    {
        $grammarPackageName = 'Illuminate\Database\Schema\Grammars';
        $grammar = $grammarPackageName.'\\'.ucfirst(Schema::getConnection()->getDriverName()).'Grammar';
        $this->gramma = new $grammar;
        $sqls =$blueprint->toSql(Schema::getConnection(),$this->gramma);
        $sqls = str_replace('create table','create table if not exists',$sqls);
        $bluePrinter = new BluePrinter($sqls);
        $text = $bluePrinter
            ->addClause(BluePrinter::DROP_TABLE_IF_EXISTS,$this->getTable())
            ->toText();
        $table = $this->wrap($this->getTable());
        $text = "# create table {$table}\n".$text;
        if ($this->filesystem->exists($this->file) && self::$time)
        {
            $content = $this->filesystem->get($this->file);
            $text = $content."\n".$text;
        }
        $this->filesystem->put($this->file,$text);

        $sqls =$blueprint->toSql(Schema::getConnection(),new SQLiteGrammar());
        $sqls = str_replace('create table','create table if not exists',$sqls);
        $sqls = str_replace('"'.$this->getDatabase().'".','',$sqls);
        $bluePrinter = new BluePrinter($sqls,['grammar'=>new SQLiteGrammar()]);
        $text = $bluePrinter
            ->addClause(BluePrinter::DROP_TABLE_IF_EXISTS,$this->getTable(false))
//            ->addClause(BluePrinter::CREATE_DATABASE_IF_NOT_EXISTS,$this->getDatabase())
            ->toText();
        if ($this->filesystem->exists($this->sqliteFile) && self::$time)
        {
            $content = $this->filesystem->get($this->sqliteFile);
            $text = $content."\n".$text;
        }
        $this->filesystem->put($this->sqliteFile,$text);
    }

    protected function wrap($name)
    {
        $wrap = '`';
        $name = str_replace($wrap,'',$name);
        $names = explode('.',$name);
        array_walk($names,function(&$val) use ($wrap){
            $val = $wrap.$val.$wrap;
        });
        $name = implode('.',$names);
        return $name;
    }
}