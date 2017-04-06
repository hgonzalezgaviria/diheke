<?php

use Illuminate\Support\Arr;


if (! function_exists('model_to_array')) {
    /**
     * Crea un array con la llave primaria y una columna a partir de un Model.
     * Se utiliza para contruir <select> en los views.
     *
     * @param  string|object  $class
     * @param  string  $column
     * @param  string  $primaryKey
     * @return array
     */
    function model_to_array($class, $column, $primaryKey = null)
    {

        if(is_object($class)){
            $models = $class;
            $primaryKey = isset($primaryKey) ? $primaryKey : $models->first()->getKeyName();
        } else {

            $class = class_exists($class) ? $class : '\\Eva360\\'.basename(str_replace('\\', '/', $class));
            $primaryKey = isset($primaryKey) ? $primaryKey : (new $class)->getKeyName();
            $models = $class::orderBy($primaryKey)
                            ->get([ $primaryKey , $column ]);
        }

        $array = [];
        foreach ($models as $model) {
            $array = Arr::add(
                $array,
                $model->$primaryKey,
                $model->$column
            );
        }

        return $array;
    }
}



if (! function_exists('array_implode')) {
    /**
     * Implode an array with the key and value pair giving
     * a glue, a separator between pairs and the array
     * to implode.
     * @param string $glue The glue between key and value
     * @param string $separator Separator between pairs
     * @param array $array The array to implode
     * @return string The imploded array
     */
    function array_implode( $glue, $separator, $array ) {
        if ( ! is_array( $array ) ) return $array;
        $string = array();
        foreach ( $array as $key => $val ) {
            if ( is_array( $val ) )
                $val = implode( ',', $val );
            $string[] = "{$key}{$glue}{$val}";

        }
        return implode( $separator, $string );

    }

}


if (! function_exists('img_to_base64')) {
    /**
     * Covertir imagen en base64.
     * @param string $pathImg Ruta del archivo.
     * @return string $dataUri
     */
    function img_to_base64( $pathImg ) {
        //
        $type = pathinfo($pathImg, PATHINFO_EXTENSION);
        $data = file_get_contents($pathImg);
        $dataUri = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $dataUri;
    }
}

if (! function_exists('delete_tree')) {
    /**
     * Covertir imagen en base64.
     * @param string $pathImg Ruta del archivo.
     * @return string $dataUri
     */
    function delete_tree( $dir ) {
        $files = array_diff(scandir($dir), array('.','..')); 
        foreach($files as $file) { 
            (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file"); 
        } 
        return rmdir($dir); 
    }
}