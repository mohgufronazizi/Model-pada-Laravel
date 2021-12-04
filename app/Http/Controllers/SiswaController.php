<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Siswa;
use DB;

class SiswaController extends Controller
{
    public function index()
    {   

        // mengambil data melalui Model

        // mengambil semua nama siswa

        foreach (Siswa::all() as $siswa) {
            echo $siswa->nama."<br>";
        }


        // Mengambil yang nilai 'jk' == 'L'

        $siswa_laki = Siswa::where('jk','L')
        ->orderBy('nama')
        ->get();

        foreach ($siswa_laki as $siswa) {
            echo $siswa->nis." - ".$siswa->nama."<br>";
        }

        // mengambil data single model

        // mengambil model dengan nilai primary key
        $siswa = Siswa::find('2021010001');

        // ambil model pertama yang coock dengan batasan query
        $siswa = Siswa::where('nis','2021010001')->first();

        // alternatif untuk mengambil model pertama yang cocok dengan dengan batasan query
        $siswa = Siswa::firstWhere('nis','2021010001');

        echo $siswa->nis." - ".$siswa->nama."<br>";

        // menggunakan teknik firstOr()
        $siswa_pertama_dari_jurusan = Siswa::where('id_jurusan','=',2)->firstOr(function(){
            // jika tidak ada data yang ditemukan maka akan menjalankan perintah disini
            echo "Tidak ada hasil yang ditemukan";
        });
        echo $siswa_pertama_dari_jurusan->nis." - ".$siswa_pertama_dari_jurusan->nama;


        // metode ini jika error menampilkan 404 NOT FOUND
        // findOrFail dengan primary key
        $siswa = Siswa::findOrFail('2021010001');

        // findOrFail dengan pembatasan query
        $siswa = Siswa::where('id_jurusan','>',2)->firstOrFail();

        echo $siswa->nis." - ".$siswa->nama."<br>";


        // Query Builder database Laravel menyediakan interface yang mudah untuk membuat dan menjalankan query database. Query Builder Laravel menggunakan PDO parameter binding untuk melindungi aplikasi dari serangan SQL injection.

        // mengambil semua record

        // Kalian dapat menggunakan method table() yang disediakan oleh DB facade untuk memulai query. Method ini mengembalikan instance query builder untuk tabel yang diberikan dan memungkinkan kalian untuk memberikan lebih banyak batasan ke dalam query sebelum akhirnya mengambil hasil query menggunakan method get(). Sekarang kita coba untuk retrieve semua data siswa kemudian echo nama dan nis.

        // mengambil demua siswa dengan query builder
        $siswa_all = DB::table('siswa')->get();

        foreach ($siswa_all as $siswa) {
            echo $siswa->nis." - ".$siswa->nama."<br>";
        }


        // mengambil single row/column

        // Apabila kalian hanya ingin mengambil satu baris dari tabel database, kalian dapat menggunakan method first(). Method ini akan mengembalikan objek stdClass tunggal. Atau jika kalian hanya ingin mengambil nilai dari kolom tertentu, kalian bisa menggunakan method value(). Untuk mengambil satu baris berdasarkan primary key, kalian bisa menggunakan method find().

        public function index()
        {
            // mengambil 1 row data yang memiliki nama 'Sugeng'
            $siswa_single = DB::table('siswa')
            ->where('nama','Sugeng')
            ->first();

            // mengambil nilai dari kolom nis yang memiliki nama 'Sugeng'
            $siswa_nis = DB::table('siswa')
            ->where('nama','Sugeng')
            ->value('nis');

            // mengambil 1 row data yang dengan primary key '2021010001'
            $siswa_single_by_id = DB::table('siswa')->find('2021010001');
        }


        // Mengambil List Nilai dari Column

        // Jika hanya perlu untuk mengambil semua nilai dalam satu kolom tabel, kalian bisa menggunakan method pluck(). Disini kita akan mencoba untuk mengambil list dari kolom ‘nis’.

        $siswa_nis = DB::table('siswa')
        ->pluck('nis');

        foreach ($siswa_nis as $nis) {
            echo $nis."<br>";
        }

        // Kalian juga bisa menentukan kolom yang harus digunakan oleh list yang dihasilkan sebagai key dengan memberikan argumen kedua ke method pluck()

        // Menambahkan argumen kedua untuk dijadikan key menggunakan query builder
        $siswa_nis = DB::table('siswa')
        ->pluck('nis','nama');

        foreach ($siswa_nis as $nama => $nis) {
            echo $nis."<br>";
        }


        // Agregat
        // Query Builder juga menyediakan berbagai metode untuk mengambil nilai agregat seperti count, max, min, avg, dan sum. Anda dapat memanggil salah satu metode ini setelah membuat query.

        $jml_siswa =DB::table('siswa')->count();

        // Select Statement 
        // Kalian mungkin tidak selalu ingin memilih semua kolom dari tabel. Dengan menggunakan method select() kalian dapat menentukan kolom mana saja yang akan kalian ambil
        // mendapatkan nis,nama,jenis kelamin siswa
        $siswa = DB::table('siswa')
        ->select('nis','nama','jk as jenisKelamin')
        ->get();

        // Untuk hanya mendapatkan data yang berbeda, kalian bisa menggunakan distinct()
        // Mengambil data yang berbeda dengan distinct menggunakan query builder
        $siswa = DB::table('siswa')
        ->distinct()
        ->get();

        // Mengambil data yang berbeda dengan distinct menggunakan query builder


        // Raw Expression 
        // Untuk membuat ekspresi raw string, kalian dapat menggunakan method raw()
        $siswa = DB::table('siswa')
        ->select(DB::raw('count(*) as jml_siswa, id_jurusan'))
        ->where('id_jurusan','>',0)
        ->groupBy('id_jurusan')
        ->get();


        // Join 
        // Query Builder juga dapat digunakan untuk menambahkan join clauses. Beberapa method yang dapat digunakan adalah join(), rightJoin(), leftJoin(), dan crossJoin().
        $siswa = DB::table('siswa')
        ->leftJoin('jurusan','siswa.id_jurusan','=','jurusan.id_jurusan')
        ->get();

        // Union 
        // Query Builder menyediakan metode yang mudah untuk menggabungkan dua query atau lebih bersama-sama. Misalnya, kalian dapat membuat query $jurusan_siswa untuk mendapatkan semua siswa dengan ‘id_jurusan’ bernilai diatas 2 dan menggunakan method union() pada $siswa untuk menggabungkannya.
        $jurusan_siswa = DB::table('siswa')->where('id_jurusan','>',1);

        $siswa = DB::table('siswa')
        ->whereNull('nilai')
        ->union($jurusan_siswa)
        ->get();

        return $siswa;

        // Order, Group, Limit, dan Offset 
        // Untuk mengurutkan data yang diambil dengan kolom tertentu, kalian dapat menggunakan method orderBy(). Argumen pertama berisi kolom yang akan menjadi pengurutan dan argumen kedua menentukan arah urutan dapat berupa asc atau desc.
        $siswa = DB::table('siswa')
        ->orderBy('id_jurusan','asc')
        ->get();

        // Kemudian jika kalian ingin mengelompokkan data misalkan disini akan dikelompokkan berdasarkan kolom ‘nis’ maka kalian dapat menggunakan method groupBy().

        $siswa = DB::table('siswa')
        ->orderBy('id_jurusan','asc')
        ->groupBy('nis')
        ->get();

        return $siswa;

        // Apabila kalian mengalami error “... Syntax error or access violation: 1055 'coba_sekolah.siswa.nama' isn't in GROUP BY ...” maka coba edit file config/database.php di dalam array mysql menjadi strict => false. Untuk mengambil data mulai dari urutan tertentu dan batas tertentu kalian dapat menggunakan method offset() dan limit().
        $siswa = DB::table('siswa')
        ->orderBy('id_jurusan','asc')
        ->groupBy('nis')
        ->offset(3) //Data diambil mulai dari urutan setelah 3
        ->limit(6) //Jumlah data yang diambil maksimal 6
        ->get();

        return $siswa;

    }


    // CATATAN 
    // untuk membuat otomatis insert update delete maka ketikkan
    // php artisan make:namaController --resource

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
    public function store(Request $request)
    {
        // basic insert
        $siswa = new Siswa;
        $siswa->nama = $request->nama;
        $siswa->save();

        // insert dengan metode create
        $siswa = new Siswa([
            'nama' = 'Jong koding'
            // .....properti lain di sini
            // Untuk menggunakan method create(), kalian perlu menentukan properti yang dapat diisi ($fillable) atau dijaga ($guarded) pada class model
            // untuk $fillabel di tulis di file Model
        ]);

        // akanmencari data dengan keyword nsi terlebih dahulu,
        // bila data DITEMUKAN akan mendapatkan record data
        // bila data TIDAK DITEMUKAN akan memasukkan record baru
        $siswa = Siswa::firstOrCreate(
            ['nis' => '2021010001'],
            ['nama' => 'Jong Koding','jk' => 'L']
        );

        // Insert Statement 
        // Query Builder juga memungkinkan kalian untuk memasukkan data ke dalam database. Kalian dapat memasukkan single record maupun multi record.

        // single record
        $siswa = DB::table('siswa')
        ->insert(["nis" => "13", "nama" => "Jong Koding"]);

        // multi record
        $siswa = DB::table('siswa')
        ->insert([
           ["nis" => "13", "nama" => "Jong Koding"],
           ["nis" => "14", "nama" => "Jong Koding Baru"]
        ]);
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
        // menubah data siswa biasa
        $siswa = Siswa::find($id);
        $siswa->nama = 'Jong Koding Berubah';
        $siswa->save();

        // menubah data siswa menggunakan method update()
        $siswa = Siswa::where('nis',$id)
        ->update([
            'nama' => 'Jong koding Berubah',
            'jk' => 'L',
        ]);

        // Upsert, menggunakan updateOrCreate
        $siswa = Siswa::updateOrCreate(
            ['nis' => $id,'nama' => 'Jong Koding Berubah'],
            [
                'jk' => 'L',
                'tmp_lahir' => 'jakarta'
        ]);


        // Update Statement 
        // Method update() akan melakukan perubahan pada record sesuai dengan pembatasan yang diberikan

        $siswa = DB::table('siswa')
        ->where('nis','2021010001')
        ->update(["nama" => "Jong Koding Berubah"]);

        // Selain itu, sama seperti Eloquent yang memiliki updateOrCreate(), Query Builder juga menyediakan method yang sama yaitu updateOrInsert()
        $siswa = DB::table('siswa')
        ->updateOrInsert(
            ['nis' => '2021010001','nama' => 'Jong Koding Berubah'],
            [
                'jk' => 'L',
                'tmp_lahir' => 'Jakarta'
            ]
        );

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siswa = Siswa::find($id);
        $siswa->delete();

        // Pada contoh di atas, kita mengambil model dari database sebelum memanggil method delete(). Namun, jika kalian mengetahui primary key model yang akan dihapus, kalian dapat menghapus model tanpa mengambilnya secara eksplisit dengan memanggil method destroy(). Selain menerima satu primary key, method destroy() akan menerima beberapa primary key, array primary, atau collection primary key.

        // metode 1
        $siswa = Siswa::destroy('2021010001');
        // metode 2
        $siswa = Siswa::destroy('2021010001','2021010002','2021010003');
        // metode 3
        $siswa = Siswa::destroy(['2021010001','2021010002','2021010003']);
        // metode 4
        $siswa = Siswa::destroy(collect(['2021010001','2021010002','2021010003']));


        // Menghapus model dengan method delete dan query
        $siswa = Siswa::where('tmp_lahir','Situbondo')->delete();

        // Delete Statement
         // Setelah insert dan update tentunya kalian akan membutuhkan method delete() untuk aplikasi kalian.
        $siswa = DB::table('siswa')
        ->where('nis','2021010001')
        ->delete();


    }
}
