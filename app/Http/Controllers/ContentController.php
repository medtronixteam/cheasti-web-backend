<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class ContentController extends Controller
{
    // Show the content scheduler
    public function showContentScheduler()
    {
        $contents = Content::where('user_id', Auth::id())->get();
        $contents->transform(function ($content) {
            $content->platforms = json_decode($content->platforms);
            return $content;
        });
        return view('user.content_scheduler.index', compact('contents'));
    }

    // Show the create page for before video upload
    public function create()
    {
        $categories = Category::all();
        return view('user.content_scheduler.create', compact('categories'));
    }

    public function store(Request $request)
    {
        if ($request->has('tags') && is_array($request->tags)) {
            $request->merge(['tags' => implode(',', $request->tags)]);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:250',
            'description' => 'required|string|max:500',
            'category' => 'required|exists:categories,id',
            'tags' => 'nullable|string|max:500',
            'caption_or_text' => 'nullable|string|max:500',
            'video' => 'nullable|file|mimes:mp4,mov,ogg,qt|max:20000',
            'platforms' => 'required|string|in:facebook,tiktok,youtube,instagram',
            'schedule_date' => 'required|date',
            'schedule_time' => 'required',
            'reminder' => 'nullable|integer|in:5,10,30,60,120',
        ]);

        if ($validator->fails()) {
            $messages = $validator->messages()->toArray();
            $response = [
                'errors' => $messages,
                'status' => 'error',
                'code' => 400
            ];
            return response()->json($response, 400);
        } else {
            $filePath = null;
            $thumbnailPath = null;

        

            $postData = [
                'video' => $request->video,
                'title' => $request->title,
                'description' => $request->description,
                'category' => $request->category,
                'tags' => $request->tags,
                'caption_or_text' => $request->caption_or_text,
                'video' => $request->video,
                'platforms' => $request->platforms,
                'date' => $request->schedule_date,
                'time' => $request->schedule_time,
                'reminder' => $request->reminder,
            ];
            return response()->json($postData);

            // Ensure $user is defined and contains the jwt_key
            $user = auth()->user();
            if (!$user || !$user->jwt_key) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            $response = Http::asForm()
                ->withHeaders(['Authorization' => 'Bearer' . $user->jwt_key])
                ->post('https://chesti.ihsancrm.com/chesteei/v1/upload/video/youtube', $postData);

            if ($response->failed()) {
                if ($response->status() == 420) {
                    flashy()->error('Plese Link You Youtube Acoount ', '#');
                } elseif ($response->status() == 401) {
                    flashy()->error('Session has been expired login again', '#');
                    return redirect()->route('logout');
                } else {
                    flashy()->error('Something went wrong', '#');
                }
                return back()->with('error', 'Invalid Username or Password');
            } else {
                flashy()->success('Video Schedule Successfully', '#');
                return back();
            }
        }
    }





    public function edit($video_id)
    {
        $content = Content::findOrFail($video_id);
        $categories = Category::all();
        return view('user.content_scheduler.edit', compact('content', 'categories'));
    }

    public function update(Request $request, $video_id)
    {
        $content = Content::findOrFail($video_id);

        if ($request->has('tags') && is_array($request->tags)) {
            $request->merge(['tags' => implode(',', $request->tags)]);
        }

        $request->validate([
            'title' => 'required|string|max:250',
            'description' => 'required|string|max:500',
            'category' => 'required|exists:categories,id',
            'tags' => 'nullable|string|max:500',
            'caption_or_text' => 'nullable|string|max:500',
            'file_path' => 'nullable|file|mimes:mp4,mov,ogg,qt|max:20000',
            'thumbnail_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'platforms' => 'required|string|in:facebook,tiktok,youtube,instagram', // Validate as string and ensure it's one of the allowed platforms
            // 'platforms' => 'required|array',
            // 'platforms.*' => 'in:facebook,tiktok,youtube,instagram',
            'schedule_date' => 'required|date',
            'schedule_time' => 'required',
            'reminder' => 'nullable|integer|in:5,10,30,60,120',
        ]);

        $filePath = $content->file_path;
        $thumbnailPath = $content->thumbnail_path;

        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $filePath = $file->storeAs('videos', uniqid() . '.' . $file->extension(), 'public');
        }

        if ($request->hasFile('thumbnail_path')) {
            $file = $request->file('thumbnail_path');
            $thumbnailPath = $file->storeAs('thumbnails', uniqid() . '.' . $file->extension(), 'public');
        }

        $scheduled_at = $request->schedule_date . ' ' . $request->schedule_time;
        $platforms = [$request->platforms];

        $content->update([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'tags' => $request->tags,
            'caption' => $request->caption_or_text,
            'file_path' => $filePath,
            'thumbnail_path' => $thumbnailPath,
            'platforms' => json_encode($platforms),
            'scheduled_at' => $scheduled_at,
            'status' => 'pending',
        ]);

        return redirect()->route('user.content.scheduler')->with('success', 'Content updated successfully');
    }

    public function destroy($video_id)
    {
        $content = Content::findOrFail($video_id);
        $content->delete();

        return redirect()->route('user.content.scheduler')->with('success', 'Content deleted successfully');
    }
}
