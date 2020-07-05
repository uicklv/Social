<?php


namespace App\Http\Controllers;



use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'caption' => 'required|min:1|max:16777215',
        ] );

        $post = new Post();
        $post->id = Uuid::uuid4();
        $post->user_id = Auth::user()->id;
        $post->caption = $request->get('caption');
        $post->save();
    }
}
