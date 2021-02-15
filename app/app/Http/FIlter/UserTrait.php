<?php
namespace App\Http\Filter;

use Illuminate\Http\Request;

trait UserTrait
{
    use Prepare;

    public function prepareStore(Request $request)
    {
        return array_filter([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ]);
    }

    public function prepareUpdate(Request $request)
    {
        return array_filter([
            'id' => $request->get('id'),
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ]);
    }
}
