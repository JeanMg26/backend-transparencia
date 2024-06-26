<?php

namespace App\Http\Controllers;

use App\Http\Requests\Activity\CreateActivityRequest;
use App\Http\Requests\Activity\UpdateActivityRequest;
use App\Http\Resources\ActivitiesResource;
use App\Http\Resources\ActivityResource;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
  // ------ List Activities ------
  public function listActivities()
  {
    // $activities = Activity::all();
    $activities = Activity::orderBy('created_at', 'desc')->paginate(10);

    return ActivitiesResource::collection($activities);
  }

  // ------ Get Activity ------
  public function getActivity($id)
  {
    $activity = Activity::find($id);

    if (is_null($activity)) {
      return response()->json(['message' => 'Activity not found.'], 404);
    }

    return new ActivityResource($activity);
  }

  // ------ Created Activity ------
  public function createActivity(CreateActivityRequest $request)
  {
    Activity::create([
      'title' => $request->title,
      'autor' => $request->autor,
      'storage_id' => $request->storage_id,
      'description' => $request->description,
    ]);

    return response()->json(["message" => "Activity add successfully"]);
  }

  // ------ Updated Activity ------
  public function updateActivity(UpdateActivityRequest $request, $id)
  {
    $activity = Activity::find($id);

    if (is_null($activity)) {
      return response()->json(['message' => 'Activity not found.'], 404);
    }

    $activity->update([
      'title' => $request->title,
      'autor' => $request->autor,
      'storage_id' => $request->storage_id,
      'description' => $request->description,
    ]);

    return response()->json(["message" => "Activity updated successfully"]);
  }

  // ------ Delete Activity ------
  public function deleteActivity($id)
  {
    $activity = Activity::find($id);

    if (is_null($activity)) {
      return response()->json(['message' => 'Activity not found.'], 404);
    }

    $activity->delete();

    return response()->json(['message' => 'Activity delete successfully.'], 200);
  }
}
