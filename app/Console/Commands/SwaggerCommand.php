<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use File;
use Storage;
use Config;
use Header;

class SwaggerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'swagger:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Regenerate docs';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Regenerating docs');
        $appDir = config('l5-swagger.paths.annotations');
        $docDir = config('l5-swagger.paths.docs');

        $excludeDirs = config('l5-swagger.paths.excludes');
        $swagger = \Swagger\scan($appDir, ['exclude'=>$excludeDirs]);

        if (!File::exists($docDir) || is_writable($docDir)) {
            if (File::exists($docDir)) {
                File::deleteDirectory($docDir);
            }
            File::makeDirectory($docDir);

            $filename = $docDir.'/api-docs.json';
            $swagger->saveAs($filename);
        }

        //        json_encode($swagger, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        $json = json_encode($swagger, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        $output = json_decode($json,true);
        $this->writeFlattenedApiFile($output);
        $this->writeSwiftFile($output);

    }

    protected function buildSwift($output)
    {

        $keys = array_keys($output['apis']);
        $maxLength = array_reduce($keys,function($v,$item){
            return strlen($v) > strlen($item) ? strlen($v) : strlen($item);
        });
        $lets = array_reduce($keys,function($value,$item) use ($maxLength){
            return $value.'let '.'kApi'.ucfirst(camel_case(str_replace('.','_',$item))).' = '.'"'.$item.'"'."\n";
        });
        return $lets;
    }

    public function generateMacro($apis){

    }
    public function writeSwiftFile($output){
        $content = $this->buildSwift($this->flattenApi($output));
        file_put_contents(config('api.swift_file'), $content);
    }


    public function flattenApi($output,$apiEnv='development'){
        $obj = $this->getServerInfo($apiEnv);
        $rootUrl = $this->getRootUrl($obj,$apiEnv);
//        $obj['host'] = $obj[$obj['host']];
        $obj['basePath'] = $output['basePath'];
//        $obj['rootPath'] = $rootUrl;
        $obj['headers'][Header::ACCEPT] = implode(',',$output['produces']);
        $obj['headers']['Host'] = $obj[$obj['host']];
        $obj['headers'][Header::API_VERSION] = $output['info']['version'];

        $apis = [];
        foreach($output['paths'] as $pathKey => $path)
        {
            foreach($path as $method => $api){
                $key = strtolower(config('app.name')).'.'.trim($api['operationId']);
                $path = $this->tranPathStyle($pathKey);
                $parameters = empty($api['parameters']) ? [] : array_map(function($val){
                    return array_only($val,['name','in','type','default','format','required','items','collectionFormat']);
                },$api['parameters']);
//                $url = $obj['rootPath'].$path;
//                $api = array_merge($obj,
//                    compact('method','path','parameters','url')
//                );
                $api = compact('method','path','parameters');
                $apis[$key] = $api;
            }
        }
        $obj['apis'] = $apis;
        return $obj;
    }
    public function tranPathStyle($path)
    {
        return $path;
        if(preg_match_all('/\{[^\/]*\}/',$path,$matches)){
            foreach($matches[0] as $match){
                //               $replace = ':'.str_singular(trim($match,' {}'));
                $replace = ':'.trim($match,' {}');
                $path = str_replace($match,$replace,$path);
            }
        }
        return $path;
    }

    public function getServerInfo($env)
    {
        $serverInfo = array_merge(config('api.environments.default',[]),config("api.environments.{$env}",[]));
        return $serverInfo;
    }



    public function getRootUrl($server,$env='production'){
        $rootUrl = array_get($server,'schema','http').'://'
            .(array_get($server,'host','domain')=='domain'  ? array_get($server,'domain','') : array_get($server,'ip',''))
            .($server['port'] == 80 ? '' : ':'.$server['port']);
        return $rootUrl;
    }

    public function writeFlattenedApiFile($output){
        $environments = config('api.environments');
        array_forget($environments,'default');
        foreach($environments as $key=>$environment)
        {
            $apis = $this->flattenApi($output,$key);
            if ($key=='production' || $key=='staging') {
                $content = json_encode($apis,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
            }else{
                $content = json_encode($apis,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);
            }
//            var_dump(config('api.ios_api_file_path')."/api-{$key}.json");die;
            $apiFilePath = config('api.json_file_path');
            if (!File::exists($apiFilePath)){
                File::makeDirectory($apiFilePath);
            }
            file_put_contents($apiFilePath."/api-{$key}.json", $content);
        }
    }
}
