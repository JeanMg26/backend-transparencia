<?php

namespace App\Http\Controllers;

use App\Http\Requests\Article\CreateArticleRequest;
use App\Http\Requests\Article\UpdateArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\ArticlesResource;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
  // ------ List Articles ------
  public function listArticle()
  {
    $articles = Article::all();

    return ArticlesResource::collection($articles);
  }

  // ------ Get Article ------
  public function gettArticle($id)
  {
    $article = Article::find($id);

    if (is_null($article)) {
      return response()->json(['message' => 'Article not found.'], 404);
    }

    return new ArticleResource($article);
  }

  // ------ Created Article ------
  public function createArticle(CreateArticleRequest $request)
  {
    Article::create([
      'title' => $request->title,
      'autor' => $request->autor,
      'description' => $request->description,
      'route' => $request->route,
      'category_id' => $request->category_id
    ]);

    return response()->json(["message" => "Artitcle add successfully"]);
  }

  // ------ Updated Article ------
  public function updateArticle(UpdateArticleRequest $request, $id)
  {
    $article = Article::find($id);

    if (is_null($article)) {
      return response()->json(['message' => 'Article not found.'], 404);
    }

    $article->update([
      'title' => $request->title,
      'autor' => $request->autor,
      'route' => $request->route,
      'description' => $request->description,
      'category_id' => $request->category_id
    ]);

    return response()->json(["message" => "Article updated successfully"]);
  }

  // ------ Delete Article ------
  public function deleteArtitcle($id)
  {
    $article = Article::find($id);

    if (is_null($article)) {
      return response()->json(['message' => 'Article not found.'], 404);
    }

    $article->delete();

    return response()->json(['message' => 'Article delete successfully.'], 200);
  }
}
