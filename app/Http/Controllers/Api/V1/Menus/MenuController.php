<?php

namespace App\Http\Controllers\Api\V1\Menus;

use Illuminate\Http\Request;
use App\Http\Controllers\Menus\GetSidebarMenu;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json("en index");
        try {
            $user = auth()->user();
            if($user && !empty($user)){
                $roles =  $user->menuroles;
            }else{
                $roles = '';
            }
        } catch (Exception $e) {
            $roles = '';
        }
        if($request->has('menu')){
            $menuName = $request->input('menu');
        }else{
            $menuName = 'sidebar menu';
        }
        $menus = new GetSidebarMenu();
        return response()->json( $menus->get( $roles, $menuName ) );
    }

}
