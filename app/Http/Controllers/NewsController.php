<?php

namespace App\Http\Controllers;
use App\Models\News;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function welcome(){
        return view('project.landing');
    }
    public function index():Response
    {
        $categories = Category::all();
        // $news = News::all();
        $carousels = News::offset(0)->limit(6)->orderby('id', 'DESC')->get();
        $randomNews = News::where('category_id',random_int(1,3));
        $firstRandomNews = $randomNews->get()->toArray()[0];
        $news = News::paginate(10);
        // $sports = News::where('category_id', 1)->offset(0)->limit(3)->get();
        // $healths = News::where('category_id', 2)->offset(0)->limit(3)->get();
        // $culinary = News::where('category_id',3)->offset(0)->limit(1)->orderby('id', 'DESC')->get()->toArray()[0];
        //News::filter(request(['search']))->latest()->get(),
        return response()
            ->view('news', [
                'title'=> 'berita',
                'news' => $news,
                'carousels' => $carousels,
                'categories' => $categories,
                'randomNews' => $randomNews->get(),
                'firstRandomNews' => $firstRandomNews
                // 'class' => 'index-page',
                // 'sports' => $sports,
                // 'culinary' => $culinary,
                // 'healths' => $healths
            ]);
    }
    public function redirectForm(){
        $categories = Category::all();
        return view('input-berita',["categories" => $categories]);
    }
    public function create()
    {
        //
    }

    private function isNotValidInputUser($judul, $body, $kategori):bool
    {
        return empty($body) || empty($judul) || empty($kategori);
    }
    public function store(Request $request):RedirectResponse
    {
        $author = $request->input('author');
        $judul = $request->input('judul');
        $body = $request->input('body');
        $user_id = $request->session()->get('id');
        // var_dump($user_id);die;
        $kategori = (int)$request->input('kategori');
        
        if($this->isNotValidInputUser($judul, $body, $kategori))
        {
            return redirect()->route('form')->with('error', 'Inputan tidak boleh ada yang kosong!');
        }
        
        if($request->hasFile('foto')){
            $foto = $request->file('foto');
            $ekstensiValid = ["jpg", "jpeg", "png", "webp"];
            if(!in_array($foto->getClientOriginalExtension(), $ekstensiValid)){
                return redirect()->route('form')->with('error', 'Ekstensi gambar tidak valid!');
            }
            if($foto->getSize() > 2000000){
                return redirect()->route('form')->with('error', 'gambar terlalu besar');
            }

            $namaFoto = $request->foto->store('images', 'public');
            News::create([
                'judul' => $judul,
                'body' => $body,
                'gambar' => basename($namaFoto),
                'category_id' => $kategori,
                'user_id' => $user_id,
            ]);
            return redirect()->route('news')->with('status', 'berhasil menambahkan data');    
        } else{
            return redirect()->route('form')->with('error', "Masukkan foto!!");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $beritaTerbaru = News::offset(0)->limit(6)->orderby('id', 'DESC')->get();
        $categories = Category::all();
        $newsOne = News::where('id', $id)->get()->first();
        return view('detail-news', [
            'title' => 'Detail berita',
            'news' => $newsOne,
            'categories' => $categories,
            'beritaTerbaru' => $beritaTerbaru
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::all();
        $news = News::find($id);
        return view('edit', [
            'title' => 'Edit data',
            'news' => $news,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    private function isEmptyGambar($data){
        return empty($data);
    }
    public function update(Request $request, string $id)
    {
        $fotoUpdate = NULL;
        $id = $request->input('id');
        $body = $request->input('body');
        $judul = $request->input('judul');
        $kategori = $request->input('kategori');
        $fotoBaru = $request->file('gambar');
        $fotoLama = $request->input('foto');
        // var_dump($fotoLama);die;
        if($this->isEmptyGambar($fotoBaru)){
            $fotoUpdate = $fotoLama;
            var_dump($fotoUpdate);
        } else {
            if(Storage::disk('public')->exists('images/' . $fotoLama)){
                Storage::disk('public')->delete('images/' . $fotoLama);
            }
            $fotoUpdate = $fotoBaru;
            echo "Foto baru bro <br>";
            // var_dump($fotoUpdate);die;
            $ekstensiValid = ["jpg", "jpeg", "png", "webp"];
            if(!in_array($fotoUpdate->getClientOriginalExtension(), $ekstensiValid)){
                return redirect()->back()->with('error', 'Ekstensi gambar tidak valid!');
            }
            if($fotoUpdate->getSize() > 2000000){
                return redirect()->back()->with('error', 'gambar terlalu besar');
            }
            $fotoUpdate = $request->gambar->store('images', 'public');
            $fotoUpdate = basename($fotoUpdate);
        }

        News::find($id)->update([
            'judul' => $judul,
            'body' => $body,
            'category_id' => $kategori,
            'gambar' => $fotoUpdate
        ]);
        return redirect()->back()->with('status', 'berhasil mengupdate data');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $news = News::find($id);
        Storage::delete('images/'.$news->gambar);
        $news->delete();
        return back()->with('status', 'Berhasil menghapus data data');
    }

    public function getAllNews(int $id){
        $categories = Category::all();
        $news = News::where('user_id', $id)->get();
        $username = User::where('id', $id)->get()->toArray()[0]["nama"];
        return view('news-by-user', [
            'title'=> 'nothing',
            'news'  => $news,
            'categories' => $categories,
            'carousels' => $categories,
            'username' => $username
        ]);
    }

    // public function getNewsKategori($id){
    //     $categories = Category::all();
    //     $news = News::where('category_id', $id);
    //     return view('news', [
    //         'title' => 'kategori news',
    //         'news' => $news,
    //         'categories' => $categories,
    //     ]);
    // }
    public function getNewsKategori(int $id){
        $categories = Category::all();
        $news = News::where('category_id', $id)->paginate(10);
        $categoryName = Category::where('id', $id)->get()->toArray()[0];
        $sports = News::where('category_id', 1)->offset(0)->limit(2)->get();
        $healths = News::where('category_id', 2)->offset(0)->limit(2)->get();
        $culinaries = News::where('category_id',3)->offset(0)->limit(2)->orderby('id', 'DESC')->get();
         return view('category', [
            'title' => 'kategori news',
            'news' => $news,
            'categories' => $categories,
            'categoryName' => $categoryName,
            'sports' => $sports,
            'healths' => $healths,
            'culinaries' => $culinaries
        ]);
    }

    public function getNewsUser(Request $request, $id){
        $categories = Category::all();
        $id_user = $request->session()->get('id');
        $news = News::where('user_id', $id_user)->get();
        return view('user-news', [
            'title'=> 'Berita',
            'news' => $news,
            'categories' => $categories
        ]);
    }
}
