<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use App\Models\Report;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductIn;
use App\Models\ProductOut;
use App\Models\Template;
use App\Models\Spreadsheet;

class EmployeeController extends Controller {

    public function index() {

        $tanggal = Carbon::now()->format('Y-m-d');

        $hadir = DB::table('attendances')->where("date", $tanggal)->where("status", "hadir")->get();
        $amountHadir = count($hadir);

        $izin = DB::table('attendances')->where("date", $tanggal)->where("status", "izin")->get();
        $amountIzin = count($izin);

        $laporan = DB::table('reports')->where("date", $tanggal)->get();
        $amountLaporan = $laporan->unique('user_id');
        $amountLaporan = count($amountLaporan);

        // dd($amountLaporan);

        // if($laporan->isEmpty()) {

        //     $laporan = [];

        // }

        $noLapor = [];

        // foreach($hadir as $val) {

        //     dd($val->name, $laporan);

        //     if(!in_array($val->name, $laporan)) {

        //         $noLapor[] = $val;

        //     } else {

        //         $noLapor = [];

        //     }

        // }

        // dd($laporan);

        foreach($hadir as $val) {

            // dd($val, $laporan->isEmpty());

            if(!$laporan->isEmpty()) {

                foreach($laporan as $awok) {

                    if($val->name != $awok->name) {

                        $noLapor[] = $val;

                    }

                }

            } else {

                $noLapor[] = $val;

            }

        }

        $amountNoLapor = count($noLapor);
        
        return view("dashboard", [
            'hadir' => $hadir,
            'amountHadir' => $amountHadir,
            'izin' => $izin,
            'amountIzin' => $amountIzin,
            'laporan' => $laporan,
            'amountLaporan' => $amountLaporan,
            'noLapor' => $noLapor,
            'amountNoLapor' => $amountNoLapor
        ]);

    }

    public function attendance(Request $request) {
        
        if(auth()->user()->role == "employee") {

            $tanggal = Carbon::now()->format('Y-m-d');

            if($cekAbsen = DB::table("attendances")->where("date", $tanggal)->where("user_id", auth()->user()->id)->latest()->first()) {

                session(["absen" => "Anda sudah absen hari ini, silahkan absen kembali esok hari"]);
                return view("attendance")->with("absen", session("absen"));

            } else {

                session()->forget('absen');
                return view("attendance");

            }

        } else {

            if($request->has("id")) {

                $id = $request->id;

                $result = DB::table('attendances')->where("user_id", $id)->latest()->get();
                $user = User::find($id);

                if($result->isEmpty()) {

                    $result = null;

                }

                return view('attendance-detail', [

                    "data" => $result,
                    "user" => $user

                ]);

            } else {

                $tanggal = Carbon::now()->format('Y-m-d');
                $result = DB::table('attendances')->where("date", $tanggal)->get();
                $employees = DB::table('users')->where('role', 'employee')->get();

                if($result->isEmpty()) {

                    $result = null;

                }

                return view("attendance", [

                    "data" => $result,
                    "employees" => $employees

                ]);

            }

        }

    }

    public function attendanceHandle(Request $request) {
        
        $validatedData = $request->validate([
            'evidence' => 'file|max:20480|nullable',
            'user_id' => 'required',
            'location' => 'required',
            'status' => 'nullable',
            'reason' => 'nullable',
            'date' => 'nullable'
        ]);

        if ($request->hasFile('evidence')) {

            $folder = auth()->user()->email;
            $folder = explode('@', $folder);
            $folder = array_shift($folder);
            $folder = explode('.', $folder);
            $folder = array_shift($folder);

            $file = $request->file('evidence');
            $fileName = $file->getClientOriginalName();
            $filePath = $file->storeAs($folder, $fileName);

            $validatedData['evidence'] = $filePath;

        }
        
        $validatedData['name'] = auth()->user()->name;
        $validatedData['date'] = Carbon::now()->format('Y-m-d');;

        Attendance::create($validatedData);

        return redirect()->back()->with("successAttendance", "Anda berhasil absen hari ini.");

    }

    public function employees() {

        $users = User::all();
        $amount = count($users);

        return view("employees", [
            'users' => $users,
            'amount' => $amount
        ]);

    }

    public function employeesHandle(Request $request) {

        $credentials = $request->validate([

            "email" => "required|email",
            "password" => "required",
            "role" => "required|in:admin,employee",
            "job" => "required"

        ], [

            "role.in" => "Nilai pada kolom role harus berisi 'admin' atau 'karyawan'."

        ]);

        $name = explode("@", $credentials['email']);
        $name = array_shift($name);
        $password = Hash::make($credentials['password']);

        $user = User::create([
            'name' => $name,
            'email' => $credentials['email'],
            'password' => $password,
            'role' => $credentials['role'],
            'telephone' => "xxx xxxx xxxx",
            'job' => $credentials['job'],
            'access' => null
        ]);

        if($user) {

            return redirect("/employees")->with("successRegister", "Karyawan baru berhasil ditambahkan");

        } else {

            return redirect("/employees")->withErrors(["error" => "Gagal menambahkan karyawan"]);

        }

    }

    public function report(Request $request) {

        if(auth()->user()->role == "employee" && !str_contains(auth()->user()->access, "report")) {

            return view("report");

        } else {

            if($request->has("id")) {

                $id = $request->id;

                $result = DB::table('reports')->where("user_id", $id)->latest()->get();
                $user = User::find($id);

                if($result->isEmpty()) {

                    $result = null;

                }

                return view('report-detail', [

                    "data" => $result,
                    "user" => $user

                ]);

            } else {

                $tanggal = Carbon::now()->format('Y-m-d');
                $result = DB::table('reports')->where("date", $tanggal)->get();
                $employees = DB::table('users')->where('role', 'employee')->get();

                if($result->isEmpty()) {

                    $result = null;

                }

                return view("report", [

                    "data" => $result,
                    "employees" => $employees

                ]);

            }

        }

    }

    public function reportHandle(Request $request) {

        $validatedData = $request->validate([
            'file[]' => 'file|max:20480|nullable',
            'user_id' => 'required',
            'type' => 'required',
            'report' => 'nullable'
        ]);

        if ($request->file) {

            $validatedData['file'] = "";

            foreach($request->file as $data) {

                $folder = auth()->user()->email;
                $folder = explode('@', $folder);
                $folder = array_shift($folder);
                $folder = explode('.', $folder);
                $folder = array_shift($folder);

                $file = $data;
                $fileName = $file->getClientOriginalName();
                $filePath = $file->storeAs($folder, $fileName);

                $validatedData['file'] .= $filePath . ",";

            }

        }
        
        $validatedData['name'] = auth()->user()->name;
        $validatedData['date'] = Carbon::now()->format('Y-m-d');;

        Report::create($validatedData);

        return redirect()->back()->with("successReport", "Laporan anda telah disimpan untuk hari ini.");

    }

    public function product() {

        $products = Product::all();
        $employees = DB::table("users")->where("role", "employee")->get();
        $productsIn = ProductIn::all();
        $productsOut = ProductOut::all();

        if($productsIn->isEmpty()) {
            $productsIn = null;
        }

        if($productsOut->isEmpty()) {
            $productsOut = null;
        }

        return view('product', [
            'products' => $products,
            'employees' => $employees,
            'productsIn' => $productsIn,
            'productsOut' => $productsOut
        ]);

    }

    public function productHandle(Request $request) {

        $users = User::where('role', 'employee')->get();

        if($request->has("access")) {

            $selectedUsers = $request->access;

        } else {

            $selectedUsers = [];

        }

        foreach ($users as $user) {

            if (in_array($user->email, $selectedUsers)) {

                // dd(in_array($user->email, $selectedUsers));

                $orang = User::where('email', $user->email)->first();

                if($orang->access != null) {

                    $akses = explode(",", $orang->access);

                    if(!in_array("product", $akses)) {

                        array_push($akses, "product");

                        $orang->access = implode(",",$akses);

                        $orang->save();

                    }

                } else {

                    $orang->access = "product";
                    $orang->save();

                }

            } else {

                if($user->access != null) {

                    if(str_contains($user->access, "product")) {

                        $arrAkses = explode(",", $user->access);
                        $arrAkses = array_diff($arrAkses, ["product"]);
                        $user->access = implode(",", $arrAkses);

                        $user->save();

                    }

                }

            }

        }

        return redirect()->back()->with("succesChangeAccess", "Berhasil mengubah hak akses untuk user lain terhadap data produk.");

    }

    public function productDataHandle(Request $request) {

        $product = Product::find($request->id);
        $product->stok_awal = $request->stok_awal;
        $product->masuk = $request->masuk;
        $product->keluar = $request->keluar;
        $product->stok_akhir = $request->stok_akhir;

        if($product->save()) {

            return redirect("/products")->with("successProducts". "Berhasil diubah");

        }

    }

    public function productDataInHandle(Request $request) {

        $product = Product::find($request->id);
        $kode = $product->kode_barang;
        $nama = $product->nama_barang;
        $product->masuk = intval($product->masuk) + intval($request->jumlah_masuk);
        $product->stok_akhir = intval($product->stok_awal) + intval($product->masuk) - intval($product->keluar);

        if($product->save()) {

            $tambahkan = ProductIn::create([
                'tanggal' => $request->tanggal,
                'kode_barang' => $kode,
                'nama_barang' => $nama,
                'jumlah_masuk' => $request->jumlah_masuk,
                'keterangan' => $request->keterangan
            ]);

            if($tambahkan) {

                return redirect("/products")->with("successProductIn", "Kuantitas produk berhasil ditambahkan");

            }

            return redirect("/products")->with("failedProductIn", "Kuantitas produk gagal ditambahkan");

        }

        return redirect("/products")->with("failedChangeProductIn", "Data produk gagal diubah");

    }

    public function productDataOutHandle(Request $request) {

        $product = Product::find($request->id);
        $kode = $product->kode_barang;
        $nama = $product->nama_barang;
        $product->keluar = intval($product->keluar) + intval($request->jumlah_keluar);
        $product->stok_akhir = intval($product->stok_awal) + intval($product->masuk) - intval($product->keluar);

        if($product->save()) {

            $tambahkan = ProductOut::create([
                'tanggal' => $request->tanggal,
                'kode_barang' => $kode,
                'nama_barang' => $nama,
                'jumlah_keluar' => $request->jumlah_keluar,
                'satuan' => $request->satuan,
                'keterangan' => $request->keterangan
            ]);

            if($tambahkan) {

                return redirect("/products")->with("successProductOut", "Kuantitas produk berhasil dikurangi");

            }

            return redirect("/products")->with("failedProductOut", "Kuantitas produk gagal dikurangi");

        }

        return redirect("/products")->with("failedChangeProductOut", "Data produk gagal diubah");

    }

    public function generateRecap() {

        $products = Product::all();

        foreach($products as $product) {

            $product->stok_awal = $product->stok_akhir;
            $product->masuk = 0;
            $product->keluar = 0;
            $product->stok_akhir = $product->stok_awal;

            $product->save();

        }

        return redirect(env("APP_URL") . "products");

    }

    public function getProductData() {

        $data = Product::select('kode_barang', 'nama_barang', 'stok_awal', 'masuk', 'keluar', 'stok_akhir', 'satuan')->get();
        return response()->json($data, 200, [], JSON_PRETTY_PRINT);

    }

    public function uploadProfileImage(Request $request) {

        $user = User::find($request->id);

        if($user->thumbnail != null) {

            Storage::delete($user->thumbnail);

        }

        if ($request->hasFile('thumbnail')) {

            $folder = auth()->user()->email;
            $folder = explode('@', $folder);
            $folder = array_shift($folder);
            $folder = explode('.', $folder);
            $folder = array_shift($folder);
            $folder .= "/thumbnail";

            $file = $request->file('thumbnail');
            $fileName = $file->getClientOriginalName();
            $thumbnail = $file->storeAs($folder, $fileName);

        }

        $user->thumbnail = $thumbnail;
        $user->save();

    }

    public function employeeHandle(Request $request) {

        if($request->has("ubahProfil")) {

            $validate = $request->validate([
                'email' => 'email'
            ]);

            $user = User::find(auth()->user()->id);
            $user->name = $request->name;
            $user->email = $validate["email"];
            $user->telephone = $request->telephone;

            if($user->save()) {

                return redirect("/")->with("successProfile", "Profil anda berhasil diubah");

            } else {

                return redirect("/")->with("failedProfile", "Profil anda gagal diubah");

            }

        } elseif($request->has("ubahPassword")) {

            if(Hash::check($request->password_lama, auth()->user()->password)) {

                $validate = $request->validate([
                    'password_baru' => 'required',
                    'konfirmasi_password' => 'required|same:password_baru'
                ]);

                $new_password = Hash::make($request->konfirmasi_password);

                $user = User::find(auth()->user()->id);
                $user->password = $new_password;

                if($user->save()) {

                    return redirect("/logout")->with("successPass", "Password anda berhasil diubah, silahkan login kembali");

                }

                return redirect("/")->with("failedPass", "Password anda gagal diubah, harap coba lagi nanti");

            }

            return redirect("/")->with("failedPass", "Sepertinya password lama anda tidak sesuai, silahkan coba lagi");

        }   

    }

    public function spreadsheet() {

        $data = DB::table("spreadsheets")->where("owner", auth()->user()->email)->get();
        $templates = Template::all();

        $acc = Spreadsheet::all();
        $access = [];

        foreach($acc as $val) {

            $accepted = $val->access;
            $accepted = explode(",", $accepted);

            if(in_array(auth()->user()->email, $accepted)) {

                $access[] = $val;

            }

        }

        if(empty($access)) {

            $access = null;

        }

        if($data->isEmpty()) {

            $data = null;

        }

        return view("spreadsheet", [
            'data' => $data,
            'accepted' => $access,
            'templates' => $templates
        ]);

    }

    public function sheetHandle(Request $request, $slug) {

        if($request->has("delete")) {

            Spreadsheet::find($request->delete)->delete();

            return redirect("/spreadsheet");

        }

        if($request->id) {

            if(!$request->has('access')) {

                $sheet = Spreadsheet::find($request->id);
                $sheet->access = "";

                if($sheet->save()) {

                    return redirect()->back()->with("successAcc", "Mantap Slurrr");

                }

                return redirect("/spreadsheet");

            } elseif($request->has('access')) {

                $access = implode(",", $request->access);

                $sheet = Spreadsheet::find($request->id);
                $sheet->access = $access;

                if($sheet->save()) {

                    return redirect()->back()->with("successAcc", "Mantap Slurrr");

                }

                return redirect("/spreadsheet");

            }

        }

        $cek = DB::table('spreadsheets')->where('slug', $slug)->latest()->first();

        if(!$cek) {

            return redirect("/spreadsheet")->with("notFoundSheet", "Spreadsheet tidak ditemukan, mari membuat Spreadsheet baru anda.");

        }
        
        $users = User::all();
        $acc = explode(",", $cek->access);

        if(($cek->owner == auth()->user()->email) || (in_array(auth()->user()->email, $acc))) {

            return view("sheet", [
                'data' => $cek,
                'users' => $users,
                'access' => $acc
            ]);

        }

        return redirect("/spreadsheet")->with("accessDenied", "Anda tidak memiliki izin akses, cobalah untuk menghubungi pemilik Spreadsheet ini.");

    }

    public function createSheet(Request $request) {

        $title = $request->judul;
        $description = $request->deskripsi;
        $slug = $request->slug;
        $owner = $request->owner;
        $data = "";

        if($request->has('toggle')) {

            $template = Template::find($request->template);
            $data = $template->data;

        }

        $create = Spreadsheet::create([

            'title' => $title,
            'description' => $description,
            'owner' => $owner,
            'data' => $data,
            'access' => null,
            'slug' => $slug

        ]);

        if($create) {

            return redirect("/spreadsheet")->with("successSheet", "Spreadsheet anda berhasil dibuat, mulailah mengolah data");

        }

        return redirect("/spreadsheet")->with("failedsSheet", "Spreadsheet anda gagal dibuat, harap coba lagi nanti");

    }

    public function saveSheet(Request $request) {

        $spreadsheet = Spreadsheet::find($request->input('id'));
        $spreadsheet->data = $request->input('data');

        if($spreadsheet->save()) {

            return "OKE";

        }

        return "salah di beken";

    }

    public function getSheet(Request $request) {

        $spreadsheet = DB::table('spreadsheets')->where('slug', $request->url)->latest()->first();

        return $spreadsheet->data;

    }

    public function logout(Request $request) {

        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect('/');

    }

}
