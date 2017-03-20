<?php
App::uses('AppFormat', 'Model/Format');

//Xxxx = model name
class XxxxFormat extends AppFormat {


    function row_YYY($row){
            return $row;
    }

    function col_YYY($col){
            return $col;
    }

    function full_YYY($full){
            return $full;
    }



}