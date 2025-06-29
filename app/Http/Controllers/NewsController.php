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
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\DB;
class NewsController extends Controller
{
    public function welcome(){
        return view('project.landing');
    }
    public function index():Response
    {
        DB::enableQueryLog();
        $carousels = News::offset(0)->limit(3)->orderby('id', 'DESC')->get();
        $randomNews = News::where('category_id',random_int(1,3))->latest();
        $firstRandomNews = $randomNews->get()->toArray()[random_int(0,count($randomNews->get())-1)];
        $news = News::paginate(8);

        $data = [
            'title'=> 'berita',
            'news' => $news,
            'carousels' => $carousels,
            'randomNews' => $randomNews->get(),
            'firstRandomNews' => $firstRandomNews
        ];

        return response()
        ->view('news', $data);
    }
    public function redirectForm(){
        $categories = Category::all();
        return view('input-berita',["categories" => $categories]);
    }

    private function isNotValidInputUser($judul, $body, $kategori):bool
    {
        return empty($body) || empty($judul) || empty($kategori);
    }
    public function store(Request $request):RedirectResponse
    {
        $validate = $request->validate([
            'judul' => 'required',
            'body' => 'required',
            'category_id' => 'required',
            'foto' => 'required|mimes:jpg,png,jpeg,webp|max:2000'
        ]);
        $namaFoto = $request->file('foto')->getClientOriginalName();
        $namaFoto .= '-'.Str::uuid();
        $namaFoto = Str::replace(' ', '', $namaFoto);
        $user_id = $request->session()->get('id');

        // store foto ke images
        $request->file('foto')->storeAs('images', $namaFoto, 'public');
        $manager = new ImageManager(new Driver());
        $image = $manager->read(public_path("storage/images/{$namaFoto}"))->cover(1200,1200);
        $newArray = array_merge($validate, ['user_id' => $user_id, 'gambar' => $namaFoto]);
        try{
            News::create($newArray);
            return redirect()->back()->with('status', 'Berhasil membuat berita');
        }catch(\Exception $e){
             return redirect()->back()->with('status', "error {$e->getMessage()}");
        }
    }

    private function checkIsIdEmpty($id):bool{
        $idDatabase = [];
        $news = News::all();
        foreach($news as $n){
            array_push($idDatabase, $n->id);
        }
        return in_array($id, $idDatabase);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       if(!$this->checkIsIdEmpty($id)){
            return redirect('/news');
       }

        $beritaTerbaru = News::offset(0)->limit(6)->orderby('id', 'DESC')->get();
        $newsOne = News::where('id', $id)->get();
        $likeUser = News::where('id','<>', $id )
        ->where('category_id',$newsOne->toArray()[0]["category_id"])
        ->offset(0)
        ->limit(5)
        ->inRandomOrder()->get();

        return view('detail-news', [
            'title' => 'Detail berita',
            'news' => $newsOne->first(),
            'beritaTerbaru' => $beritaTerbaru,
            'likeUser' => $likeUser
        ]);
    }
    public function edit(string $id)
    {
        if(!$this->checkIsIdEmpty($id)){
            return redirect('/news');
        }
        $news = News::find($id);
        return view('edit', [
            'title' => 'Edit data',
            'news' => $news,
        ]);
    }

    private function isEmptyGambar($data){
        return empty($data);
    }
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'body' => 'required',
            'kategori' => 'required',
            'gambar' => 'image|mimes:jpg,png,jpeg,webp'
        ]);

        $fotoUpdate = NULL;
        $id = $request->input('id');
        $body = $request->input('body');
        $judul = $request->input('judul');
        $kategori = $request->input('kategori');
        $fotoBaru = $request->file('gambar');
        $fotoLama = $request->input('foto');
        $manager = new ImageManager(new Driver());
        if($this->isEmptyGambar($fotoBaru)){
            $fotoUpdate = $fotoLama;
        } else {
            if(Storage::disk('public')->exists('images/' . $fotoLama)){
                Storage::disk('public')->delete('images/' . $fotoLama);
            }
            $fotoUpdate = $fotoBaru;
            $fotoUpdate = Str::uuid().'-'.$fotoUpdate->getClientOriginalName();
            $fotoUpdate = Str::replace(' ', '', $fotoUpdate);
            $request->file('gambar')->storeAs('images', $fotoUpdate, 'public');
        }
        $image = $manager->read(public_path("storage/images/{$fotoUpdate}"))->cover(1200,1200);
        $image->save();

        try{
            News::findOrFail($id)->update([
                'judul' => $judul,
                'body' => $body,
                'category_id' => $kategori,
                'gambar' => $fotoUpdate
            ]);
            return redirect()->back()->with('status', 'Berhasil mengupdate data');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Gagal mengupdate data '.$e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        $news = News::find($id);
        Storage::delete('images/'.$news->gambar);
        $news->delete();
        return back()->with('status', 'Berhasil menghapus data data');
    }

    private function checkUserIdIsEmpty($id):bool{
        $idDatabase = [];
        $users = User::all();
        foreach($users as $user){
            array_push($idDatabase, $user->id);
        }
        return in_array($id, $idDatabase);
    }

    public function getAllNews(int $id){
        if(!$this->checkUserIdIsEmpty($id)){
            return redirect('/news');
        }
        $categories = Category::all();
        $news = News::where('user_id', $id);
        $username = $news->get()->toArray()[0]["user_news"]["nama"];
        return view('news-by-user', [
            'title'=> 'nothing',
            'news'  => $news->paginate(6),
            'carousels' => $categories,
            'username' => $username
        ]);
    }

    private function emptyIdCategory($id):bool{
        $idDatabase = [];
        $categories = Category::all();
        foreach($categories as $category){
            array_push($idDatabase, $category->id);
        }
        return in_array($id, $idDatabase);
    }
    public function getNewsKategori(int $id){
        if(!$this->emptyIdCategory($id)){
            return redirect('/news');
        }
        
        $categories = Category::all();
        $news = News::where('category_id', $id)->paginate(6);
        $categoryName = Category::where('id', $id)->get()->toArray()[0];
        $sports = News::where('category_id', 1)
                        ->inRandomOrder()
                        ->limit(2)->get();

        $healths = News::where('category_id', 2)->inRandomOrder()->limit(2)->get();
        $culinaries = News::where('category_id',3)->inRandomOrder()->limit(2)->orderby('id', 'DESC')->get();
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
        $id_user = $request->session()->get('id');
        $news = News::where('user_id', $id_user)->paginate(6);
        return view('user-news', [
            'title'=> 'Berita',
            'news' => $news,
        ]);
    }
    public function getCompleteBody()
    {
        $id = request('id');
        $news = News::where('id', $id)->first();
        $data = [
            'news' => $news->body,
            'id' => $news->id
        ];
        return view('partial.complete', $data)->render();
    }
}
