<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Session;


class GuzzleController extends Controller
{
    public function getApiData(Request $request)
    {
        $client = new Client(['header' => [
            'content-type' => 'application/json'],
        ]);
        $email = $request->get('email');
        $password = $request->get('password');
        try {
            $response = $client->request('POST', 'https://api.shipments.test-y-sbm.com/login', [

                'json' => [
                    'email' => $email,
                    'password' => $password
                ]
            ]);
        }catch(\Exception $e){
            Session::flash('Error-login', 'Не правильно введен Email или пароль, попробуйте еще раз.');
            Session::flash('alert-class', 'alert-danger');
            return redirect()->back();
        }
        $data = $response->getBody();

        $data = json_decode($data);

        $token ="Bearer ".$data->data[0]->token;
        $token = session(['token'=>$token]);



        return redirect()->to('/shipment');
    }

    public function createShipment(Request $request)
    {

        $token = $request->session()->get('token');
        if(empty($token)) {
            return redirect()->to('/');
        }else {
            $client = new Client(['header' => [
                'content-type' => 'application/json', 'Authorization' => $token],
            ]);

            $id = $request->get('id');
            $name = $request->get('name');
            try {
                $response = $client->request('POST', 'https://api.shipments.test-y-sbm.com/shipment', [
                    'headers' => [
                        'Authorization' => $token,
                        'content-type' => 'application/json',
                    ],
                    'json' => [
                        'id' => $id,
                        'name' => $name

                    ]
                ]);
            } catch (\Exception $e) {
                Session::flash('Error-shipment', 'Shipment с таким ID уже существует. Пожалуйста введите другой ID.');
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
            }
            Session::flash('success', 'Shipment удачно создан.');
            Session::flash('alert-class', 'alert-success');
            return redirect()->to('/shipment');
        }
    }

    public function createShipmentView(Request $request){
        $token = $request->session()->get('token');
        if(empty($token)) {
            return redirect()->to('/');
        }else {
            return view('shipments.createshipment');
        }
    }

    public function getShipment(Request $request){
        $token = $request->session()->get('token');

        if(empty($token)) {
            return redirect()->to('/');
        }else {
            $client = new Client(['header' => [
                'content-type' => 'application/json', 'Authorization' => $token],
            ]);
            $response = $client->request('GET', 'https://api.shipments.test-y-sbm.com/shipment', [
                'headers' => [
                    'Authorization' => $token,
                    'content-type' => 'application/json',
                ],

            ]);
            $data = $response->getBody();
            $data = json_decode($data);
            $shipments = $data->data->shipments;

            return view('shipments.shipmentlist')->with('shipments', $shipments);
        }
    }

    public static function deleteShipment(Request $request){

        $id = $request->get('id');
        $token = $request->session()->get('token');
        if(empty($token)) {
            return redirect()->to('/');
        }else {
            $client = new Client(['header' => [
                'content-type' => 'application/json', 'Authorization' => $token],
            ]);
            $response = $client->request('DELETE', 'https://api.shipments.test-y-sbm.com/shipment/' . $id . '', [
                'headers' => [
                    'Authorization' => $token,
                    'content-type' => 'application/json',
                ]
            ]);
            Session::flash('success-delete', 'Shipment удачно удален.');
            Session::flash('alert-class', 'alert-info');
            return redirect()->back();
        }
    }

    public function updateShipmentView($id){

        return view('shipments.updateshipment')->with('id', $id);
    }

    public function updateShipment(Request $request){
        $id = $request->get('id');
        $name = $request->get('name');

        $token = $request->session()->get('token');
        if(empty($token)) {
            return redirect()->to('/');
        }else {
            $client = new Client(['header' => [
                'content-type' => 'application/json', 'Authorization' => $token],
            ]);
            $response = $client->request('PUT', 'https://api.shipments.test-y-sbm.com/shipment/'.$id , [
                'headers' => [
                    'Authorization' => $token,
                    'content-type' => 'application/json',
                ],
                'json' => [
                    'id' => $id,
                    'name' => $name,
                ]
            ]);

            Session::flash('success-update', 'Shipment удачно изменен.');
            Session::flash('alert-class', 'alert-success');
            return redirect()->to('/shipment');
        }
    }

    public function createItemView(Request $request)
    {
        $token = $request->session()->get('token');
        if (empty($token)) {
            return redirect()->to('/');
        } else {
            $client = new Client(['header' => [
                'content-type' => 'application/json', 'Authorization' => $token],
            ]);
            $response = $client->request('GET', 'https://api.shipments.test-y-sbm.com/shipment', [
                'headers' => [
                    'Authorization' => $token,
                    'content-type' => 'application/json',
                ],

            ]);
            $data = $response->getBody();
            $data = json_decode($data);
            $shipments = $data->data->shipments;
            return view('items.createitem')->with('shipments', $shipments);
        }
    }

    public function createItem(Request $request)
    {

        $token = $request->session()->get('token');

        if(empty($token)) {
            return redirect()->to('/');
        }else {
            $client = new Client(['header' => [
                'content-type' => 'application/json', 'Authorization' => $token],
            ]);
            Session::flash('Error-item', 'Item с таким ID уже существует. Пожалуйста введите другой ID.');
            Session::flash('alert-class', 'alert-danger');
            $id = $request->get('id');
            $shipment_id = $request->get('shipment_id');
            $name = $request->get('name');
            $code = $request->get('code');
            try {
                $response = $client->request('POST', 'https://api.shipments.test-y-sbm.com/item', [
                    'headers' => [
                        'Authorization' => $token,
                        'content-type' => 'application/json',
                    ],
                    'json' => [
                        'id' => $id,
                        'shipment_id' => $shipment_id,
                        'name' => $name,
                        'code' => $code

                    ]
                ]);
            } catch (\Exception $e) {
                dd($shipment_id);
                return redirect()->back();
            }
        }
        Session::flash('success-item', 'Товар удачно добавлен удачно добавлен в доставку.');
        Session::flash('alert-class', 'alert-success');
        return redirect()->to('/shipment');
    }

    public function getShipmentInner(Request $request, $id){

        $token = $request->session()->get('token');
        if(empty($token)) {
            return redirect()->to('/');
        }else {
            $client = new Client(['header' => [
                'content-type' => 'application/json', 'Authorization' => $token],
            ]);
            $response = $client->request('GET', 'https://api.shipments.test-y-sbm.com/shipment/'.$id, [
                'headers' => [
                    'Authorization' => $token,
                    'content-type' => 'application/json',
                ],

            ]);
            $data = $response->getBody();
            $data = json_decode($data);
            $items = $data->data->items;

            return view('shipmentinner')->with('items', $items);
        }
    }

    public function login(Request $request)
    {
        $token = $request->session()->get('token');

        if(empty($token)) {
            return view('login');
        }else{
            Session::flash('success-login', 'Вы уже авторизированы.');
            Session::flash('alert-class', 'alert-info');
            return redirect()->to('/shipment');
        }
        //return view('login');
    }

    public function deleteItem(Request $request){
        $token = $request->session()->get('token');
        $id = $request->get('id');
        if(empty($token)) {
            return redirect()->to('/');
        }else {
            $client = new Client(['header' => [
                'content-type' => 'application/json', 'Authorization' => $token],
            ]);
            $response = $client->request('DELETE', 'https://api.shipments.test-y-sbm.com/item/' . $id, [
                'headers' => [
                    'Authorization' => $token,
                    'content-type' => 'application/json',
                ],

            ]);
            Session::flash('success-delete-item', 'Item удачно удален.');
            Session::flash('alert-class', 'alert-success');
            return redirect()->back();
        }
    }

}
