<?php

require_once '../vendor/autoload.php';

class RDV extends Controller
{

    public $data = [];
    public $key = "test";

    public function __construct()
    {
        $this->RDVModel = $this->model('RDVModel');
    }

    public function RDVs($date)
    {
        
        $RDVs = $this->RDVModel->getRDVs($date);
        print_r(json_encode($RDVs));
    }

    public function info($id)
    {
        $RDV = $this->RDVModel->RDVInfo($id);
        print_r(json_encode($RDV));
    }


    public function infoByRef($rdv)
    {
        $RDV = $this->RDVModel->RDVInfoByRef($rdv);
        print_r(json_encode($RDV));
    }

    public function add()
    {
        $headers = apache_request_headers();
        
        $headers = isset($headers['Authorization']) ? explode(' ', $headers['Authorization']) : null;
        if ($headers) {
            try {
                $infos = $this->verifyAuth($headers[1]);
                if ($infos->role === "patient") {
                    
                    $reference = $infos->reference;
                    
                    $RDV = $this->RDVModel->add($this->data, $reference);
                    
                    if ($RDV) {
                        print_r(json_encode(array(
                            "message" => "RDV Created with success",
                            "data" => $this->data
                        )));
                    }
                } else {
                    print_r(json_encode(array(
                        'error' => "You Don't Have permission to make this action",
                    )));
                    die();
                }
            } catch (\Throwable $th) {
                print_r(json_encode(array(
                    'error' => "Authentication error",
                )));
            }
        } else {
            print_r(json_encode(array(
                'error' => "Token is invalid",'token'=> $headers
            )));
        }
    }

    public function delete()
    {
        $this->RDVModel->delete($this->data);
        print_r(json_encode(array(
            'message' => "the reservation canceled"
        )));
    }

    public function edit()
    {

        $headers = apache_request_headers();
        $headers = isset($headers['Authorization']) ? explode(' ', $headers['Authorization']) : null;
        if ($headers) {
            try {
                $infos = $this->verifyAuth($headers[1]);
                if ($infos->role == "patient") {
                    $RDV = $this->RDVModel->delete($this->data);
                    $reference = $infos->reference;
                    $RDV = $this->RDVModel->add($this->data, $reference);
                    if ($RDV) {
                        print_r(json_encode(array(
                            "message" => "RDV Edited with success",
                        )));
                    }
                } else {
                    print_r(json_encode(array(
                        'error' => "You Don't Have permission to make this action",
                    )));
                    die();
                }
            } catch (\Throwable $th) {
                print_r(json_encode(array(
                    'error' => "Authentication error",
                )));
            }
        } else {
            print_r(json_encode(array(
                'error' => "token is invalid"
            )));
        }
    }


    public function search(){
        $result = $this->userModel->getBySearch($this->data);
        print_r(json_encode($result));
    }

}
