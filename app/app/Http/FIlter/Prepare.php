<?php
namespace App\Http\Filter;

use Illuminate\Http\Request;

trait Prepare {
    public function prepare(Request $request)
    {
        $trace = debug_backtrace();
        $functionName = $trace[1]['function'];
        $functionName = 'prepare'.ucfirst($functionName);

        return $this->{$functionName}($request);
    }
}