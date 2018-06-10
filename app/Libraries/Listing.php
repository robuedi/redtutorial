<?php

namespace App\Libraries\REC;


use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\LengthAwarePaginator;
use DB, Redirect, Log;


class Listing {

    private $query_data;
    public $results_per_page = 10;

    public function __construct($query_data = array())
    {
        $this->query_data = $query_data;
    }

    public static function cleanQueryString(){

        $query_string_array = Input::all();

        $clean_query_string_array = array();

        $needs_redirect = false;

        foreach($query_string_array as $key => $value)
        {
            if(strlen($value) == 0)
                $needs_redirect = true;
            else
                $clean_query_string_array[] = $key.'='.$value;
        }

        $normalized_query_string = Input::normalizeQueryString(implode('&', $clean_query_string_array));

        if($needs_redirect)
            return Input::url().'?'.$normalized_query_string;
        else
            return false;

    }

    public function sortLink($sortf = "")
    {
        $query_string_array = Input::all();

        // default sort params
        $default_sortf = "";
        $default_sortd = "";
        foreach($this->query_data['sortables'] as $sortfield => $sortdir)
        {
            if(in_array($sortdir, array('asc', 'desc')))
            {
                $default_sortf = $sortfield;
                $default_sortd = $sortdir;
                break;
            }
        }

        $current_sortf = Input::get('sortf', $default_sortf);
        $current_sortd = Input::get('sortd', $default_sortd);

        if($current_sortf == $sortf )
        {
            $sortd = $current_sortd == 'asc' ? 'desc' : 'asc';
        }
        else
        {
            $sortd = "desc";
        }

        $query_string_array['sortf'] = $sortf;
        $query_string_array['sortd'] = $sortd;

        $parts = array();

        foreach($query_string_array as $key => $value)
        {
            $parts[] = $key.'='.$value;
        }

        $normalized_query_string = Input::normalizeQueryString(implode('&', $parts));

        return Input::url().'?'.$normalized_query_string;
    }

    public function sortDir($sortf = "")
    {
        // cimpul de sortare curent
        $current_sortf = Input::get('sortf');

        // directia de sortare curenta
        $current_sortd = Input::get('sortd');

        $sort_dir = "";

        if((empty($current_sortf) || empty($current_sortd)) && !empty($this->query_data['sortables'][$sortf]))
        {
            // $sortf este cimpul de sortare default
            $sort_dir = $this->query_data['sortables'][$sortf];
        }
        elseif($current_sortf == $sortf)
        {
            // $sortf este chiar cimpul activ
            $sort_dir = $current_sortd;
        }

        // inverseaza $sort_dir pentru afisare
        if($sort_dir == 'asc')
            return "sort-desc active";
        elseif($sort_dir == 'desc')
            return "sort-asc active";
        else
            return "";
    }

    public function results(){

        /*
            $data = array(

                'fields' => "*",

                'body'  => "FROM blogposts WHERE (1) {filters}",

                'filters' => array(

                    'title' => "AND title LIKE '%{title}%'"

                ),

                'sortables' => array(

                    'title' => 'asc'

                )
            );
        */

        $data = $this->query_data;

        // obtine pagina curenta, results per page, offset
        $current_page = Input::get('page', 1);
        $rpp = Input::get('rpp', $this->results_per_page);
        $rpp = $rpp == 0 ? $this->results_per_page : $rpp;
        $offset = $current_page == 1 ? 0 : $rpp * $current_page - $rpp;

        // pregateste filtrele pentru injectare in sql query
        $filters = array();

        foreach($data['filters'] as $k => $v)
        {
            if(Input::has($k))
            {
                $filters[] = str_replace('{'.$k.'}', addslashes(Input::get($k)), $v);
            }
        }

        $filters_string = implode(' ', $filters);

        // cimpul dupa care se face sortarea

        if(Input::has('sortf'))
        {
            $sortf = Input::get('sortf');
        }
        else
        {
            $sortf = "";

            foreach($data['sortables'] as $sortfield => $sortdir)
            {
                if(in_array($sortdir, array('asc', 'desc')))
                {
                    $sortf = $sortfield;
                    break;
                }
            }
        }

        $sortd = Input::get('sortd', $this->query_data['sortables'][$sortf]);

        // body-ul query-ului
        $query_body = str_replace('{filters}', $filters_string, $data['body']);

        // obtine intregistrarile
        $sql = "SELECT SQL_CALC_FOUND_ROWS ".$data['fields'].' '.$query_body." ORDER BY $sortf $sortd LIMIT $offset, $rpp";
        //Log::info('sql', array($sql));
        //Log::info($sql);
        $results_array = DB::select($sql);

        // obtine totalul inregistrarilor
        $sql_count = "SELECT FOUND_ROWS() as total";
        $count_result = DB::select($sql_count);

        $total = isset($count_result[0]) ? $count_result[0]->total : 0;
        //Log::info($results_array);
        // paginare
        $paginator = new LengthAwarePaginator($results_array, $total, $rpp);


        // returneaza
        return $paginator;

    }

    function getQueryData()
    {
        return $this->query_data;
    }

}