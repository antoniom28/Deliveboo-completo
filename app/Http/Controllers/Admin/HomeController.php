<?php

namespace App\Http\Controllers\Admin;
use App\Type;
use App\Http\Controllers\Controller;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $types = Type::all();
        $LoggedUser = User::where('id',Auth::user()->id)->first();
        $typeChoice = $LoggedUser->types;
        $temp = [];
        $control = false;
        foreach($types as $remove){
            $control = false;
            foreach($typeChoice as $type)
                if($type->id == $remove->id){
                    $control = true;
                    break;
                }
            if(!$control)
                $temp[] = $remove;
        }
        $types = $temp;
        return view('admin.types',compact("types","typeChoice"));
    }

    public function form_checkbox(Request $request){
        $checked = $request->all();
        if(isset($checked['check'])){
            $LoggedUser = User::where('id',Auth::user()->id)->first();
            $typeChoice = $LoggedUser->types;
            $checked = $checked['check'];
            $typeChoice = $LoggedUser->types->toArray();
                
            foreach($typeChoice as $type)
                array_push($checked,$type['id']);

            $LoggedUser->types()->sync($checked);
            
            return redirect()->route('admin.recap');
            
        } else
            return redirect()->route('admin.');
    }

    public function recap(){
        $LoggedUser = User::where('id',Auth::user()->id)->first();
        return view('admin.recap',compact("LoggedUser"));
    }

    public function delete_type($id,$where)
    {
        $LoggedUser = User::where('id',Auth::user()->id)->first();
        $types = $LoggedUser->types;
        $temp = [];
        foreach($types as $type){
            if($type->id != $id)
                $temp[] = $type->id;
        }
        //dump($id,$where);
        $LoggedUser->types()->sync($temp);
        if($where == "recap")
            return redirect()->route('admin.recap');
        else
            return redirect()->route('admin.');
    }

    public function order(){
        $LoggedUser = User::where('id',Auth::user()->id)->first();
        $orders = Order::orderBy('created_at', 'DESC')->where('user_id',$LoggedUser->id)->get();
        
        foreach($orders as $order)
            $order->plates;
            
        return view('admin.order',compact("orders"));
    }

    public function statistics(){
        return view('admin.plates.statistics');
    }

}
