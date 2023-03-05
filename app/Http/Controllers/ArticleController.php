<?php

namespace App\Http\Controllers;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:article,email',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $imageName = time() . '.' . $request->image->extension();

        $article = new Article([
            'name' => $request->name,
            'email' => $request->email,
            'image' => $imageName,
        ]);

        $article->save();

        $request->image->move(public_path('images'), $imageName);

        return response()->json([
            'message' => 'User created successfully',
            'user' => $article
        ], 201);
    }

    public function show($id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }

        return response()->json([
            'user' => $article
        ]);
    }

    public function update(Request $request, $id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:article,email,'.$id,
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $article->name = $request->name;
        $article->email = $request->email;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $article->image = $imageName;
        }

        $article->save();

        return response()->json([
            'message' => 'User updated successfully',
            'user' => $article
        ]);
    }

    public function destroy($id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }

        $article->delete();

        return response()->json([
            'message' => 'User deleted successfully'
        ]);
    }
}