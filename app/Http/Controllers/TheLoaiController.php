<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TheLoai;

class TheLoaiController extends Controller
{
    //
    public function getDanhSach(){
        $theloai = TheLoai::all();
        return view('admin.theloai.list',['theloai'=>$theloai]);
    }

    public function getThem(){
        return view('admin.theloai.add');
    }

    public function postThem(Request $request){
        $this->validate($request,
        [
            'Ten'=>'required|min:3|max:100|unique:TheLoai,Ten'
        ],
        [
            'Ten.required'=>'Bạn chưa nhập tên thể loại',
            'Ten.unique'=>'Tên thể lại đã tồn tại',
            'Ten.min'=>'Tên thể loại cần phải có từ 3 đến 100 ký tự',
            'Ten.max'=>'Tên thể loại cần phải có từ 3 đến 100 ký tự',
        ]);

        $theloai = new TheLoai;
        $theloai->Ten = $request->Ten;
        $theloai->TenKhongDau = changeTitle($request->Ten);
        $theloai->save();
        return redirect('admin/theloai/them')->with('thongbao','Thêm thành công'); 
    }

    public function getSua($id){
        $theloai = TheLoai::find($id);
        return view('admin.theloai.edit',['theloai'=>$theloai]);
    }

    public function postSua(Request $request,$id){
        $theloai = Theloai::find($id);
        $this->validate($request,
        [
            'Ten'=>'required|unique:TheLoai,Ten|min:3|max:100'
        ],
        [
            'Ten.required'=>'Bạn chưa nhập tên thể loại',
            'Ten.unique'=>'Tên thể lại đã tồn tại',
            'Ten.min'=>'Tên thể loại cần phải có từ 3 đến 100 ký tự',
            'Ten.max'=>'Tên thể loại cần phải có từ 3 đến 100 ký tự',
        ]);
        $theloai->Ten = $request->Ten;
        $theloai->TenKhongDau = changeTitle($request->Ten);
        $theloai->save();
        return redirect('admin/theloai/sua/'.$id)->with('thongbao','Sửa thành công');  
    }

    public function getXoa($id){
        $theloai = TheLoai::find($id);
        $theloai->delete();
        return redirect('admin/theloai/danhsach')->with('thongbao','Xóa thành công');
    }
}
