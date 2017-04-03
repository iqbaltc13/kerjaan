<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class InvestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
         if(Request::isMethod('post'))
        {
            $data = Input::all();
            
            

            $rules = array(
            'full_name'=>'required',
           'email' => 'required',
           'mobile_numb' => 'required',
           'company' => 'required',
           'currency'=>'required',
          'funding_amount_req'=>'required',
           'purchase_order'=>'required',
           'country'=>'required',
            'industry'=>'required',
            'est_annual_revenue'=>'required',
            'year_established'=>'required',
            'assets_to_be_purchased'=>'required',
            'financial_report'=>'required',);
            $validation = Validator::make(Input::all(), $rules);
            if ($validation->fails())
             {
            alert()->error('Semua data harap diisi');
            //ganti dibawah ini mau redirect ke mana
             return Redirect::to('/')->withErrors($validation)->withInput();
             }

             else{
                $data = Input::all();
                $destinationPath = 'imguser'; // upload path
                    $extension = Input::file('financial_report')->getClientOriginalExtension(); // getting image extension
                    $fileName = rand(11111,99999).'.'.$extension; // renaming image
                    Input::file('financial_report')->move($destinationPath, $fileName);
                    $foto=$destinationPath. '/'.$fileName;

             $purchase=$data['purchase_order'];
             $name=$data['full_name'];
             $mobile=$data['mobile_numb'];
             $currency=$data['currency'];
             $company=$data['company'];
             $email=$data['email'];
             $far=$data['funding_amount_req'];
             $country=$data['country'];
             $industry=$data['industry']; 
              $ear=$data['est_annual_revenue'];
              $year=$data['year_established'];
              $assets=$data['assets_to_be_purchased'];
             $sql="call sp_get_funded('$name','$email','$mobile','$company','$currency','$purchase','$far','$country','$industry','$year','$ear',,'$assets',,'$foto')";
             DB::connection()->getPdo()->exec($sql);
             DB::commit();
             alert()->success('get funded success');
             //edit yo redirect ke mana
             return Redirect::to('/auth/login');

             }
                    

       
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
