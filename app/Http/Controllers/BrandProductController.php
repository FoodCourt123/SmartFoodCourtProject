<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use DB;

class BrandProductController extends Controller
{
    public function thembrand() {
    	$message = Session::get('admin_id');
    	if ($message) {
    		return view('pages.addbrand'); 
    	}
    	else {
    		Session::put('sign_noti','Login First');
    		return redirect('/admin');
    	}
    }

    public function xembrand() {
    	$message = Session::get('admin_id');
    	if ($message) {
    		$brand_data = DB::table('tbl_brand')->get();
    		$brand_manager = view('pages.allbrand')->with('brand_data',$brand_data);
    		return view('admin_layout')->with('pages.allbrand',$brand_manager); 
    	}
    	else {
    		Session::put('sign_noti','Login First');
    		return redirect('/admin');
    	}
    }

    public function savebrand (Request $request) {
    		$data = array();
    		$data['brand_name'] = $request->brand_name;
    		$data['brand_desc'] = $request->brand_desc;
    		$data['brand_status'] = $request->brand_status;

    		DB::table('tbl_brand')->insert($data);
    		Session::put('brand_noti','Thêm thành công');
    		return redirect()->back();
    }

    public function changebrandstatus($brand_product_id) {
    	$message = Session::get('admin_id');
    	if ($message) {
    		$data = DB::table('tbl_brand')->where('brand_id',$brand_product_id)->first();
    		if ($data->brand_status > 0) DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update(['brand_status'=> 0]);
    		else DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update(['brand_status'=> 1]);
    		return redirect()->back();
    	}
    	else {
    		Session::put('sign_noti','Login First');
    		return redirect('/admin');
    	}
    }

    public function editbrand($brand_product_id) {
    	$message = Session::get('admin_id');
    	if ($message) {
    		$edit_brand_data = DB::table('tbl_brand')->where('brand_id', $brand_product_id)->get();
    		$edit_brand_manager = view('pages.edit_brand_product')->with('edit_brand_data',$edit_brand_data);
    		return view('admin_layout')->with('pages.edit_brand_product',$edit_brand_manager); 
    	}
    	else {
    		Session::put('sign_noti','Login First');
    		return redirect('/admin');
    	}
    }

    public function updatebrand($brand_product_id, Request $request) {
    	$data = array();
    	$data['brand_name'] = $request->brand_name;
    	$data['brand_desc'] = $request->brand_desc;
    	$data['brand_status'] = $request->brand_status;

    	DB::table('tbl_brand')->where('brand_id', $brand_product_id)->update($data);
    	Session::put('brand_noti','Sửa thành công');
    	return redirect()->back();
    }

    public function deletebrand($brand_product_id) {
    	$message = Session::get('admin_id');
    	if ($message) {
    		DB::table('tbl_brand')->where('brand_id', $brand_product_id)->delete();
    		return redirect()->back();
    	}
    	else {
    		Session::put('sign_noti','Login First');
    		return redirect('/admin');
    	}
    }

    public function viewbrandbyid($brand_id) {
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id')->get();

        $product_data = DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')->where('product_status','1')->where('brand_status','1')->where('category_status','1')->orderby('product_id')->where('tbl_product.brand_id',$brand_id)->get();

        $brand_name = DB::table('tbl_brand')->where('brand_id',$brand_id)->limit(1)->get();
        return view('pages.brandbyid')->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('product_data',$product_data)->with('brand_name',$brand_name);
    }
}
