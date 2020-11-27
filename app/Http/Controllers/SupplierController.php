<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierRequest;
use App\Models\Supplier;
use App\User;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index() {
        $id = user()->id;
        $user = User::find($id);
        $data = [
            'rider' => $user->profile,
            'suppliers' =>  $this->supplierList($user),
            'i' => 1,
        ];
        return view('front.supplier.index',$data);
    }

    protected function supplierList($user){
        // $id = user()->id;
        // $user = User::find($id);
        $suppliers = $user->suppliers->sortByDesc('created_at');
        $result = [];
        foreach($suppliers as $key => $supplier){
            $status_comment = $supplier->approvalComments->sortBydesc('created_at');
            $result[$key] = [
                'id' => $supplier->id,
                'supplier_name' => $supplier->supplier_name,
                'supplier_image' => !empty($supplier->supplier_image) ? $supplier->supplier_image : 'not_found.jpg',
                'supplier_rating' => $supplier->supplier_rating,
                'supplier_address' => $supplier->supplier_address,
                'supplier_description' => $supplier->supplier_description,
                'created_at' => formatDate($supplier->created_at, 'd M Y'),
                'spare_parts' => !empty($supplier->spare_parts) ? json_decode($supplier->spare_parts,true) : '',
                'status' => $supplier->is_approved,
                'status_comment' => $status_comment
            ];
        }
        return $result;
    }

    public function create() {
        return view('front.supplier.create');
    }

    public function store(SupplierRequest $request)
    {
        $supplierData = $request->all();    
        $new_name='';
        if(isset($request->supplier_image)) {
            $image = $request->supplier_image;
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/supplier_images/'), $new_name);
        }

        $supplierData['rider_id'] = user()->id;
        $supplierData['supplier_image'] = $new_name;
        
        $supplierData['spare_parts'] = $this->filterSpareParts($request->spare_part_name, $request->spare_part_image, $request->spare_part_number);
        unset($supplierData['spare_part_name']);
        unset($supplierData['spare_part_number']);
        unset($supplierData['spare_part_images']);
        Supplier::create($supplierData);
        $response = array('status'=>true, 'msg' => 'Supplier has been added successfully');
        return response()->json($response);
    }

    protected function filterSpareParts($spare_part_names, $spare_part_images, $spare_part_number) {
        $result = [];
        if(!empty($spare_part_names)) {
            foreach($spare_part_names as $key => $spare_part) {
                $result[$key]['name'] = $spare_part;
                $result[$key]['number'] = $spare_part_number[$key];
                $new_name = '';
                if(isset($spare_part_images[$key])) {
                    $image = $spare_part_images[$key];
                    $new_name = rand() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('images/supplier/spare_parts/'), $new_name);
                }
                $result[$key]['image'] = $new_name;
            }
        }  
        return json_encode($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        $supplier->delete();
        $response = ['status' => true, 'msg'=>'Supplier has been deleted successfully'];
        return response()->json($response);
    }
}
