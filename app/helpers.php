<?php
/**
 * Created by PhpStorm.
 * User: hellowar
 * Date: 2/20/20
 * Time: 11:19 PM
 */

function paginate($url, $page, $total_records, $per_page = 10)
{
    $html = "";

    if( ceil($total_records / $per_page) > 0){
        $html .= "<ul class=\"pagination\">";

        if( $page > 1 ) {
            $calc = $page-1;
            $html .= "<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}?page={$calc}\">Voltar</a></li>";
        }

        if ( $page > 3 ) {
            $calc = 1;
            $html .= "<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}?page={$calc}\">{$calc}</a></li>";
            $html .= "<li class=\"page-item\"><div class=\"page-link\">...</div></li>";
        }

        if( $page-2 > 0 ) {
            $calc = $page-2;
            $html .= "<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}?page={$calc}\">{$calc}</a></li>";
        }

        if( $page-1 > 0 ) {
            $calc = $page-1;
            $html .= "<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}?page={$calc}\">{$calc}</a></li>";
        }

        $html .= "<li class=\"page-item active\"><a class=\"page-link\" href=\"{$url}?page={$page}\">{$page}</a></li>";

        if( $page+1 < ceil($total_records / $per_page)+1 ) {
            $calc = $page+1;
            $html .= "<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}?page={$calc}\">{$calc}</a></li>";
        }

        if( $page+2 < ceil($total_records / $per_page)+1 ) {
            $calc = $page+2;
            $html .= "<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}?page={$calc}\">{$calc}</a></li>";
        }

        if( $page < ceil($total_records / $per_page)-2 ) {
            $calc = ceil($total_records / $per_page);
            $html .= "<li class=\"page-item\"><div class=\"page-link\">...</div></li>";
            $html .= "<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}?page={$calc}\">{$calc}</a></li>";
        }

        if( $page < ceil($total_records / $per_page)) {
            $calc = $page+1;
            $html .= "<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}?page={$calc}\">Próximo</a></li>";
        }
    }

    return $html;

}