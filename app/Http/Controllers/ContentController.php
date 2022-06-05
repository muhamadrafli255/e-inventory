<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Goods;
use App\Models\Loans;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\userClass;
use App\Models\statusLoans;
use Illuminate\Http\Request;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Illuminate\Contracts\Encryption\DecryptException;

class ContentController extends Controller
{
    //Content Admin
    public function index(){
        $chart_options = [
            'chart_title' => 'Statistik Peminjaman',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\loans',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
        ];
        $chart1 = new LaravelChart($chart_options);
        $totalgoods = DB::table('goods')->where('stock', '>', 0)->get();
        $totalloans = DB::table('loans')
        ->whereDate('created_at', '=', Carbon::today()->toDateString())
        ->get();
        $loansday = DB::table('loans')
        ->where('status_loans_id', '=', '1')
        ->whereDate('created_at', '=', Carbon::today()->toDateString())
        ->get();
        $loansreturned = DB::table('loans')
        ->where('status_loans_id', '=', '2')
        ->whereDate('created_at', '=', Carbon::today()->toDateString())
        ->get();

        return view('content.admin.index', [
            'title' => 'Dashboard',
            'totalgoods' => $totalgoods,
            'totalloans' => $totalloans,
            'loansday' => $loansday,
            'loansreturned' => $loansreturned,
        ], compact('chart1'));
    }
    public function add(){
        $goods = Goods::all();

        $q = DB::table('goods')->select(DB::raw('MAX(RIGHT(productcode,4)) as kode'));
        $kd = "";
        if($q->count()>0)
        {
            foreach($q->get() as $k)
            {
                $tmp = ((int)$k->kode)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }
        else
        {
            $kd = "0001";
        }
        return view('content.admin.add', [
            'title' => 'Tambah Barang',
            'goods' => Goods::all()
        ], compact('goods', 'kd'));
    }
    public function store(Request $request){
            $validatedData = $request->validate([
            'name' => 'required',
            'stock' => 'required',
            'brand' => 'required',
            'productcode' => 'required',
            'image' => 'required|image|file|max:2048'
        ]);

        $validatedData['image'] = $request->file('image')->store('goods-images');

        Goods::create($validatedData);

        return redirect('/barang/lihat')->with('success', 'Barang Berhasil Ditambahkan');

    }
    public function show(){
        $goods = Goods::get();
        return view('content.admin.show',[
            'title' => 'Lihat Semua Barang',
            'goods' => $goods
        ]);
    }
    public function showedit(Request $request){
        $search = $request->search;
        if($search == ""){
            $goods = Goods::all();
        }else{
            $goods = DB::table('goods')
            ->where('name','like',"%".$search."%")
            ->get();
        }
        
        return view('content.admin.showedit', [
            'title' => 'Edit Data Barang',
            'goods' => $goods
        ]);
    }
    public function showdelete(Request $request){
        $search = $request->search;
        if($search == ""){

            $goods = Goods::all();
        }else{
            $goods = Goods::where('name','like',"%".$search."%")->get();
        }
        return view('content.admin.showdelete', [
            'title' => 'Hapus Data Barang',
            'goods' => $goods
        ]);
    }

    public function delete(Goods $goods){

        Goods::destroy($goods->id);

        return redirect('/barang/lihat')->with('success', 'Data Barang Berhasil Dihapus');
    }
    public function edit(Goods $goods){
        return view('content.admin.edit',[
            'title' => 'Edit Data Barang',
            'goods' => $goods
        ]);
    }
    public function update(Request $request, Goods $goods){
        $validatedData = $request->validate([
            'name' => 'required',
            'stock' => 'required',
            'brand' => 'required',
            'productcode' => 'required',
        ]);

        Goods::where('id', $goods->id)->update($validatedData);

        return redirect('/barang/lihat')->with('success', 'Data berhasil dirubah!');
    }
    public function addloans(){
        $loans = Loans::with('user')->paginate(10);
        $q = DB::table('loans')->select(DB::raw('MAX(RIGHT(loans_code,4)) as code'));
        $kd = "";
        if($q->count()>0)
        {
            foreach($q->get() as $k)
            {
                $tmp = ((int)$k->code)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }
        else
        {
            $kd = "0001";
        }
        return view('content.admin.addloans',[
            'title' => 'Catat Peminjaman',
            'goods' => Goods::where('stock', '>', 0)->get(),
            'user' => User::get(),
            'userClass' => userClass::all(),
        ], compact('loans', 'kd'));
    }
    public function showloans(){
        $dtLoans = Loans::with('user','goods','statusloans')->latest()->get();
        return view('content.admin.showloans',[
            'title' => 'Semua Data Peminjaman',
            'user' => User::all(),
            'goods' => Goods::all(),
            'loans' => Loans::all(),
            'statusloans' => statusLoans::all(),
        ], compact('dtLoans'));
    }
    public function storeloans(Goods $goods, Request $request)
    {
        $jumlah = 1;
        $validatedData = $request->validate([
            'user_id' => 'required',
            'goods_id' => 'required',
            'loans_code' => 'required|unique:loans',
            'purpose' => 'required'
        ]);

        Loans::create($validatedData);
        Goods::where('id', $validatedData['goods_id'])->update(['stock' => DB::raw("stock - $jumlah")]);

        return redirect('/peminjaman/lihat')->with('success', 'Peminjaman Berhasil Dicatat!');

    }

    public function loansdelete(Loans $loans){
        Loans::destroy($loans->id);

        return redirect('/peminjaman/lihat')->with('success', 'Data Berhasil Dihapus!');
    }

    public function showloansdelete(){
        $dtLoans = Loans::with('user','goods')->latest()->get();
        return view('content.admin.showloansdelete',[
            'title' => 'Hapus Data Peminjaman',
            'user' => User::all(),
            'goods' => Goods::all(),
            'loans' => Loans::all(),
        ], compact('dtLoans'));
    }

    public function showloansedit(){
        $dtLoans = Loans::with('user','goods')->latest()->get();
        return view('content.admin.showloansedit',[
            'title' => 'Edit Data Peminjaman',
            'user' => User::all(),
            'goods' => Goods::all(),
            'loans' => Loans::all(),
        ], compact('dtLoans'));
    }

    public function editloans(Loans $loans){
        return view('content.admin.editloans',[
            'title' => 'Edit Data Peminjaman',
            'loans' => $loans,
            'goods' => Goods::get(),
            'user' => User::get(),
            'userClass' => userClass::get(),
        ]);
    }

    public function updateloans(Request $request, Loans $loans){
        $validatedData = $request->validate([
            'loans_code' => 'required',
            'user_id' => 'required',
            'goods_id' => 'required',
            'purpose' => 'required',
        ]);

        Loans::where('id', $loans->id)->update($validatedData);

        return redirect('/peminjaman/edit')->with('success', 'Data berhasil dirubah!');
    }

    public function updatestatus(Loans $loans){
        if($loans->status_loans_id == 1){
            DB::table('loans')
            ->where('id', $loans->id)
            ->update(['status_loans_id' => 2]);
            Goods::where('id', $loans->goods_id)->update(['stock' => DB::raw("stock + 1")]);
            return redirect('/peminjaman/lihat')->with('success', 'Konfirmasi pengembalian berhasil!');
        }elseif($loans->status_loans_id == 3){
            DB::table('loans')
            ->where('id', $loans->id)
            ->update(['status_loans_id' => 1]);
            Goods::where('id', $loans->goods_id)->update(['stock' => DB::raw("stock - 1")]);
            return redirect('/peminjaman/lihat')->with('success', 'Konfirmasi peminjaman berhasil!');
        }

        return redirect('/peminjaman/lihat')->with('error', 'Ada Kesalahan!');

    }

    public function showuser(){
        return view('content.admin.showuser', [
            'title' => 'Semua Data User',
            'users' => User::where('role', 'user')->get(),
            'userclass' => userClass::get()
        ]);
    }

    public function edituser(){
        return view('content.admin.edituser', [
            'title' => 'Edit Data User',
            'users' => User::where('role', 'user')->get(),
            'userclass' => userClass::get()
        ]);
    }

    public function adduser(){
        return view('content.admin.adduser', [
            'title' => 'Tambah Data User',
            'userclasses' => userClass::get(),
        ]);
    }

    public function adduserstore(Request $request, User $user){
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email:dns',
            'userclass_id' => 'required',
            'password' => 'required|min:8',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'userclass_id' => $validatedData['userclass_id'],
            'password' => $validatedData['password']
        ]);
            
        return redirect('/user/lihat')->with('success', 'Data berhasil ditambahkan!');
    }

    public function deleteuser(){
        return view('content.admin.deleteuser', [
            'title' => 'Hapus Data User',
            'users' => User::where('role', 'user')->get(),
            'userclass' => userClass::get(),
        ]);
    }

    public function edituserprogress(User $user){
        return view('content.admin.edituserprogress', [
            'title' => 'Edit Data User',
            'users' => $user,
            'userclasses' => userClass::get(),
        ]);

    }

    public function editusersave(Request $request, User $user){
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email:dns',
            'userclass_id' => 'required',
            'password' => 'required|min:8',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::where('id', $user->id)->update($validatedData);
        return redirect('/user/lihat')->with('success', 'Data berhasil diedit!');
    }

    public function userdelete(User $user){
        User::destroy($user->id);

        return redirect('/user/lihat')->with('success', 'Data berhasil dihapus!');
    }

    public function adminsettings(User $user){
        $user = Auth::user();
        return view('content.admin.settings',[
            'title' => 'Pengaturan Akun',
            'userclasses' => userClass::get(),
            'user' => $user,
        ]);
    }

    public function updateakun(Request $request){
        $validatedData = $request->validate([
            'name' => 'require',
            'userclass_id' => 'required',
            'number_phone' => 'required|numeric',
            'address' => 'required',
            'image' => 'image|file|max:2048',
        ]);

        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('profile-images');
        }
        DB::table('users')
        ->where('id', $request->id)
        ->update($validatedData);

        if(Auth::user()->role == 'admin'){
        return redirect('/pengaturanakun')->with('success', 'Data akun berhasil dirubah!'); 
        }else{
        return redirect('/pengaturan')->with('success', 'Data akun berhasil dirubah!');
        }
    }

    public function settingspassword(){
        return view('content.admin.settingspassword',[
            'title' => 'Pengaturan Password',
            'user' => User::get(),
        ]);
    }

    public function updatepassword(Request $request, User $user){
        $this->validate($request, [
            'password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password'
        ]);

        if(Hash::check($request['password'], $user['password']))
        $user->fill([
            'password' => Hash::make($request['new_password'])
        ])->save();

        if(Auth::user()->role == 'admin'){
            return redirect('/pengaturanpassword/{user}')->with('success', 'Password berhasil dirubah!');
        }else{
            return redirect('/pengaturanpassworduser/{user}')->with('success', 'Password berhasil dirubah!');
        }
        
    }

    public function exceluser(){
        return view('content.admin.exceluser',[
            'title' => 'Data User',
            'users' => User::get(),
            'userclasses' => userClass::get(),
        ]);
    }

    public function showreport(){
        return view('content.admin.report', [
            'title' => 'Buat Data Laporan',
            'users' => User::paginate(),
            'userclasses' => userClass::get(),
            'loans' => Loans::paginate(),
        ]);
    }

    public function downloadpdf(){
        $users = user::all();

        $pdf = PDF::loadView('content.admin.pdfuser', ['users' => $users]);
        return $pdf->download('laporan-Data-User.pdf');
        return redirect('content.admin.report');
    }

    public function excelloans(){
        return view('content.admin.excelloans',[
            'title' => 'Data Peminjaman',
            'loans' => loans::get(),
        ]);
    }

    public function downloadpdfloans(){
        $loans = Loans::all();

        $pdf = PDF::loadView('content.admin.pdfloans', ['loans' => $loans]);
        return $pdf->download('laporan-Data-Peminjaman.pdf');
        return redirect('content.admin.report');
    }

    public function search(Request $request){
        $search = $request->search;

        $goods = DB::table('goods')
        ->where('name','like',"%".$search."%")
        ->get();

        return view('content.admin.show',[
            'goods' => $goods,
            'title' => 'Lihat Semua Barang',
        ]);
    }

    public function loanstoday()
    {
        $loans = Loans::whereDate('created_at', "=", Carbon::today()->toDateString())->get();
        return view('content.admin.showloans',[
            'title' => 'Peminjaman Hari Ini',
            'dtLoans' => $loans,
        ]);
    }

    public function borrowtoday()
    {
        $loans = Loans::whereDate('created_at', "=", Carbon::today()->toDateString())->where('status_loans_id', '=', 1)->get();
        return view('content.admin.showloans',[
            'title' => 'Peminjaman Hari Ini',
            'dtLoans' => $loans,
        ]);
    }

    public function returnedtoday()
    {
        $loans = Loans::whereDate('created_at', "=", Carbon::today()->toDateString())->where('status_loans_id', '=', 2)->get();
        return view('content.admin.showloans',[
            'title' => 'Pengembalian Hari Ini',
            'dtLoans' => $loans,
        ]);
    }




    //Content User
    public function indexuser(){
        $q = DB::table('loans')->select(DB::raw('MAX(RIGHT(loans_code,4)) as code'));
        $kd = "";
        if($q->count()>0)
        {
            foreach($q->get() as $k)
            {
                $tmp = ((int)$k->code)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }
        else
        {
            $kd = "0001";
        }
        $totalgoods = DB::table('goods')->where('stock', '>', 0)->get();
        $totalloans = DB::table('loans')
        ->where('user_id', Auth::user()->id)
        ->whereDate('created_at', '=', Carbon::today()->toDateString())
        ->get();
        $loansday = DB::table('loans')
        ->where('status_loans_id', '=', '1')
        ->where('user_id', Auth::user()->id)
        ->whereDate('created_at', '=', Carbon::today()->toDateString())
        ->get();
        $loansreturned = DB::table('loans')
        ->where('status_loans_id', '=', '2')
        ->where('user_id', Auth::user()->id)
        ->whereDate('created_at', '=', Carbon::today()->toDateString())
        ->get();
        return view('content.user.index', [
            'title' => 'Beranda',
            'totalloans' => $totalloans,
            'totalgoods' => $totalgoods,
            'loansday' => $loansday,
            'loansreturned' => $loansreturned,
        ], compact('kd'));
    }
    public function showall(){
        $q = DB::table('loans')->select(DB::raw('MAX(RIGHT(loans_code,4)) as code'));
        $kd = "";
        if($q->count()>0)
        {
            foreach($q->get() as $k)
            {
                $tmp = ((int)$k->code)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }
        else
        {
            $kd = "0001";
        }
        $goods = Goods::where('stock', '>', 0)->get();
        return view('content.user.showall', [
            'title' => 'Lihat Semua Barang',
            'goods' => $goods
        ], compact('kd'));
    }
    public function find(Request $request){
        $q = DB::table('loans')->select(DB::raw('MAX(RIGHT(loans_code,4)) as code'));
        $kd = "";
        if($q->count()>0)
        {
            foreach($q->get() as $k)
            {
                $tmp = ((int)$k->code)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }
        else
        {
            $kd = "0001";
        }

        $search = $request->search;
        if($search == ""){
        $totalgoods = Goods::where('stock', '>', 0)->get();;
        }else{
            $totalgoods = Goods::where('name', 'like', "%".$search."%")->where('stock', '>', 0)->get();
        }
        return view('content.user.find', [
            'title' => 'Cari Barang'
        ], compact('kd', 'totalgoods'));
    }
    public function history(){
        $loans = Loans::where('user_id', Auth::user()->id)->get();
        return view('content.user.history', [
            'title' => 'Sejarah Peminjaman',
        ], compact('loans'));
    }
    public function settings(){
        $user = Auth::user();
        $userclasses = userClass::get();
        return view('content.user.settings', [
            'title' => 'Pengaturan'
        ], compact('user', 'userclasses'));
    }

    public function password(){
        return view('content.user.settingspassword',[
            'title' => 'Pengaturan Password',
            'user' => User::get(),
        ]);
    }

    public function loansuser(Request $request, Goods $goods){
        Loans::create([
            'user_id' => Auth::user()->id,
            'goods_id' => $goods->id,
            'status_loans_id' => 3,
            'loans_code' => $request->loans_code,
            'purpose' => $request->purpose,
        ]);

        return redirect('/home')->with('success', 'Peminjaman Berhasil, Silahkan tunggu admin menyetujui peminjaman!');

    }

    public function searchgoods(Request $request){
        $name = $request->name;
        $results = Goods::where('name', 'like', '%'.$name.'%')->get();
        $count = count($results);
        
        if($count == 0){
            return 'data tidak ditemukan';
        }else{
            return view('content.user.showall')->with([
                'goods' => $results
            ]);
        }
    }

    public function userloanstoday()
    {
        $loans = Loans::where('user_id', Auth::user()->id)
                 ->whereDate('created_at', '=', Carbon::today()->toDateString())
                 ->get();
        return view('content.user.history', [
                    'title' => 'Peminjaman Hari Ini',
                    'loans' => $loans,
                    ]);
    }

    public function userborrowstoday()
    {
        $loans = Loans::where('user_id', Auth::user()->id)
                 ->where('status_loans_id', "=", 1)
                 ->whereDate('created_at', '=', Carbon::today()->toDateString())
                 ->get();
        return view('content.user.history', [
                    'title' => 'Dipinjam Hari Ini',
                    'loans' => $loans,
                    ]);
    }

    public function userreturnedtoday()
    {
        $loans = Loans::where('user_id', Auth::user()->id)
                 ->where('status_loans_id', "=", 2)
                 ->whereDate('created_at', '=', Carbon::today()->toDateString())
                 ->get();
        return view('content.user.history', [
                    'title' => 'Pengembalian Hari Ini',
                    'loans' => $loans,
                    ]);
    }
}

