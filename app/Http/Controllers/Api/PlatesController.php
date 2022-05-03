<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\SendNewMail;
use App\Order;
use App\Plate;
use App\Type;
use App\User;
use Braintree\Gateway;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PlatesController extends Controller
{
    //
    
    public function index(){
        $plates = Plate::all();
        return response()->json($plates);
    }

    public function users(){
        $users = User::all();
        $newUsers = User::orderBy('created_at' ,'DESC')->take(3)->get();
        $ratedUsers = User::orderBy('activity' ,'ASC')->take(3)->get();

        foreach($users as $user){
            $user->types;
            $user->plates;
        }

        foreach($newUsers as $user){
            $user->types;
            $user->plates;
        }

        foreach($ratedUsers as $user){
            $user->types;
            $user->plates;
        }
        return response()->json([
            "users" => $users,
            "newUsers" => $newUsers,
            "ratedUsers" => $ratedUsers,
        ]);
    }

    public function user($id = null){
        $user = User::all()->where('id',$id)->first();
        $user->types;
        $user->plates;
        return response()->json($user);
    }

    public function users_type($type_id = null){
        $type = Type::all()->where('id',$type_id)->first();
        $type->users;
        return response()->json($type);
    }

    public function searchTypes($input = null){
        if($input != null){
            $new_str = preg_replace("/\s+/", "*", $input);
            $input = $new_str;
            $types = Type::whereRaw("REPLACE(name, ' ' ,'') LIKE ?", $input.'%')->get();
            foreach($types as $type){
                $type['users'] = $type->users;
            }
        }
        return response()->json($types);
    }

    public function searchUsers($input = null){
        if($input != null){
            $new_str = preg_replace("/\s+/", "*", $input);
            $input = $new_str;
            $users = User::whereRaw("REPLACE(activity, ' ' ,'') LIKE ?", '%'.$input.'%')->get();
            foreach($users as $user){
                $user->plates;
                $user->types;
            }
        }
        return response()->json($users);
    }

    public function getAllTypes(){
        $types = Type::all();
        return response()->json($types);
    }

    public function getUser($activity = null){
        $user = User::all()->where('activity',$activity)->first();
        if(!isset($user))
            return response()->json(false);

        $user->plates;
        $user->types;
        return response()->json($user);
    }

    public function getUserFromType($typeArr = null){
        $typeArr = explode(',',$typeArr);

        foreach($typeArr as $type)
            $convert[] = (int)$type;
        
        foreach($convert as $type_id)
            $users[] = Type::all()->where('id',$type_id)->first()->users;

       foreach($users as $index=>$user)
            if(count($user) <= 0)
                unset($users[$index]);

        if(count($users) <= 0)
            return response()->json([]);

        foreach($users as $index=>$user)
            foreach($user as $controlId)
                $control[] = $controlId->id;

       $control = array_unique($control);

        $finalArray = [];

        foreach($control as $toPush){
            $pushed = false;
            foreach($users as $user){
                foreach($user as $test){
                    if($toPush == $test->id){
                        $test->plates;
                        $test->types;
                        $finalArray[] = $test;
                        $pushed = true;
                    }
                }
                if($pushed)
                break;
            }
        }
        
        return response()->json($finalArray);
    }

    public function userExist($id = null , $order = null){
        $user = User::all()->where('id',$id)->first();
        if(isset($user))
            if($user){
                $plates = $user->plates;
                foreach($plates as $plate)
                    if($order == $plate->name)
                        return response()->json(true);
                    else
                        continue;
            } else    
                return response()->json(false);
            else    
                return response()->json(false);
        
        return response()->json(false);
    }

    public function payment(Request $request){
        $data = $request->all();

        $validator = Validator::make($data , [
            'name' => 'required|string|max:30',
            'surname' => 'required|string|max:30',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|numeric|digits_between:8,11',
            'address' => 'required|string',
            'status' => 'required',
            'total' => 'required',
        ]);

        $control = $validator->fails();
        if($control){
            return response()->json([
                "mess" => 'ERRORE MADORNALE',
                "old" => $validator->errors(),
                "status" => false,
            ]);
        }

        $order = new Order();
        $order->name = $data['name'];
        $order->surname = $data['surname'];
        $order->email = $data['email'];
        $order->phone = $data['phone'];
        $order->address = $data['address'];
        $order->status = $data['status'];
        $order->total = $data['total'];
        $order->user_id = $data['user_id'];
        $order->save();

        $plates_id = [];
        $plates_quantity = [];
        foreach($data['plates'] as $plate){
            $plates_id[] = $plate['plate']['id'];
            $plates_quantity[] = $plate['quantity'];
        }

        $sync_data = [];
        for($i = 0; $i < count($plates_id); $i++)
            $sync_data[$plates_id[$i]] = ['quantity' => $plates_quantity[$i]];

        $order->plates()->sync($sync_data);

        if(isset($data['email']) && isset($data['user_email'])){
            $order->plates;
            Mail::to($data['email'])->send(new SendNewMail($order));
            Mail::to($data['user_email'])->send(new SendNewMail($order));
    }

        return response()->json([
            "mess" => 'creato',
            "status" => true,
        ]);
    }

    public function generate(Request $request, Gateway $gateway)
    {
        
        $token = $gateway->clientToken()->generate();

        $data = [
            'success' => true,
            'token' => $token
        ];

        return response()->json($data);
    }

    public function makePayment(Request $request, Gateway $gateway)
    {
        $data = $request->all();
        
       $result = $gateway->transaction()->sale([
            'amount' => $data['total'],
            'paymentMethodNonce' => $data['tokenClient'],
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if(isset($result->success))
            if($result->success)
                return response()->json([
                    "data" => $result, 
                    "success" => true,
                ]);

        return response()->json([
            "data" => $result, 
            "success" => false,
        ]);
    }

    public function statisticsData(){
        $LoggedUser = User::where('id',Auth::user()->id)->first();
        $orders = Order::orderBy('created_at', 'DESC')->where('user_id',$LoggedUser->id)->get();
        $plates = $LoggedUser->plates;

        if(!isset($orders) || count($orders) <= 0){
            return response()->json([
                "data" => [], 
                "plates" => $plates, 
            ]);
        }

        foreach($orders as $order)
           $temp[] = $order->plates;
        
        foreach($temp as $item){
            foreach($item as $plate){
                $orderPlates[] = ['id' => $plate->id , 'quantity' => $plate->pivot->quantity];
            }
        }

        foreach($plates as $plate)
            $data[] = 0;

        foreach($plates as $i => $plate){
            foreach($orderPlates as $j => $orderPlate){
                if($plate->id == $orderPlate['id']){
                    $data[$i] += $orderPlate['quantity'];
                }
            }
        }

        return response()->json([
            "data" => $data, 
            "plates" => $plates, 
        ]);
    }

    public function lastMonth(){
        $LoggedUser = User::where('id',Auth::user()->id)->first();

        $number = cal_days_in_month(CAL_GREGORIAN, date("d"), date("Y")); // 31
        //date("Y.m.d")

        for($i = 0; $i < $number ; $i++){
            if($i < 10)
                $day = '0'.($i + 1);
            else
                $day = $i + 1;
            $orders = Order::where('user_id',$LoggedUser->id)->where('created_at', 'like', '%'  . '-' . date("m") . '-' . $day . '%')->get();
            $howMuchOrder[] = count($orders);
            $howMuchMoney[] = 0;
            foreach($orders as $order)
                $howMuchMoney[$i] += $order->total;
        }

        return response()->json([
            "howMuchOrder" => $howMuchOrder, 
            "howMuchMoney" => $howMuchMoney, 
        ]);
    }
}
