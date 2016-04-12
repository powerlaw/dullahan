<?php
/**
 * Created by PhpStorm.
 * User: xieyi
 * Date: 15/5/7
 * Time: 下午1:02
 */

namespace Powerlaw\Soraka;


class Sql {
    public function raw($sql,$bindings,$addslashes=true,$minify=false)
    {

        foreach ($bindings as $i => $binding) {
            if ($binding instanceof \DateTime) {
                $bindings[$i] = $binding->format('\'Y-m-d H:i:s\'');
            } else if (is_string($binding)) {
                if ($minify){
                    $binding = \Minify_HTML::minify($binding,[
                        'cssMinifier'=>['Minify_CSS','minify'],
                        'jsMinifier'=>['JSMin','minify'],
                    ]);
                }
                if ($addslashes) $binding = addslashes($binding);
                $bindings[$i] = "'$binding'";
            }
        }
        $sql = str_replace(array('%', '?'), array('%%', '%s'), $sql);
        $sql = vsprintf($sql, $bindings);
        return $sql;
    }

} 